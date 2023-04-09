<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('cd_values', function (Blueprint $table) {
            $table->id();
            $table->string('internalKey', 50)->nullable();
            $table->string('displayName', 100);
            $table->string('description', 300)->nullable();
            $table->integer('internalShortCode')->nullable();
            $table->string('tableName', 50)->nullable();
            $table->integer('weight');
            $table->tinyInteger('rwStatusCd');
            $table->bigInteger('rwCreatedSessionID');
            $table->dateTime('rwCreatedDT');
            $table->dateTime('rwModifiedDT')->nullable();
            $table->bigInteger('rwModifiedSessionID')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('cdTypeUID');
 
           $table->foreign('cdTypeUID')->references('id')->on('cd_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cd_values');
    }
};
