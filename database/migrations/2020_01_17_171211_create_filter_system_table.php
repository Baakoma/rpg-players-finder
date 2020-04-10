<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterSystemTable extends Migration
{
    public function up(): void
    {
        Schema::create('filter_system', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('system_id');
            $table->unsignedBigInteger('filter_id');
            $table->unique(['system_id', 'filter_id']);
            $table->foreign('system_id')->references('id')->on('systems')->onDelete('cascade');
            $table->foreign('filter_id')->references('id')->on('filters')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filter_system');
    }
}
