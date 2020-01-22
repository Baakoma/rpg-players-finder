<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemsTable extends Migration
{

    public function up(): void
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->unique();
            $table->string('description', 500)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('systems');
    }
}
