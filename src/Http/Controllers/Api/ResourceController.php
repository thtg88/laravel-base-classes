<?php

namespace Thtg88\LaravelBaseClasses\Http\Controllers\Api;

use Thtg88\LaravelBaseClasses\Http\Controllers\ResourceController as BaseResourceController;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\DestroyRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\IndexRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\ShowRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\StoreRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\UpdateRequestInterface;

class ResourceController extends BaseResourceController
{
    /**
     * Remove the specified resource from storage.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\DestroyRequestInterface $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DestroyRequestInterface $request, $id)
    {
        // Destroy resource
        $resource = $this->service->destroy($request, $id);

        return response()->json([
            'success' => true,
            'resource' => $resource,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\IndexRequestInterface $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexRequestInterface $request)
    {
        // Get index resources
        $resources = $this->service->index($request);

        return response()->json($resources);
    }

    /**
     * Display the specified resource.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\ShowRequestInterface $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ShowRequestInterface $request, $id)
    {
        // Get resource
        $resource = $this->service->show($id);

        if ($resource === null) {
            abort(404);
        }

        return response()->json([
            'resource' => $resource,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\StoreRequestInterface $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequestInterface $request)
    {
        // Store resource
        $resource = $this->service->store($request);

        return response()->json([
            'success' => true,
            'resource' => $resource,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\UpdateRequestInterface $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequestInterface $request, $id)
    {
        // Update resource
        $resource = $this->service->update($request, $id);

        return response()->json([
            'success', true,
            'resource', $resource,
        ]);
    }
}
