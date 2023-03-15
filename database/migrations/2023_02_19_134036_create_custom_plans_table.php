<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('customer');
            $table->integer('plan');
            $table->integer('subplan');
            $table->integer('category');
            $table->integer('menu');
            $table->dateTime('plan_from');
            $table->dateTime('plan_to');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_plans');
    }
}
