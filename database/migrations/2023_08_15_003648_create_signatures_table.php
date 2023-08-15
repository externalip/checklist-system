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
        /*
            Columns : {
                id -> PK
                user_id -> FK - Nullable
                response_id -> FK
                required_sign_role -> VARCHAR
                status -> enum
                created_at -> datetime
                updated_at -> datetime
            }
        */
        Schema::create('signatures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('response_id');
            $table->string('required_sign_role');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('response_id')->references('id')->on('response_fields');
            $table->enum('status', ['Pending', 'OK', 'Rejected', 'Cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signatures');
    }
};
