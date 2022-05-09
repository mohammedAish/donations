<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');//name
            $table->string('gender');
            $table->string('nationality')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('code')->nullable();
            $table->string('id_number');
            $table->string('city')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('relativeـname')->nullable();
            $table->string('phoneـrelative')->nullable();
            $table->string('relative')->nullable();//صلة القرابة
            $table->string('salary')->nullable();
            $table->string('current_job')->nullable();
            $table->string('owner_condition')->nullable();//سبب الحملة أو ماذا يحتاج
            $table->string('id_photo')->nullable();
            $table->string('medical_report')->nullable();
            $table->string('housing_contract')->nullable();
            $table->string('definition_salary')->nullable();
            $table->string('visa_photo')->nullable();
            $table->string('other')->nullable();
            $table->string('status')->default('جديد');
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
        Schema::dropIfExists('applications');
    }
}
