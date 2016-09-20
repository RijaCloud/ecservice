<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMotoPlaceCaracteristic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lieu_id')->index();
            $table->boolean('garage');
            $table->boolean('personnalisation');
            $table->boolean('accessoires');
            $table->boolean('huiles');
            $table->boolean('pieces');
            $table->boolean('vente_moto');
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
        Schema::drop('moto');
    }
}
