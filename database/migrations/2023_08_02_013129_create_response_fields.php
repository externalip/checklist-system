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
        Schema::create('response_fields', function (Blueprint $table) {
            $table->id();
            $table->string('response_no');
            $table->bigInteger('form_id')->unsigned();
            $table->foreign('form_id')->references('id')->on('forms');
            $table->bigInteger('submitted_by')->unsigned();
            $table->foreign('submitted_by')->references('id')->on('employees');
            $table->json('response');
            $table->enum('status', ['Pending', 'OK', 'Rejected', 'Cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('response_fields');
    }
};
