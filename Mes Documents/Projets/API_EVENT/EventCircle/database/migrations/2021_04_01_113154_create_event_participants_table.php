<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateEventParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW event_participants_views
        AS
        SELECT billet_views.*, user_views.codeUser, user_views.name, user_views.role_name, user_views.role_id, user_views.api_token, liste_participants.nombreBilletAchete, liste_participants.nombreBilletRestant
        FROM  liste_participants
                INNER JOIN user_views ON user_views.codeUser=liste_participants.codeUser
                INNER JOIN billet_views ON billet_views.codeBillet=liste_participants.codeBillet
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_participants');
    }
}
