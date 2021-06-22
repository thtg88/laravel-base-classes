<?php

namespace Thtg88\LaravelBaseClasses\Repositories;

use Thtg88\Journalism\Models\JournalEntry;

class JournalEntryRepository extends Repository
{
    /** @var string */
    protected static $model_name = 'id';

    /** @var array */
    protected static $order_by_columns = [
        'id' => 'desc',
    ];

    /** @var string[] */
    protected static $search_columns = [];

    /** @var string[] */
    protected static $filter_columns = [];

    /**
     * Create a new repository instance.
     *
     * @param \Thtg88\Journalism\Models\JournalEntry $journal_entry
     *
     * @return void
     */
    public function __construct(JournalEntry $journal_entry)
    {
        $this->model = $journal_entry;

        parent::__construct();
    }
}
