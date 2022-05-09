<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundRaisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_raisers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('intro');
            $table->string('desc');
            $table->string('image');
            $table->string('price');
            $table->string('raised')->default(0);
            $table->enum('type', ['special', 'public'])->default('public');
            $table->string('owner')->default('owner');
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
        Schema::dropIfExists('fund_raisers');
    }
}
