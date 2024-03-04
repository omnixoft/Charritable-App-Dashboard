<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAyahtsTable extends Migration
{
    public function up()
    {
        Schema::create('ayahts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();
            $table->longText('ayaht')->nullable();
            $table->longText('translation')->nullable();
            $table->string('refrence')->nullable();
            $table->string('refrence_ar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
