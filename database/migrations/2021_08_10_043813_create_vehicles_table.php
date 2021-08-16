<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('plateNumber');
            $table->float('loadCapacity');
            $table->timestamps();
        });

        Schema::table('deliveries', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();

            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('driver_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        // Create Column Name on Users Table
        Schema::table('users', function (Blueprint $table) {
            $table->string('fullname')->default('N#A');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropForeign('deliveries_vehicle_id_foreign');
            $table->dropForeign('deliveries_driver_id_foreign');

            $table->dropColumn(['vehicle_id', 'driver_id']);
        });

        Schema::dropIfExists('vehicles');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('fullname');
        });
    }
}
