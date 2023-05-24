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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId( 'identifier_definition_id' )->constrained('identifier_definitions')->cascadeOnDelete();
            // $table->morphs('fillable');
            $table->string('label');
            $table->string('dataType');
            $table->string('Regex')->default('/.*/');
            $table->boolean('isRequired');
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
        Schema::dropIfExists('fields');
    }
};
