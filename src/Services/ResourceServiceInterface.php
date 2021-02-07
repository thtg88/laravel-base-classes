<?php

namespace Thtg88\LaravelBaseClasses\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\DestroyRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\IndexRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\RestoreRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\SearchRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\StoreRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\UpdateRequestInterface;

interface ResourceServiceInterface
{
    /**
     * Deletes a model instance from a given id.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\DestroyRequestInterface $request
     * @param int $id The id of the model.
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function destroy(DestroyRequestInterface $request, int $id): ?Model;

    /**
     * Return the service name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Return all the model instances.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\IndexRequestInterface $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function index(IndexRequestInterface $request): LengthAwarePaginator;

    /**
     * Restore a model instance from a given id.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\RestoreRequestInterface $request
     * @param int $id The id of the model
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function restore(RestoreRequestInterface $request, int $id): ?Model;

    /**
     * Return the model instances matching the given search query.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\SearchRequestInterface $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search(SearchRequestInterface $request): Collection;

    /**
     * Returns a model from a given id.
     *
     * @param int $id The id of the instance.
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function show(int $id): ?Model;

    /**
     * Create a new model instance in storage from the given data array.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\StoreRequestInterface $request
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function store(StoreRequestInterface $request): ?Model;

    /**
     * Updates a model instance with given data, from a given id.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\UpdateRequestInterface $request
     * @param int $id The id of the model
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function update(UpdateRequestInterface $request, int $id): ?Model;
}
