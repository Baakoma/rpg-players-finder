<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRpgsystemUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rpgsystem_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rpgsystem_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('lore_knowledge_rating');
            $table->integer('mechanic_knowledge_rating');
            $table->integer('roleplay_rating');
            $table->integer('experience');
            $table->timestamps();

            $table->unique(['rpgsystem_id', 'user_id']);
            $table->foreign('rpgsystem_id')->references('id')->on('rpgsystems')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rpgsystem_user');
    }
}
