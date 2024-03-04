<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->integer('amount')->nullable();
            $table->string('number')->nullable();
            $table->integer('transaction_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
