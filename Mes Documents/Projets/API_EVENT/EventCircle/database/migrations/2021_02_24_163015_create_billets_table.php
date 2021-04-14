<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billets', function (Blueprint $table) {
            $table->id();
            $table->string('codeBillet')->unique();
            $table->string('codeEvent');
            $table->foreign('codeEvent')->references('codeEvent')->on('events')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nomBillet');
            $table->integer('nombre');
            $table->integer('nombreRestant');
            $table->integer('prix');
            $table->string('descriptionBillet');
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
        Schema::dropIfExists('billets');
    }
}
