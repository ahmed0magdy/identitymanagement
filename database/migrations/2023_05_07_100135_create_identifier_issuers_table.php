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
        Schema::create('identifier_issuers', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('idDefUID');
            // $table->unsignedBigInteger('organizationUID')->nullable();
            // $table->unsignedBigInteger('applicationUID')->nullable();
            $table->tinyInteger('rwStatusCd')->unsigned()->default(1);
            // $table->bigInteger('rwCreatedSessionID');
            // $table->bigInteger('rwModifiedSessionID')->nullable();
            $table->boolean('IsPrimary')->nullable()->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idDefUID')->references('id')->on('identifier_definitions');
            // $table->foreign('organizationUID')->references('id')->on('organizations');
            // $table->foreign('applicationUID')->references('id')->on('applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('IdentifierIssuer', function (Blueprint $table) {
        //     $table->dropForeign(['idDefUID']);
        //     $table->dropForeign(['organizationUID']);
        //     $table->dropForeign(['applicationUID']);
        //     $table->dropForeign(['locationHierarchyNodeUID']);
        // });

        Schema::dropIfExists('identifier_issuers');
    }
};
