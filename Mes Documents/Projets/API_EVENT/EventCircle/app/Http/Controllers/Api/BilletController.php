<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Billet;
use App\Models\BilletAchete;
use App\Models\BilletView;
use App\Models\ListeParticipant;
use Illuminate\Http\Request;

class BilletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $codeBillet = Billet::generateCode();
       return Billet::create([
            'codeBillet' => $codeBillet,
            'codeEvent' => $request->codeEvent,
            'nomBillet' => $request->nomBillet,
            'nombre' => $request->nombre,
            'nombreRestant' => $request->nombreRestant,
            'prix' => $request->prix,
            'descriptionBillet' => $request->descriptionBillet,
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * Recupère tous les billets d'un évènement donné
     */
    public function show(Request $request)
    {
        return BilletView::where(['isDelete'=> false,'codeEvent'=>$request->codeEvent])->orderByDesc('created_at')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Billet $billet)
    {
        $test = $billet->update([
            'nomBillet' => $request->nomBillet,
            'nombre' => $request->nombre,
            'nombreRestant' => $request->nombreRestant,
            'prix' => $request->prix,
            'descriptionBillet' => $request->descriptionBillet,
        ]);
        if($test){
            return response()->json([
                'success'=> "Le billet a été modifié avec succès!"
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
        $billet = Billet::find($id);
        if($billet->delete()){
            return response()->json([
                'success'=> "Le billet a été supprimé avec succès!"
            ],200);
        }
    }

    public function getEventBillet($codeEvent)
    {
        $billets = Billet::where("isDelete", false)->where("codeEvent", $codeEvent)->orderByDesc("created_at")->get();
        return $billets;
    }


    public function updateBilletNumber(Request $request)
    {
       $billet = Billet::where("codeBillet", $request->codeBillet)->get();

       if ($request->nombre > $billet[0]->nombreRestant) {
        return response()->json([
            'status'=> 202,
            'message'=> "Il de reste plus que ". $billet[0]->nombreRestant. " place pour le billet ". $billet[0]->nomBillet
        ],200);

        }else{
            $restant = $billet[0]->nombreRestant - $request->nombre;
            $billet[0]->update(['nombreRestant' => $restant]);

            BilletAchete::create([
                'codeUser' => $request->codeUser,
                'codeBillet' => $request->codeBillet
            ]);

            ListeParticipant::create([
                'codeUser' => $request->codeUser,
                'codeBillet' => $request->codeBillet,
                'nombreBilletAchete' => $request->nombre,
                'nombreBilletRestant' => $request->nombre,
            ]);
            return response()->json([
                'status'=> 200,
                'message'=> "Achat validé !"
            ],200);
        }



    }
}
