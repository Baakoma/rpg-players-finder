<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageTicketTable extends Migration
{
    public function up(): void
    {
        Schema::create('language_ticket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('ticket_id');
            $table->unique(['language_id', 'ticket_id']);
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('language_ticket');
    }
}
