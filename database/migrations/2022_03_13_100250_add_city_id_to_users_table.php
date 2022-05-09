<?php

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            // $table->foreignId('city_id')->after('email');
            // $table->foreignIdFor(City::class)->after('email');

            // $table->foreignId('city_id')->after('email');
            // $table->foreign('city_id')->on('cities')->references('id');

            $table->foreignId('city_id')->after('email')->constrained();
            // $table->foreignIdFor(City::class)->after('email')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign('users_city_id_foreign');
            $table->dropColumn('city_id');
        });
    }
}
