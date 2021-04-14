<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        Carbon::setLocale('fr');
        $type = pathinfo($this->urlPhotoEvenement, PATHINFO_EXTENSION);
        $path = public_path().'/telechargements/events/'.$this->urlPhotoEvenement;
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $base64LogoOrga = null;
        if ($this->urlLogoOrganisateur != null) {
            $typeLogoOrga = pathinfo($this->urlLogoOrganisateur, PATHINFO_EXTENSION);
            $pathLogoOrga = public_path().'/telechargements/logos/'.$this->urlLogoOrganisateur;
            $dataLogoOrga = file_get_contents($pathLogoOrga);
            $base64LogoOrga = 'data:image/' . $typeLogoOrga . ';base64,' . base64_encode($dataLogoOrga);
        }

        return [
            'id' => $this->id,
            'codeEvent' => $this->codeEvent,
            'title' => $this->title,
            'codeTypeEvent' => $this->codeTypeEvent,
            'dateDebut' => Carbon::parse($this->dateDebut)->translatedFormat('D d M Y'),
            'dateFin' => Carbon::parse($this->dateFin)->translatedFormat('D d M Y'),
            'heureDebut' => $this->heureDebut,
            'heureFin' => $this->heureFin,
            'description' => $this->description,
            'localisation' => $this->localisation,
            'urlPhotoEvenement' => $base64,
            'nomLieu' => $this->nomLieu,
            'adresseLieu' => $this->adresseLieu,
            'ville' =>$this->ville,
            'pays' => $this->pays,
            'nombreVue' => $this->nombreVue,
            'isDelete' => $this->isDelete,
            'codeOrganisateur' => $this->codeOrganisateur,
            'nomOrganisateur' => $this->nomOrganisateur,
            'emailOrganisateur' => $this->emailOrganisateur,
            'telOrganisateur' => $this->telOrganisateur,
            'descriptionOrganisateur' => $this->descriptionOrganisateur,
            'urlLogoOrganisateur' => $base64LogoOrga,
            'libelleTypeEvent'=> $this->libelleTypeEvent,
            'descriptionTypeEvent'=>$this->descriptionTypeEvent,
            'packId' => $this->packId,
        ];
    }
}
