<?php

namespace Thtg88\LaravelBaseClasses\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Thtg88\LaravelBaseClasses\Models\JournalEntry;
use Thtg88\LaravelBaseClasses\Repositories\JournalEntryRepository;

/**
 * Helper methods for journal entry.
 */
class JournalEntryHelper
{
    /**
     * The journal entry repo implementation.
     *
     * @var \Thtg88\LaravelBaseClasses\Repositories\JournalEntryRepository
     */
    protected $journal_entries;

    /**
     * Create a new helper instance.
     *
     * @param \Thtg88\LaravelBaseClasses\Repositories\JournalEntryRepository $journal_entries
     *
     * @return void
     */
    public function __construct(JournalEntryRepository $journal_entries)
    {
        $this->journal_entries = $journal_entries;
    }

    /**
     * Create a new journal entry instance in storage.
     *
     * @param string                                   $action  The action performing while creating the entry.
     * @param \Illuminate\Database\Eloquent\Model|null $model   The model the action is performed on.
     * @param array|null                               $content The action content data.
     *
     * @return \Thtg88\LaravelBaseClasses\Models\JournalEntry
     */
    public function createJournalEntry(
        string $action,
        ?Model $model = null,
        ?array $content = null
    ): JournalEntry {
        $target_type = $this->getTargetType($model);
        $id = $model->id ?? null;

        // Get current authenticated user
        $user = auth()->user();

        // Build data array to save journal entry
        $data = [
            'target_id'    => $id,
            'target_type'  => $target_type,
            'action'       => $action,
        ];

        if ($user !== null) {
            $data['user_id'] = $user->id;
        }

        if ($content === null) {
            return $this->journal_entries->create($data);
        }

        // Remove hidden attributes from being posted in the journals (e.g. password)
        if ($model !== null) {
            $content = array_diff_key(
                $content,
                array_flip($model->getHidden())
            );
        }

        $data['content'] = $content;

        return $this->journal_entries->create($data);
    }

    private function getTargetType(?Model $model): ?string
    {
        if ($model === null) {
            return null;
        }

        // Get model class name
        $class_name = get_class($model);

        // Get morph map
        $morph_map = Relation::morphMap();

        // Get target table for model
        $target_type = array_search($class_name, $morph_map);

        if ($target_type === false) {
            return null;
        }

        return $target_type;
    }
}
