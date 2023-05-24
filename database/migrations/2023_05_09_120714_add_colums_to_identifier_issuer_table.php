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
        Schema::table('identifier_issuers', function (Blueprint $table) {
            $table->unsignedBigInteger('organizationUID')->nullable();
            $table->unsignedBigInteger('applicationUID')->nullable();
            $table->foreign('organizationUID')->references('id')->on('organizations');
            $table->foreign('applicationUID')->references('id')->on('applications');
            $table->index(['organizationUID','applicationUID','idDefUID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('identifier_issuers', function (Blueprint $table) {
            //
        });
    }
};
