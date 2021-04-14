<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventView;
use Illuminate\Http\Request;
use App\Http\Resources\EventResource;
use App\Http\Resources\ParticipantsBilletRessource;
use App\Models\EventParticipant;
use App\Models\ListeParticipant;
use Intervention\Image\Facades\Image;


class EventsController extends Controller
{
    public function index()
    {
        $events = EventResource::collection(EventView::where('isDelete',false)->orderByDesc('created_at')->get())->values();
        return $events;
    }

    public function store(Request $request){

        $codeEvent = Event::generateCode();
        $event= Event::create([
            'codeEvent' => $codeEvent,
            'title' => $request->title,
            'codeTypeEvent' => $request->codeTypeEvent,
            'dateDebut' => $request->dateDebut,
            'dateFin' => $request->dateFin,
            'heureDebut' => $request->heureDebut,
            'heureFin' => $request->heureFin,
            'description' => $request->description,
            'localisation' => $request->localisation,
            'nomLieu' => $request->nomLieu,
            'urlPhotoEvenement' => 'default',
            'adresseLieu' => $request->adresseLieu,
            'ville' => $request->ville,
            'pays' => $request->pays,
            'codeOrganisateur' => $request->codeOrganisateur,

        ]);

        if($request->urlPhotoEvenement != null){
            $imageUrl = $codeEvent.".png";
            $path = public_path().'/telechargements/events/'.$imageUrl;
            Image::make(file_get_contents($request->urlPhotoEvenement))->save($path);
            $event->urlPhotoEvenement = $imageUrl;
        }

        $event->save();

        return $event;

    }

    public function update(Request $request, Event $event)
    {
        if($request->urlPhotoEvenement != null){
            $imageUrl = $event->codeEvent.".png";
            $path = public_path().'/telechargements/events/'.$imageUrl;
            Image::make(file_get_contents($request->urlPhotoEvenement))->save($path);
        }

        $test=$event->update([
            'title' => $request->title,
            'codeTypeEvent' => $request->codeTypeEvent,
            'dateDebut' => $request->dateDebut,
            'dateFin' => $request->dateFin,
            'heureDebut' => $request->heureDebut,
            'heureFin' => $request->heureFin,
            'description' => $request->description,
            'localisation' => $request->localisation,
            'nomLieu' => $request->nomLieu,
            'urlPhotoEvenement' => $imageUrl,
            'adresseLieu' => $request->adresseLieu,
            'ville' => $request->ville,
            'pays' => $request->pays,
            'codeOrganisateur' => $request->codeOrganisateur,
            'nombreVue' => $request->nombreVue
        ]);

        if($test){
            return response()->json([
                'success'=> "L'evenement a été modifié avec succès!"
            ],200);
        }
    }

    public function updateNombreVue($codeEvent, $nombreVue)
    {
        # code...
    }
    public function eventByCateg($codeTypeEvent)
    {
        $events = EventResource::collection(EventView::where(["isDelete"=>false, "codeTypeEvent"=>$codeTypeEvent ])->orderByDesc("created_at")->get())->values();
        return $events;
    }

    public function eventByCodeOrga($codeOrganisateur)
    {
        $events = EventResource::collection(EventView::where(["isDelete"=>false, "codeOrganisateur"=>$codeOrganisateur ])->orderByDesc("created_at")->get())->values();
        return $events;
    }

    public function show($codeEvent)
    {
        $events = EventResource::collection(EventView::where(['isDelete'=>false, 'codeEvent'=>$codeEvent])->orderByDesc('created_at')->get())->values();
        return $events;
    }


    public function getTenLast()
    {
        $now = date('Y-m-d');
        $events = EventResource::collection(EventView::where('isDelete', '=', false)->where('dateFin', '>=', $now)->orderByDesc("created_at")->limit(10)->get())->values();
        return $events;
    }

    public function getEventMostVue()
    {
        $now = date('Y-m-d');
        $events = EventResource::collection(EventView::where('isDelete', '=', false)->where('dateFin', '>=', $now)->orderByDesc("nombreVue")->limit(10)->get())->values();
        return $events;
    }

    public function getEventPasse()
    {
        $now = date('Y-m-d');
        $events = EventResource::collection(EventView::where('isDelete', '=', false)->where('dateFin', '<=', $now)->orderByDesc("nombreVue")->limit(10)->get())->values();
        return $events;
    }

    public function getParticipants($codeEvent)
    {
        return EventParticipant::where('codeEvent',$codeEvent)->orderByAsc('created_at')->get();
    }

    public function addParticipant(Request $request)
    {
        return ListeParticipant::create([
            'codeUser' => $request->codeUser,
            'codeBillet' => $request->codeBillet,
            'nombreBilletAchete' => $request->nombre,
            'nombreBilletRestant' => $request->nombre,
        ]);
    }

    public function getParticipantBillets($codeUser)
    {
        $liste = ListeParticipant::where('codeUser', $codeUser)->orderByDesc('created_at')->get();

        return ParticipantsBilletRessource::collection($liste)->values();
    }




}
