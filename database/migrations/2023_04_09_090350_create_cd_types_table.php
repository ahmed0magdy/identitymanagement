<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cd_types', function (Blueprint $table) {
            $table->id();
            $table->string('internalKey', 50)->unique();
            $table->string('displayName', 100);
            $table->string('description', 254)->nullable();
            $table->integer('internalShortCode');
            $table->tinyInteger('rwStatusCd');
            $table->bigInteger('rwCreatedSessionID');
            $table->bigInteger('rwModifiedSessionID')->nullable();
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
        Schema::dropIfExists('cd_types');
    }
};
