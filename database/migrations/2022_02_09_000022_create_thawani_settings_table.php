<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThawaniSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('thawani_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url')->nullable();
            $table->string('secret_key')->nullable();
            $table->string('publish_key')->nullable();
            $table->string('customer_id')->nullable();
            $table->integer('is_live')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
