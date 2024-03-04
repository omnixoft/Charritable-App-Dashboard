<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilayatsTable extends Migration
{
    public function up()
    {
        Schema::create('wilayats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('name_ar')->nullable();
            $table->integer('charges')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
