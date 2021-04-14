<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->string('codeUser');
            $table->foreign('codeUser')->references('codeUser')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('codeEvent');
            $table->foreign('codeEvent')->references('codeEvent')->on('events')->onDelete('cascade')->onUpdate('cascade');
            $table->text('commentaire');
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
        Schema::dropIfExists('commentaires');
    }
}
