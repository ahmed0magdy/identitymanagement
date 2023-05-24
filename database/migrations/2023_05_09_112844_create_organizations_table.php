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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('internalKey', 60);
            $table->unsignedBigInteger('ParentId')->nullable();
            $table->string('displayName', 100);
            $table->unsignedBigInteger('TypeCdVUID');
            $table->string('description', 255)->nullable();
            $table->boolean('isLocation')->default(false);
            $table->integer('weight')->default(0);
            $table->tinyInteger('rwStatusCd')->default(1);
            $table->index(['internalKey', 'rwStatusCd'])->unique();
            // $table->boolean('isCurrent');
            $table->date('startDT')->nullable();
            $table->date('stopDT')->nullable();
            // $table->bigInteger('rwCreatedSessionID');
            // $table->bigInteger('rwModifiedSessionID')->nullable();
            // $table->tinyInteger('included');
            // $table->softDeletes();
            $table->timestamps();
            $table->foreign('ParentId')->references('id')->on('organizations');
            $table->foreign('TypeCdVUID')->references('id')->on('cd_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
};
