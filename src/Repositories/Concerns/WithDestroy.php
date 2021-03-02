<?php

namespace Thtg88\LaravelBaseClasses\Repositories\Concerns;

use Illuminate\Database\Eloquent\Model;
use Thtg88\LaravelBaseClasses\Helpers\JournalEntryHelper;
use Thtg88\LaravelBaseClasses\Models\JournalEntry;

trait WithDestroy
{
    /**
     * Deletes a model instance from a given id.
     *
     * @param int $id The id of the model.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function destroy($id): ?Model
    {
        // Get model
        $model = $this->find($id);
        if ($model === null) {
            return null;
        }

        $model->delete();

        if (config('base-classes.journal_mode') === true) {
            app(JournalEntryHelper::class)->createJournalEntry(
                'delete',
                $model
            );
        }

        return $model;
    }

    /**
     * Delete model instances from a given ids array.
     * Returns the number of records deleted.
     *
     * @param array $ids The ids of the model to destroy.
     *
     * @return int
     */
    public function destroyBulk(array $ids): int
    {
        // Assume site id numeric, not empty and > 0
        $ids = array_filter($ids, static function ($id): bool {
            return !empty($id) && is_numeric($id) && $id > 0;
        });
        if (count($ids) === 0) {
            return 0;
        }

        $response = $this->model->whereIn('id', $ids)->delete();

        if (config('base-classes.journal_mode') === true) {
            app(JournalEntryHelper::class)->createJournalEntry(
                'delete-bulk',
                null,
                [
                    'target_table' => $this->model->getTable(),
                    'ids'          => $ids,
                ]
            );
        }

        return $response;
    }

    /**
     * Restore a model instance from a given id.
     *
     * @param int $id The id of the model
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function restore($id): ?Model
    {
        // Get model
        $model = $this->find($id);
        if ($model === null) {
            return null;
        }

        // Restore model
        $model->restore();

        // Create journal entry only if not creating journal entry i.e. infinite recursion
        if (
            config('base-classes.journal_mode') === true &&
            !($model instanceof JournalEntry)
        ) {
            app(JournalEntryHelper::class)->createJournalEntry(
                'restore',
                $model,
                []
            );
        }

        return $model;
    }
}
