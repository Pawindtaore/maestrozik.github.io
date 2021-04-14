<?php

namespace App\Http\Resources;

use App\Models\Billet;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantsBilletRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $billet = Billet::where('codeBillet', $this->codeBillet)->get();
        $event = Event::where('codeEvent', $billet[0]->codeEvent)->get();

        return [
            'codeUser' => $this->codeUser,
            'codeBillet' => $this->codeBillet,
            'nomBillet' => $billet[0]->nomBillet,
            'prixBillet' => $billet[0]->prix,
            'codeEvent' => $event[0]->codeEvent,
            'eventTitle' => $event[0]->title,
            'dateDebut'  => Carbon::parse($event[0]->dateDebut)->translatedFormat('D d M Y'),
            'dateFin'  => Carbon::parse($event[0]->dateFin)->translatedFormat('D d M Y'),
            'nombreBilletAchete' => $this->nombreBilletAchete,
            'nombreBilletRestant' => $this->nombreBilletRestant,
        ];

    }
}
