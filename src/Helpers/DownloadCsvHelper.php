<?php

namespace Thtg88\LaravelBaseClasses\Helpers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Thtg88\LaravelBaseClasses\Services\ResourceServiceInterface;

/**
 * Helper methods for download CSV.
 */
class DownloadCsvHelper
{
    /**
     * The service implementation.
     *
     * @var \Thtg88\LaravelBaseClasses\Services\ResourceServiceInterface
     */
    protected ResourceServiceInterface $service;

    /**
     * The row callback closure implementation.
     *
     * @var \Closure
     */
    protected Closure $row_callback;

    /**
     * The header row callback closure implementation.
     *
     * @var \Closure
     */
    protected Closure $header_row_callback;

    /**
     * Create a new helper instance.
     *
     * @param \Thtg88\LaravelBaseClasses\Services\ResourceServiceInterface $service
     * @param \Closure $header_row_callback The callback to call for each row in order to get a map of data for each row.
     * @param \Closure $row_callback The callback to call for each row in order to get a map of data for each row.
     * @return void
     */
    public function __construct(
        ResourceServiceInterface $service,
        Closure $header_row_callback,
        Closure $row_callback
    ) {
        $this->service = $service;

        $this->header_row_callback = $header_row_callback;
        $this->row_callback = $row_callback;
    }

    /**
     * Return a callback to download a CSV file with all the resources
     * from the existing service.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Closure
     */
    public function getCallback(Request $request): Closure
    {
        // Get repository
        $repository = $this->service->getRepository();

        // While the all logic in the call-back technique is not great
        // from a pure development perspective, as it doesn't allow us to first
        // fetch all the data, and then output it
        // (better separation of concerns),
        // it allows us though to avoid exhausting memory for resources which
        // have a lot of data e.g. the YoungPerson model.
        // This technique is also better supported by the browser,
        // which instead of showing us a hanging loading indicator,
        // it initiates the download immediately, and shows us the progress
        // (in KB - for Google Chrome) of the whole download,
        // thus hopefully avoiding people to click multiple times if they see
        // the broser hanging.

        // Create a call back to call with the stream response
        return function () use ($repository, $request): void {
            // Open output as a stream
            $stream = fopen('php://output', 'w');

            // If we do not manage to open the files - exit
            if ($stream === false) {
                return;
            }

            // Initialize empty paginator
            $paginated_resources = new LengthAwarePaginator(
                [],
                0,
                config('base-classes.pagination.page_size')
            );

            $page = 0;

            // Get filter data
            $filter_data = $request->only([
                'page',
                'page_size',
                'recovery',
                'sort_direction',
                'sort_name',
            ]);

            $wheres = [];

            $wheres = array_merge(
                $wheres,
                $this->service->getFilterValues($request)
            );

            // Page size fall back to configs
            if (
                ! array_key_exists('page_size', $filter_data) ||
                $filter_data['page_size'] === null
            ) {
                $filter_data['page_size'] = config(
                    'base-classes.pagination.page_size'
                );
            }

            $filter_data['q'] = $this->service->getSearchValue($request);

            if (
                array_key_exists('recovery', $filter_data) &&
                $filter_data['recovery'] == 1
            ) {
                // Set the repository to also fetch trashed models
                $repository = $repository->withTrashed();

                $wheres[] = [
                    'field' => 'deleted_at',
                    'operator' => '<>',
                    'value' => null,
                ];
            }

            // Sort name fall back
            if (empty($filter_data['sort_name'])) {
                $filter_data['sort_name'] = null;
            }

            // Sort direction fall back
            if (empty($filter_data['sort_direction'])) {
                $filter_data['sort_direction'] = null;
            }

            // Continue to loop whether is the first page
            // or we managed to fetch resources on the last round
            while ($page < 1 || count($paginated_resources->items()) > 0) {
                // Start with page 1
                $page++;

                // Get the first batch of resources
                $paginated_resources = $repository->paginate(
                    $filter_data['page_size'],
                    $page,
                    $filter_data['q'],
                    $filter_data['sort_name'],
                    $filter_data['sort_direction'],
                    $wheres
                );

                // If any returned and the headers haven't sent
                // to the output yet
                if (
                    count($paginated_resources->items()) > 0 &&
                    ! isset($headers)
                ) {
                    $headers = call_user_func(
                        $this->header_row_callback,
                        $paginated_resources->items()[0]
                    );

                    // Add to the CSV stream
                    fputcsv($stream, $headers);
                }

                // Next we are going to do the same treatment
                // we did for the headers
                // but to the array values of every resource

                // Loop all the returned data
                foreach ($paginated_resources->items() as $idx => $item) {
                    // Row is the result of the callback
                    $row = call_user_func(
                        $this->row_callback,
                        $item
                    );

                    // Add to the CSV stream
                    fputcsv($stream, $row);
                }
            }

            fclose($stream);
        };
    }
}
