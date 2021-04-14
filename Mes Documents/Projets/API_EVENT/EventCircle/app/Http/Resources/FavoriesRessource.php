<?php

namespace App\Http\Resources;

use App\Models\Event;
use App\Models\EventView;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriesRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $event = EventResource::collection(EventView::where(["isDelete"=>false, "codeEvent"=>$this->codeEvent ])->get())->values();

        Carbon::setLocale('fr');
        $type = pathinfo($event[0]->urlPhotoEvenement, PATHINFO_EXTENSION);
        $path = public_path().'/telechargements/events/'.$event[0]->urlPhotoEvenement;
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);


        return [
            'codeEvent' => $this->codeEvent,
            'title' => $event[0]->title,
            'libelleTypeEvent' => $event[0]->libelleTypeEvent,
            'dateDebut' => Carbon::parse($event[0]->dateDebut)->translatedFormat('D d M Y'),
            'heureDebut' => $event[0]->heureDebut,
            'urlPhotoEvenement' => $base64
        ];
    }
}
