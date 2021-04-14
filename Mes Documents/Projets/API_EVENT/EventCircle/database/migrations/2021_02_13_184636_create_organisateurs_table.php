<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('codeOrganisateur')->unique();
            $table->string('nomOrganisateur');
            $table->string('emailOrganisateur');
            $table->string('telOrganisateur');
            $table->string('descriptionOrganisateur');
            $table->text('urlLogoOrganisateur')->nullable();
            $table->string('codeUser');
            $table->unsignedBigInteger('packId');
            $table->foreign('packId')->references('id')->on('packs')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('organisateurs');
    }
}
