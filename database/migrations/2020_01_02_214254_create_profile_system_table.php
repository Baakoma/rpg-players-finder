<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileSystemTable extends Migration
{
    public function up(): void
    {
        Schema::create('profile_system', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('system_id');
            $table->integer('lore_knowledge_rating');
            $table->integer('mechanic_knowledge_rating');
            $table->integer('roleplay_rating');
            $table->integer('experience');
            $table->unique(['profile_id', 'system_id']);
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('system_id')->references('id')->on('systems')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_system');
    }
}
