<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('target_id')->nullable();
            $table->string('target_table')->nullable();
            $table->string('action')->nullable()->index();
            $table->text('content')->nullable();
            $table->timestamps();

            $table->index(['target_id', 'target_table']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal_entries');
    }
}
