<?php

namespace Thtg88\LaravelBaseClasses\Repositories\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Thtg88\Journalism\Helpers\JournalEntryHelper;
use Thtg88\Journalism\Models\JournalEntry;

trait WithCreate
{
    /**
     * Create a new model instance in storage from the given data array.
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data): Model
    {
        // Create model
        $model = $this->model->create($data);

        // Create journal entry only if not creating journal entry, lol (infinite recursion)
        if (
            config('journalism.enabled') === true &&
            $model !== null &&
            $model instanceof JournalEntry === false
        ) {
            app(JournalEntryHelper::class)->createJournalEntry(
                'create',
                $model,
                $data
            );
        }

        // Get model key name
        $model_key = $model->getKeyName();

        return $this->find($model->{$model_key});
    }

    /**
     * Create a bulk of new model instances in storage from the given data array.
     * Returns true on success, false on failure.
     *
     * @param array $data
     *
     * @return bool
     */
    public function createBulk(array $data): bool
    {
        if (count($data) === 0) {
            return true;
        }

        // Get model fillables and
        // flip them to intersect as keys against model data
        // To avoid unwanted mass assignment
        $flipped_fillable = array_flip($this->model->getFillable());

        foreach ($data as $idx => $model_data) {
            $data[$idx] = array_intersect_key($model_data, $flipped_fillable);

            // Add created_at and updated_at automatically
            $data[$idx][$this->model::CREATED_AT] = now();
            $data[$idx][$this->model::UPDATED_AT] = now();
        }

        // Chunk inserts to a max of 500 items
        // to avoid hitting issues on certain DBs
        $chunked_data = array_chunk(
            $data,
            config('base-classes.create_bulk_chunk_size'),
            true
        );

        foreach ($chunked_data as $_data) {
            // Insert data
            $result = DB::table($this->model->getTable())->insert($_data);

            if ($result === false) {
                return false;
            }
        }

        if (config('journalism.enabled') === true) {
            app(JournalEntryHelper::class)->createJournalEntry(
                'create-bulk',
                null,
                [
                    'target_type'  => $this->model->getTable(),
                    'data'         => $data,
                ]
            );
        }

        return true;
    }
}
