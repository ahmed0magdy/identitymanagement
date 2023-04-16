<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
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
            $table->string('internalKey', 50)->unique();
            $table->string('displayName', 100);
            $table->string('description', 300)->nullable();
            $table->integer('internalShortCode');
            $table->string('tableName', 50)->nullable();
            $table->integer('weight');
            $table->tinyInteger('rwStatusCd');
            $table->bigInteger('rwCreatedSessionID');
            $table->bigInteger('rwModifiedSessionID')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('cdTypeUID');

           $table->foreign('cdTypeUID')->references('id')->on('cd_types');
        });

        // Artisan::call('db:seed', [
        //     '--class' => 'CdTypesCdValuesSeeder',
        // ]);
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
