<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToThawaniSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('thawani_settings', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9959598')->references('id')->on('teams');
        });
    }
}
