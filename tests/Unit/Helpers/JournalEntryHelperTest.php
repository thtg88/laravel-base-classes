<?php

namespace Tests\Unit\Helpers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use Thtg88\LaravelBaseClasses\Helpers\JournalEntryHelper;
use Thtg88\LaravelBaseClasses\Models\JournalEntry;
use Thtg88\LaravelBaseClasses\Models\User;
use Thtg88\LaravelBaseClasses\Tests\TestCase;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Models\TestModel;
use Thtg88\LaravelBaseClasses\Tests\TestClasses\Repositories\TestModelRepository;

class JournalEntryHelperTest extends TestCase
{
    private JournalEntryHelper $helper;
    private TestModel $model;

    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../../../database/migrations');

        $this->artisan('migrate', [
            '--path' => [__DIR__.'/../../../database/migrations'],
        ]);

        $this->helper = app()->make(JournalEntryHelper::class);
        $this->model = TestModel::factory()->create();

        // This is so that the correct target type can be set on journal entries table
        Relation::morphMap(['test_models' => TestModel::class]);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Helpers\JournalEntryHelper::createJournalEntry
     */
    public function action_gets_set_test(): void
    {
        $expected = 'ABCD';

        $journal_entry = $this->helper->createJournalEntry($expected);

        $this->assertNotNull($journal_entry);
        $this->assertInstanceOf(JournalEntry::class, $journal_entry);
        $this->assertEquals($expected, $journal_entry->action);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Helpers\JournalEntryHelper::createJournalEntry
     */
    public function user_id_is_null_if_not_logged_in_test(): void
    {
        $expected = null;

        $journal_entry = $this->helper->createJournalEntry('ABCD');

        $this->assertNotNull($journal_entry);
        $this->assertInstanceOf(JournalEntry::class, $journal_entry);
        $this->assertEquals($expected, $journal_entry->user_id);
        $this->assertEquals($expected, $journal_entry->user);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Helpers\JournalEntryHelper::createJournalEntry
     */
    public function content_is_null_if_not_provided(): void
    {
        $expected = null;

        $journal_entry = $this->helper->createJournalEntry('ABCD');

        $this->assertNotNull($journal_entry);
        $this->assertInstanceOf(JournalEntry::class, $journal_entry);
        $this->assertEquals($expected, $journal_entry->content);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Helpers\JournalEntryHelper::createJournalEntry
     */
    public function no_model_does_not_set_target_id_and_target_type_test(): void
    {
        $journal_entry = $this->helper->createJournalEntry('ABCD');

        $this->assertNotNull($journal_entry);
        $this->assertInstanceOf(JournalEntry::class, $journal_entry);
        $this->assertNull($journal_entry->target_id);
        $this->assertNull($journal_entry->target_type);
        $this->assertNull($journal_entry->target);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Helpers\JournalEntryHelper::createJournalEntry
     */
    public function with_model_set_target_id_and_target_type_test(): void
    {
        $actual = $this->helper->createJournalEntry(
            'ABCD',
            $this->model
        );

        $this->assertNotNull($actual);
        $this->assertInstanceOf(JournalEntry::class, $actual);
        $this->assertNotNull($actual->target_id);
        $this->assertNotNull($actual->target_type);
        $this->assertNotNull($actual->target);
        $this->assertTrue($actual->target->is($this->model));
        $this->assertEquals($this->model->id, $actual->target_id);
        $this->assertEquals($this->model->getTable(), $actual->target->getTable());
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Helpers\JournalEntryHelper::createJournalEntry
     */
    public function logged_in_user_gets_set_test(): void
    {
        $expected = User::factory()->create();
        Auth::login($expected);

        $journal_entry = $this->helper->createJournalEntry('ABCD');

        $this->assertNotNull($journal_entry);
        $this->assertInstanceOf(JournalEntry::class, $journal_entry);
        $this->assertEquals($expected->id, $journal_entry->user_id);

        Auth::logout();
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Helpers\JournalEntryHelper::createJournalEntry
     */
    public function content_gets_set(): void
    {
        $expected = ['foo' => 'bar'];

        $journal_entry = $this->helper->createJournalEntry(
            'ABCD',
            null,
            $expected,
        );

        $this->assertNotNull($journal_entry);
        $this->assertInstanceOf(JournalEntry::class, $journal_entry);
        $this->assertIsArray($journal_entry->content);
        $this->assertEquals($expected, $journal_entry->content);
    }

    /**
     * @test
     * @covers \Thtg88\LaravelBaseClasses\Helpers\JournalEntryHelper::createJournalEntry
     */
    public function content_does_not_contain_secret_if_model_provided(): void
    {
        $expected = ['secret' => 'password'];

        $journal_entry = $this->helper->createJournalEntry(
            'ABCD',
            $this->model,
            $expected,
        );

        $this->assertNotNull($journal_entry);
        $this->assertInstanceOf(JournalEntry::class, $journal_entry);
        $this->assertIsArray($journal_entry->content);
        $this->assertFalse(
            array_key_exists('secret', $journal_entry->content)
        );
    }
}
