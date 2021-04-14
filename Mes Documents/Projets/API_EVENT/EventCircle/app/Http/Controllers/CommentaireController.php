<?php

namespace App\Http\Controllers;

use App\Models\Commentaires;
use App\Models\EventParticipant;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Commentaires::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Commentaires::create([
            'codeUtilisateur' => $request->codeUtilisateur,
            'codeEvent' => $request->codeEvent,
            'commentaire' => $request->commentaire,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request  $request)
    {
        return Commentaires::where(["isDelete"=>false,"codeEvent"=>$request->codeEvent])
                    ->orderByDesc("created_at")
                    ->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commentaire= Commentaires::find($id);
        if($commentaire->delete()){
            return response()->json([
                'success'=> "Le commentaire a été supprimé avec succès!"
            ],200);
        };
    }
}
