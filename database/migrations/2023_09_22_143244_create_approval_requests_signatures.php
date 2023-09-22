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
        Schema::create('approval_requests_signatures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('approval_request_id');
            $table->foreign('approval_request_id')->references('id')->on('approval_requests');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->string('role');
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_requests_signatures');
    }
};
