<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\Api\BilletController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\Api\TypeEventController;
use App\Http\Controllers\Api\OrganisateurController;
use App\Http\Controllers\BilletsAcheteController;
use App\Http\Controllers\FavorieController;
//use App\Http\Controllers\ImageController;
use App\Http\Controllers\PackController;
use App\Models\Event;
use App\Services\CodeGeneratorService;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**Route::middleware('auth:api')->group(function(){
    Route::apiResource('events', EventsController::class);
});*/

Route::post('login', function (Request $request) {

    $name = $request->name;
    $password = sha1($request->password);
    $user=User::where(["name"=>$name, "password"=>$password])->first();
    return $user;

});

Route::post('register', function (Request $request) {

    $codeUser = User::generateCode();

    return User::create([
        'codeUser'=> $codeUser,
        'name'=> $request->name,
        'email'=> $request->email,
        'role_id'=> $request->role_id,
        'api_token'=> Str::random(200),
        'password'=> sha1($request->password),
    ]);


});

Route::post('evenement/updateVue', function (Request $request) {

    return Event::where("codeEvent", $request->codeEvent)->update(['nombreVue' => $request->nombreVue]);
});

Route::post('', [EventsController::class, 'updateVue']);

Route::apiResource('events', EventsController::class);
Route::apiResource('typeEvent', TypeEventController::class);
Route::apiResource('billets', BilletController::class);
Route::post('billets/updateNumber',[ BilletController::class, 'updateBilletNumber']);
Route::apiResource('organisateurs', OrganisateurController::class);
Route::get('organisateur/{codeOrganisateur}', [OrganisateurController::class, 'show']);
Route::apiResource('billetsAchete', BilletsAcheteController::class);
Route::get('organisateurs/getOrganisateurInfoByUserCode/{codeUser}', [OrganisateurController::class, 'getOrganisateurInfoByUserCode']);
Route::apiResource('packs', PackController::class);
Route::apiResource('favories', FavorieController::class);
Route::post('favories/state', [FavorieController::class, 'getLikeState']);

Route::apiResource('commentaires', CommentaireController::class);
Route::get('evenement/typeEvent/{codeTypeCateg}', [EventsController::class, 'eventByCateg'])->name('evenement.eventByCateg');
Route::get('evenement/organisateur/{codeOrganisateur}', [EventsController::class, 'eventByCodeOrga'])->name('evenement.eventByCodeOrga');
Route::get('evenement/tenLastEvents', [EventsController::class, 'getTenLast']);
Route::post('evenement/participants', [EventsController::class, 'addParticipant']);
Route::get('evenement/participantsBillet/{codeUser}', [EventsController::class, 'getParticipantBillets']);
Route::get('evenement/getEventMostVue', [EventsController::class, 'getEventMostVue']);
Route::get('evenement/getEventPasse', [EventsController::class, 'getEventPasse']);

Route::get('billet/{codeEvent}', [BilletController::class, 'getEventBillet']);
Route::get('display/{fileName}', [EventsController::class, 'openFile']);

/*Route::post('image', [ImageController::class, 'save']);
Route::get('image/{file}', [ImageController::class, 'save']);*/




