<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTagsTable extends Migration
{
    public function up()
    {
        Schema::create('task_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('team_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
