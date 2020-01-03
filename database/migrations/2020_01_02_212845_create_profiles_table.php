<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    public function up(): Blueprint
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('birth_date');
            $table->integer('sex');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down(): Blueprint
    {
        Schema::dropIfExists('profiles');
    }
}
