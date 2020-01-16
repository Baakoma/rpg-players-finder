<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{

    public function up(): void
    {
        Schema::create('links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('system_id');
            $table->string('name');
            $table->string('url');
            $table->timestamps();

            $table->foreign('system_id')
                ->references('id')
                ->on('systems')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('links');
    }
}
