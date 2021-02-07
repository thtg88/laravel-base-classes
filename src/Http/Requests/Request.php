<?php

namespace Thtg88\LaravelBaseClasses\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * The repository implementation.
     *
     * @var \App\Repositories\Repository
     */
    protected $repository;

    /**
     * The model implementation.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $resource;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    /**
     * Determine if the resource from the route's id exists.
     *
     * @return bool
     */
    public function authorizeResourceExist(): bool
    {
        // Find resource
        $this->resource = $this->findResource();

        return $this->resource !== null;
    }

    /**
     * Determine if the resource (even if deleted) exists.
     *
     * @return bool
     */
    public function authorizeResourceDeletedExist(): bool
    {
        // Find resource
        $this->resource = $this->findResource(true);

        return $this->resource !== null;
    }

    /**
     * Determine if the resource from the route's id belongs
     * to the user performing the request.
     *
     * @return bool
     */
    public function authorizeResourceExistAndOwner(): bool
    {
        // Find resource
        $this->resource = $this->findResource();

        return $this->resource !== null &&
            $this->user() !== null &&
            $this->resource->user_id === $this->user()->id;
    }

    /**
     * Find the resource from the route's id.
     * Optionally include a trashed resource in the query.
     *
     * @param bool $with_trashed
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected function findResource($with_trashed = false): ?Model
    {
        // Get id from route
        $resource_id = $this->route('id');

        // Find trashed resource
        if ($with_trashed === true) {
            return $this->repository->withTrashed()
                ->find($resource_id);
        }

        // Find resource
        return $this->repository->find($resource_id);
    }
}
