<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateBilletViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW billet_views
        AS
        SELECT event_views.*, billets.codeBillet, billets.nomBillet, billets.nombre, billets.nombreRestant, billets.prix, billets.descriptionBillet, billets.isDelete as isDeleteBillet
        FROM
        event_views
            INNER JOIN billets ON event_views.codeEvent=billets.codeEvent
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billet_views');
    }
}
