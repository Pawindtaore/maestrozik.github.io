<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateEventViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE OR REPLACE VIEW event_views
        AS
        SELECT events.*, type_events.libelleTypeEvent, type_events.descriptionTypeEvent, organisateurs.nomOrganisateur, organisateurs.emailOrganisateur, organisateurs.telOrganisateur, organisateurs.descriptionOrganisateur, organisateurs.urlLogoOrganisateur, organisateurs.packId
        FROM
            events
            INNER JOIN type_events ON type_events.codeTypeEvent=events.codeTypeEvent
            INNER JOIN organisateurs ON organisateurs.codeOrganisateur=events.codeOrganisateur
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_views');
    }
}
