<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactusesTable extends Migration
{
    public function up()
    {
        Schema::create('contactuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('hot_line')->nullable();
            $table->string('reception_line')->nullable();
            $table->string('address')->nullable();
            $table->string('auditor_service_manager')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->longText('branch')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
