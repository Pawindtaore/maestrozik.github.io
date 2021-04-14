<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use Illuminate\Http\Request;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pack::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Pack::create([
            'packName' => $request->packName,
            'packDescription' => $request->packDescription,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pack  $pack
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Pack::find($id);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pack  $pack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pack $pack)
    {
        $test= $pack->update([
            'packName' => $request->packName,
            'packDescription' => $request->packDescription,
        ]);
        if($test){
            return response()->json([
                'success'=> "Le pack a été modifié avec succès!"
            ],200);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pack  $pack
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pack = Pack::find($id);
        if($pack->delete()){
            return response()->json([
                'success'=> "Le pack a été supprimé avec succès!"
            ],200);
        };
    }
}
