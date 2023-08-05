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
        Schema::create('account_has_forms', function (Blueprint $table) {
            $table->BigInteger('user_id')->unsigned();
            $table->BigInteger('form_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('form_id')->references('id')->on('forms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_has_forms');
    }
};
