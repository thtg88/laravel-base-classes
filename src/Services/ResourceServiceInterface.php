<?php

namespace Thtg88\LaravelBaseClasses\Services;

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
     * @param \Thtg88\LaravelBaseClasses\\Http\Requests\Contracts\DestroyRequestInterface $request
     * @param int $id The id of the model.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function destroy(DestroyRequestInterface $request, $id);

    /**
     * Return the service name.
     *
     * @return string
     */
    public function getName();

    /**
     * Return all the model instances.
     *
     * @param \Thtg88\LaravelBaseClasses\\Http\Requests\Contracts\IndexRequestInterface $request
     * @return \Illuminate\Support\Collection
     */
    public function index(IndexRequestInterface $request);

    /**
     * Restore a model instance from a given id.
     *
     * @param \Thtg88\LaravelBaseClasses\\Http\Requests\Contracts\RestoreRequestInterface $request
     * @param int $id The id of the model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function restore(RestoreRequestInterface $request, $id);

    /**
     * Return the model instances matching the given search query.
     *
     * @param \Thtg88\LaravelBaseClasses\\Http\Requests\Contracts\SearchRequestInterface $request
     * @return \Illuminate\Support\Collection
     */
    public function search(SearchRequestInterface $request);

    /**
     * Returns a model from a given id.
     *
     * @param int $id The id of the instance.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id);

    /**
     * Create a new model instance in storage from the given data array.
     *
     * @param \Thtg88\LaravelBaseClasses\\Http\Requests\Contracts\StoreRequestInterface $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(StoreRequestInterface $request);

    /**
     * Updates a model instance with given data, from a given id.
     *
     * @param \Thtg88\LaravelBaseClasses\\Http\Requests\Contracts\UpdateRequestInterface $request
     * @param int $id The id of the model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(UpdateRequestInterface $request, $id);
}
