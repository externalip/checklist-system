<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('revision_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('id')->on('forms');
            $table->integer('amendment_number');
            $table->integer('page_no_affected');
            $table->date('effectivity_date');
            $table->text('description_of_change');
            $table->unsignedBigInteger('originator'); // Foreign key referencing users
            $table->foreign('originator')->references('id')->on('users');
            $table->date('date_issue');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_revision_history');
    }
};
