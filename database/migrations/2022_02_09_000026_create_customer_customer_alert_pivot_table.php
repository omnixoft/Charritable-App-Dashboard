<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerCustomerAlertPivotTable extends Migration
{
    public function up()
    {
        Schema::create('customer_customer_alert', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_alert_id');
            $table->foreign('customer_alert_id', 'customer_alert_id_fk_5923491')->references('id')->on('customer_alerts')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id', 'customer_id_fk_5923491')->references('id')->on('customers')->onDelete('cascade');
            $table->boolean('read')->default(0);
        });
    }
}
