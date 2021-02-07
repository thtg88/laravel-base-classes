<?php

namespace Thtg88\LaravelBaseClasses\Http\Controllers\Concerns;

use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\ArchiveRequestInterface;
use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\UnarchiveRequestInterface;

trait WithArchive
{
    /**
     * Archive the specified resource in storage.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\ArchiveRequestInterface $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function archive(ArchiveRequestInterface $request, $id)
    {
        // Archive resource
        $resource = $this->service->archive($request, $id);

        return back()->with('resource_archive_success', true)
            ->with('resource_name', $this->service->getResourceName());
    }

    /**
     * Remove the specified resource in storage from archive.
     *
     * @param \Thtg88\LaravelBaseClasses\Http\Requests\Contracts\UnarchiveRequestInterface $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function unarchive(UnarchiveRequestInterface $request, $id)
    {
        // Remove resource from archive
        $resource = $this->service->unarchive($request, $id);

        return back()->with('resource_unarchive_success', true)
            ->with('resource_name', $this->service->getResourceName());
    }
}
