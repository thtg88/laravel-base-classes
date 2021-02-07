<?php

namespace Thtg88\LaravelBaseClasses\Repositories;

use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    /**
     * Return the repository model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel();

    /**
     * Return the default columns to filter by the model.
     *
     * @return array
     */
    public function getDefaultFilterColumns(): array;

    /**
     * Return the default columns to order by the repository model.
     *
     * @return array
     */
    public function getDefaultOrderByColumns(): array;

    /**
     * Return the default columns to search by the repository model.
     *
     * @return array
     */
    public function getDefaultSearchColumns(): array;

    /**
     * Return all the model instances.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection;

    /**
     * Return all the model instances in a compact array form:
     * id as index, model_name as value.
     *
     * @return array
     */
    public function allCompact(): array;

    /**
     * Create a new model instance in storage from the given data array.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data): ?Model;

    /**
     * Deletes a model instance from a given id.
     *
     * @param int $id The id of the model.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function destroy(int $id): ?Model;

    /**
     * Returns a model from a given id.
     *
     * @param int $id The id of the instance.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(int $id): ?Model;

    /**
     * Returns a model from a given model name.
     *
     * @param mixed $model_name The model name of the instance.
     * @return \Illuminate\Database\Eloquent\Model
     * @TODO expand to include multiple column functionality. Perhaps allow array, with separator additional parameter, or closure.
     */
    public function findByModelName($model_name): ?Model;

    /**
     * Returns the first model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findFirst(): ?Model;

    /**
     * Returns a random model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findRandom(): ?Model;

    /**
     * Return all the model instances' ids.
     *
     * @return array
     */
    public function getAllIds(): array;

    /**
     * Return all the resources from given ids.
     *
     * @param int $ids The ids of the resources to return.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByIds(array $ids): Collection;

    /**
     * Return all the resources between a given start and end date.
     * This methods treats the date filter differently depending
     * on the number of columns specified in $date_filter_columns:
     * 0. No date filtering is applied - the result is identical to all()
     * 1. The filter is applied in the form of $start_date <= $date_filter_columns[0] < $end_date
     * 2. The columns are considered to be an interval. Therefore the filter
     * checks if date intervals are overlapping (excluding the edges), in the form:
     * $start_date < $date_filter_columns[0] && $end_date > $date_filter_columns[1]
     * >2. If more than 2 columns are specified, the ones after the second
     * are ignored, and scenario 2 applies.
     *
     * @param \DateTime $start_date The start date.
     * @param \DateTime $end_date The end date.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByStartDateAndEndDate(
        DateTime $start_date,
        DateTime $end_date
    ): Collection;

    /**
     * Return the given number of latest inserted model instances.
     *
     * @param int $limit The number of model instances to return.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function latest(int $limit): Collection;

    /**
     * Return the paginated model instances.
     *
     * @param int $page_size The number of model instances to return per page
     * @param int|null $page The page number
     * @param string $q The optional search query
     * @param string|null $sort_column The optional sort column
     * @param string|null $sort_direction The optional sort direction
     * @param array $wheres Additional where clauses
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate(
        int $page_size = 10,
        ?int $page = null,
        ?string $q = null,
        ?string $sort_column = null,
        ?string $sort_direction = null,
        array $wheres = []
    ): LengthAwarePaginator;

    /**
     * Restore a model instance from a given id.
     *
     * @param int $id The id of the model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function restore(int $id): ?Model;

    /**
     * Return the model instances matching the given search query.
     *
     * @param string|null $q The search query.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search(?string $q): Collection;

    /**
     * Updates a model instance with given data, from a given id.
     *
     * @param int $id The id of the model
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data): ?Model;
}
