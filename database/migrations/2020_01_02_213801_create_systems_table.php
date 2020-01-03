<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemsTable extends Migration
{

    public function up(): Blueprint
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->string('link1');
            $table->string('link2');
            $table->string('link3');
            $table->timestamps();
        });
    }

    public function down(): Blueprint
    {
        Schema::dropIfExists('systems');
    }
}
