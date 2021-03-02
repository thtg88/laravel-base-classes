<?php

namespace Thtg88\LaravelBaseClasses\Repositories\Concerns;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait WithFindByUuid
{
    /**
     * Returns a model from a given id.
     *
     * @param string $uuid The UUID of the instance.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findByUuid(string $uuid): ?Model
    {
        if (Uuid::isValid($uuid) === false) {
            return null;
        }

        // Get model
        $result = $this->model->where('uuid', $uuid);

        $result = $this->withOptionalTrashed($result);

        return $result->first();
    }
}
