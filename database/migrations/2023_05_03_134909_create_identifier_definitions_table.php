<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identifier_definitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('sysClassLevelCdVUID');
            $table->string('internalKey', 50); //nullable in revops
            $table->string('shortName', 50);
            // $table->string('longName', 100);
            // $table->string('Mnemonic', 100);
            $table->string('description', 254)->nullable();
            $table->tinyInteger('rwStatusCd')->unsigned()->default(1);
            $table->integer('weight');
            // $table->boolean('IsPrimary')->nullable()->default(0);
            // $table->bigInteger('rwCreatedSessionID');
            // $table->bigInteger('rwModifiedSessionID')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // $table->unique(['sysClassLevelCdVUID', 'weight','Mnemonic']);
            $table->foreign('sysClassLevelCdVUID')->references('id')->on('cd_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identifier_definitions');
    }
};
