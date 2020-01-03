<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageProfileTable extends Migration
{
    public function up(): Blueprint
    {
        Schema::create('language_profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('profile_id');
            $table->timestamps();

            $table->unique(['language_id', 'profile_id']);
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    public function down(): Blueprint
    {
        Schema::dropIfExists('language_profile');
    }
}
