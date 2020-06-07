<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTypeTable extends Migration
{
    public function up(): void
    {
        Schema::create('profile_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('type_id');
            $table->unique(['profile_id', 'type_id']);
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_type');
    }
}
