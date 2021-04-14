<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeEvent;

class TypeEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TypeEvent::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $codeEvent = TypeEvent::generateCode();
        TypeEvent::create([
            'codeTypeEvent' => $codeEvent,
            'libelleTypeEvent' => $request->libelleTypeEvent,
            'descriptionTypeEvent' => $request->descriptionTypeEvent

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $typeEvents = TypeEvent::where("codeTypeEvent", $id)->orderByDesc("created_at")->get();
        return $typeEvents;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,TypeEvent $typeEvent)
    {
        $test= $typeEvent->update([
            'libelleTypeEvent' => $request->libelleTypeEvent,
            'descriptionTypeEvent' => $request->descriptionTypeEvent
        ]);
        if($test){
            return response()->json([
                'success'=> "Le type d'évènement a été modifié avec succès!"
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
        $typeEvent = TypeEvent::find($id);
        if($typeEvent->delete()){
            return response()->json([
                'success'=> "Le type d'évènement a été supprimé avec succès!"
            ],200);
        }
    }
}
