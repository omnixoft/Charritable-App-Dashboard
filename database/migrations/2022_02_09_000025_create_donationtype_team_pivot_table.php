<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationtypeTeamPivotTable extends Migration
{
    public function up()
    {
        Schema::create('donationtype_team', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id', 'team_id_fk_5948017')->references('id')->on('teams')->onDelete('cascade');
            $table->unsignedBigInteger('donationtype_id');
            $table->foreign('donationtype_id', 'donationtype_id_fk_5948017')->references('id')->on('donationtypes')->onDelete('cascade');
        });
    }
}
