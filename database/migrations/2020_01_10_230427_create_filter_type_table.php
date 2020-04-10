<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterTypeTable extends Migration
{
    public function up(): void
    {
        Schema::create('filter_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('filter_id');
            $table->unsignedBigInteger('type_id');
            $table->unique(['filter_id', 'type_id']);
            $table->foreign('filter_id')->references('id')->on('filters')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filter_type');
    }
}
