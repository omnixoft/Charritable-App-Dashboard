<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTeamsTable extends Migration
{
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->unsignedBigInteger('governorate_id')->nullable();
            $table->foreign('governorate_id', 'governorate_fk_5923972')->references('id')->on('governorates');
            $table->unsignedBigInteger('wilayat_id')->nullable();
            $table->foreign('wilayat_id', 'wilayat_fk_5923973')->references('id')->on('wilayats');
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id', 'owner_fk_5923486')->references('id')->on('users');
        });
    }
}
