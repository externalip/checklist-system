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
        Schema::create('approval_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->unsignedBigInteger('requested_by');
            $table->unsignedBigInteger('draft_change_id');
            $table->foreign('draft_change_id')->references('id')->on('form_draft_changes');
            $table->foreign('form_id')->references('id')->on('forms');
            $table->foreign('requested_by')->references('id')->on('users');
            $table->timestamp('requested_at');
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_requests');
    }
};
