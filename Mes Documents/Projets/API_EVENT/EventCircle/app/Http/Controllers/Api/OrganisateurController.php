<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrganisateurRessource;
use App\Models\Organisateur;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class OrganisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $org = Organisateur::all();
        return OrganisateurRessource::collection($org);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $codeOrganisateur = Organisateur::generateCode();
        $organisateur = Organisateur::create([
            'codeOrganisateur' => $codeOrganisateur,
            'nomOrganisateur' => $request->nomOrganisateur,
            'emailOrganisateur' => $request->emailOrganisateur,
            'telOrganisateur' => $request->telOrganisateur,
            'codeUser' => $request->codeUser,
            'descriptionOrganisateur' => $request->descriptionOrganisateur,
            'packId' => $request->packId
        ]);

        if($request->urlLogoOrganisateur != null){
            $imageUrl = $codeOrganisateur.".png";
            $path = public_path().'/telechargements/logos/'.$imageUrl;
            Image::make(file_get_contents($request->urlLogoOrganisateur))->save($path);
            $organisateur->urlLogoOrganisateur = $imageUrl;
        }

        $organisateur->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($codeOrganisateur)
    {

        return OrganisateurRessource::collection(Organisateur::where('codeOrganisateur',$codeOrganisateur)->get())->values();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Organisateur $organisateur)
    {
        $test= $organisateur->update([
            'nomOrganisateur' => $request->nomOrganisateur,
            'emailOrganisateur' => $request->emailOrganisateur,
            'telOrganisateur' => $request->telOrganisateur,
            'descriptionOrganisateur' => $request->descriptionOrganisateur,
            'urlPhotoOrganisateur' => $request->urlPhotoOrganisateur,
            'packId' => $request->packId
        ]);

        if($test){
            return response()->json([
                'success'=> "L'organisateur a été modifié avec succès!"
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organisateur = Organisateur::find($id);
        if($organisateur->delete()){
            return response()->json([
                'success'=> "L'organisateur a été supprimé avec succès!"
            ],200);
        }
    }

    public function getOrganisateurInfoByUserCode($codeUser)
    {
        return Organisateur::where('codeUser',$codeUser)->first();
    }
}
