<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListeParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liste_participants', function (Blueprint $table) {
            $table->id();
            $table->string('codeUser');
            $table->foreign('codeUser')->references('codeUser')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('codeBillet');
            $table->foreign('codeBillet')->references('codeBillet')->on('billets')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nombreBilletAchete');
            $table->string('nombreBilletRestant');
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
        Schema::dropIfExists('liste_participants');
    }
}
