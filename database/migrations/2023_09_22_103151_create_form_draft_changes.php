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
        Schema::create('form_draft_changes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('id')->on('forms');
            $table->json('form_data'); // Store the form data changes
            $table->string('form_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_draft_changes');
    }
};
