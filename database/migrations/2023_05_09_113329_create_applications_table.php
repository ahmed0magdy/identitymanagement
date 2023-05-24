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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('internalKey', 50);
            $table->unsignedBigInteger('ParentId')->nullable();
            $table->unsignedBigInteger('manufacOrganizationUID')->nullable();
            $table->string('displayName', 100);
            $table->unsignedBigInteger('AppTypeCdVUID');
            $table->string('description', 254)->nullable();
            $table->integer('weight')->default(0);
            $table->tinyInteger('rwStatusCd')->default(1);
            $table->index(['internalKey', 'rwStatusCd'])->unique();
            // $table->bigInteger('rwCreatedSessionID');
            // $table->bigInteger('rwModifiedSessionID')->nullable();
            // $table->softDeletes();
            $table->timestamps();
            $table->foreign('ParentId')->references('id')->on('applications');
            $table->foreign('AppTypeCdVUID')->references('id')->on('cd_values');
            $table->foreign('manufacOrganizationUID')->references('id')->on('organizations');
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
};
