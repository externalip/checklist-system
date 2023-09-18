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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('role_id')->unsigned();
            // $table->foreign('role_id')->references('id')->on('roles');
            $table->text('first_name');
            $table->text('last_name');
            $table->text('gender');
            $table->date('date_of_birth');
            $table->text('contact');
            $table->text('shift')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
