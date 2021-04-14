<?php

namespace Database\Seeders;

use App\Models\Organisateur;
use Illuminate\Database\Seeder;

class OrganisateurTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organisateur::create([
            'codeOrganisateur'=> Organisateur::generateCode(),
            'nomOrganisateur' => 'Lead Communication',
            'emailOrganisateur' => 'Lead@Communication.bf',
            'telOrganisateur' => '+226 67 76 78 72',
            'packId' => 2,
            'codeUser' => 2,
            'descriptionOrganisateur' => 'Lead Communication est spécialiser dans le domaine musical. elle organise des formations',
        ]);

        Organisateur::create([
            'codeOrganisateur'=> Organisateur::generateCode(),
            'nomOrganisateur' => 'Doug Saaga',
            'emailOrganisateur' => 'doug@saaga.bf',
            'packId' => 3,
            'codeUser' => 2,
            'telOrganisateur' => '+226 67 76 78 72',
            'descriptionOrganisateur' => 'Doug Saaga est spécialiser dans le domaine musical. elle organise des formations',
        ]);
    }
}
