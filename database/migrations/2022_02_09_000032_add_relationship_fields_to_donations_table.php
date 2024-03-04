<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDonationsTable extends Migration
{
    public function up()
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_5923922')->references('id')->on('users');
            $table->unsignedBigInteger('donation_type_id')->nullable();
            $table->foreign('donation_type_id', 'donation_type_fk_5923925')->references('id')->on('donationtypes');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_5948032')->references('id')->on('teams');
            $table->unsignedBigInteger('social_solidarity_id')->nullable();
            $table->foreign('social_solidarity_id', 'social_solidarity_fk_5948033')->references('id')->on('social_solidarities');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_5923930')->references('id')->on('teams');
        });
    }
}
