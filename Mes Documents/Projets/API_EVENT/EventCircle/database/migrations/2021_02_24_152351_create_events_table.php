<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('codeEvent')->unique();
            $table->string('title');
            $table->string('codeTypeEvent');
            $table->foreign('codeTypeEvent')->references('codeTypeEvent')->on('type_events')->onDelete('cascade')->onUpdate('cascade');
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->time('heureDebut');
            $table->time('heureFin');
            $table->text('description');
            $table->text('localisation');
            $table->text('urlPhotoEvenement')->default(null);
            $table->string('nomLieu');
            $table->string('adresseLieu');
            $table->string('ville');
            $table->string('pays');
            $table->string('codeOrganisateur');
            $table->foreign('codeOrganisateur')->references('codeOrganisateur')->on('organisateurs')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('nombreVue')->default(0);
            $table->boolean('isDelete')->default(false);
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
        Schema::dropIfExists('events');
    }
}
