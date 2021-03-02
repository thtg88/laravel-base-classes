<?php

namespace Thtg88\LaravelBaseClasses\Http\Controllers\Web;

use Closure;
use Illuminate\Support\Str;
use Thtg88\LaravelBaseClasses\Helpers\DownloadCsvHelper;
use Thtg88\LaravelBaseClasses\Http\Controllers\ResourceController as BaseResourceController;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\DestroyRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\StoreRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\UpdateRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\DownloadCsvRequest;

class ResourceController extends BaseResourceController
{
    /**
     * The csv header row callback implementation.
     *
     * @var \Closure
     */
    protected Closure $csv_header_row_callback;

    /**
     * The csv row callback implementation.
     *
     * @var \Closure
     */
    protected Closure $csv_row_callback;

    /**
     * Remove the specified resource from storage.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\DestroyRequestInterface $request
     * @param int                                                                        $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyRequestInterface $request, $id)
    {
        // Destroy resource
        $resource = $this->service->destroy($request, $id);

        return redirect($this->getBaseRoute())->with('resource_destroy_success', true)
            ->with('resource_name', $this->service->getResourceName());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\StoreRequestInterface $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequestInterface $request)
    {
        // Store resource
        $resource = $this->service->store($request);

        return back()->with('resource_store_success', true)
            ->with('resource_name', $this->service->getResourceName());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\UpdateRequestInterface $request
     * @param int                                                                       $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequestInterface $request, $id)
    {
        // Update resource
        $resource = $this->service->update($request, $id);

        return back()->with('resource_update_success', true)
            ->with('resource_name', $this->service->getResourceName());
    }

    /**
     * Download a listing of all the resources in CSV format.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\DownloadCsvRequest $request
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadCsv(DownloadCsvRequest $request)
    {
        // Create download csv helper
        $helper = new DownloadCsvHelper(
            $this->service,
            $this->csv_header_row_callback,
            $this->csv_row_callback
        );

        // Get callback
        $callback = $helper->getCallback($request);

        // Create file name from table name, and timestamp
        $filename = $this->service->getName().'-'.now()->format('Y-m-d\TH_i_s').'.csv';

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename='.$filename,
            'Expires'             => '0',
            'Pragma'              => 'public',
        ];

        // return $callback();

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Return the base route.
     *
     * @return string
     */
    protected function getBaseRoute(): string
    {
        return Str::slug($this->getServiceName());
    }

    /**
     * Return the views base folder.
     *
     * @return string
     */
    protected function getViewBaseFolder(): string
    {
        return Str::slug($this->getServiceName());
    }
}
