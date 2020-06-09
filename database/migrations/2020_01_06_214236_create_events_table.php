<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('owner_id');
            $table->integer('max_users');
            $table->boolean('public_access');
            $table->boolean('is_active')->default(1);
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('system_id');
            $table->unsignedBigInteger('language_id');
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->foreign('system_id')->references('id')->on('systems')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
}
