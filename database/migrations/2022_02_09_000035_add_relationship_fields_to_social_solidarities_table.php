<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSocialSolidaritiesTable extends Migration
{
    public function up()
    {
        Schema::table('social_solidarities', function (Blueprint $table) {
            $table->unsignedBigInteger('donation_type_id')->nullable();
            $table->foreign('donation_type_id', 'donation_type_fk_5924305')->references('id')->on('donationtypes');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_5924311')->references('id')->on('teams');
        });
    }
}
