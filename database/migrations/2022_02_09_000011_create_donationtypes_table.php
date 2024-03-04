<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationtypesTable extends Migration
{
    public function up()
    {
        Schema::create('donationtypes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('type_ar');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
