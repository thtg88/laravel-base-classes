<?php

namespace Thtg88\LaravelBaseClasses\Services\Concerns;

use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\ArchiveRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\UnarchiveRequestInterface;

trait WithArchive
{
    /**
     * Archive a model instance with given request, and id.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\ArchiveRequestInterface $request
     * @param int                                                                        $id      The id of the model
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function archive(ArchiveRequestInterface $request, int $id): ?Model
    {
        return $this->repository->update($id, [
            'archived_at' => now()->toDateTimeString(),
        ]);
    }

    /**
     * Remove a model instance from archive, from a given request, and id.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\UnarchiveRequestInterface $request
     * @param int                                                                          $id      The id of the model
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function unarchive(
        UnarchiveRequestInterface $request,
        int $id
    ): ?Model {
        return $this->repository->update($id, ['archived_at' => null]);
    }
}
