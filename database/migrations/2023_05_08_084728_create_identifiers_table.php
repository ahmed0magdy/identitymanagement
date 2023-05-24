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
        Schema::create('identifiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('identifier_issuer_id')->constrained('identifier_issuers')->cascadeOnDelete();
            $table->morphs('identifiers');
            // $table->integer('weight');
            $table->unique(['identifier_issuer_id', 'identifiers_id', 'identifiers_type']);
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
        Schema::dropIfExists('identifiers');
    }
};
