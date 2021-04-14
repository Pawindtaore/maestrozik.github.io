<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganisateurRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $base64 = null;
        if ($this->urlLogoOrganisateur != null) {
            $type = pathinfo($this->urlLogoOrganisateur, PATHINFO_EXTENSION);
            $path = public_path().'/telechargements/logos/'.$this->urlLogoOrganisateur;
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        return [
            'codeOrganisateur' => $this->codeOrganisateur,
            'nomOrganisateur' => $this->nomOrganisateur,
            'emailOrganisateur' => $this->emailOrganisateur,
            'telOrganisateur' => $this->telOrganisateur,
            'codeUser' => $request->codeUser,
            'urlLogoOrganisateur' => $base64,
            'descriptionOrganisateur' => $this->descriptionOrganisateur,
            'packId' => $this->packId
        ];

    }
}
