<?php

namespace App\Http\Controllers;

use App\Http\Resources\FavoriesRessource;
use App\Models\Favorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavorieController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->state === 0) {
            $favorie = Favorie::where(["codeEvent"=>$request->codeEvent, "codeUser"=>$request->codeUser ])->get();
            if ($favorie->count() === 0) {
                return 0;
            }else{
                return 1;
            }

        }elseif ($request->state === 1) {
            $favorie = Favorie::where(["codeEvent"=>$request->codeEvent, "codeUser"=>$request->codeUser ])->get();
            if ($favorie->count() === 0) {
                Favorie::create([
                    'codeEvent' => $request->codeEvent,
                    'codeUser' => $request->codeUser,
                ]);
                return 1;
            }else{
                $this->destroy($favorie->values()[0]->id);
                return 0;
            }
        }

    }

    public function getLikeState(Request $request)
    {
        $favorie = Favorie::where(["codeEvent"=>$request->codeEvent, "codeUser"=>$request->codeUser ])->get();

        if ($favorie->count() === 0) {
            return 0;
        }else{
            return 1;
        }
    }


    public function show($codeUser)
    {
        $favorie = FavoriesRessource::collection(Favorie::where("codeUser", $codeUser)->get())->values() ;
        return $favorie;
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorie  $favorie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $favorie = Favorie::find($id);
        if($favorie->delete()){
            return response()->json([
                'success'=> "Le favoris a été supprimé avec succès!"
            ],200);
        };
    }
}
