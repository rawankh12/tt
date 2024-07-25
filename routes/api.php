<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Black_ListController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\PriceTripController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RequirementsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ResignationController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\Ship_Goods_ReqController;
use App\Http\Controllers\TransportingController;
use App\Http\Controllers\Trip_RequestController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\WaletSectController;
use App\Http\Controllers\WaletUserController;
use App\Models\Price_Trip;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class , 'register']);
Route::post('/login', [AuthController::class , 'login']);
Route::post('/logout', [AuthController::class , 'logout']);
Route::post('/deleted', [AuthController::class , 'deleted']);


Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::group(['middleware' => ['CheckAdmin']], function(){

        Route::get('/index_users',[AuthController::class,'index']);

    Route::post('/create_section', [SectionController::class , 'create']);
    Route::post('/update_section', [SectionController::class , 'update']);
    Route::post('/destroy_section', [SectionController::class , 'destroy']);

    Route::post('/insert_black/{user_id}', [Black_ListController::class , 'insert']);
    Route::get('/index_se_black', [Black_ListController::class , 'index_section_black']);
    Route::get('/index_block', [Black_ListController::class , 'index_block']);
    Route::post('/edit_black', [Black_ListController::class , 'edit_Black']);
    Route::post('/edit_Block', [Black_ListController::class , 'edit_Block']);
    Route::post('/destroy_Black/{id}', [Black_ListController::class , 'destroy_Black']);


    Route::post('/create_transporting', [TransportingController::class , 'create']);
    Route::post('/update_transporting',[TransportingController::class , 'update']);
    Route::post('/destroy_transporting', [TransportingController::class , 'destroy']);


    Route::post('/insert_report',[RaportController::class , 'insert']);

    Route::post('/create_resignation', [ResignationController::class , 'create']);
    Route::post('/destroy_resignation',[ResignationController::class , 'destroy']);
    Route::get('/show_resignation/{id}',[ResignationController::class , 'show']);

    Route::get('/show_Walet_s',[WaletSectController::class , 'show']);

    Route::post('/destroy_com', [ComplaintController::class , 'destroy']);

    Route::post('/create_trip', [TripController::class , 'create']);

    Route::post('/create_price', [PriceTripController::class , 'create']);
    Route::post('/update_price',[PriceTripController::class , 'update']);
    });
    Route::group(['middleware' => ['CheckUser']], function(){

        Route::post('/create_ship', [Ship_Goods_ReqController::class , 'create']);

        Route::post('/create_trip_r', [Trip_RequestController::class , 'create']);
        Route::post('/update_trip_r',[Trip_RequestController::class , 'update']);

        Route::post('/create_com', [ComplaintController::class , 'create']);
        Route::post('/update_com',[ComplaintController::class , 'update']);

        Route::post('/insert_rate', [RateController::class , 'insert']);
        Route::post('/update_rate',[RateController::class , 'update']);

        Route::post('/accept_trip_sh', [Trip_RequestController::class , 'accept_trip']);
        Route::post('/cancle_trip_sh', [Trip_RequestController::class , 'cancle_trip']);

        Route::post('/add_Walet_u',[WaletUserController::class , 'add']);
        Route::get('/show_Walet_u',[WaletUserController::class , 'show']);


    });
    Route::get('/index_requirements',[RequirementsController::class , 'index']);
    Route::get('/show_requirements/{id}', [RequirementsController::class , 'show']);
    Route::post('/create_requirements', [RequirementsController::class , 'create']);
    Route::post('/update_requirements',[RequirementsController::class , 'update']);
    Route::post('/destroy_requirements', [RequirementsController::class , 'destroy']);
    ///////////////////////////////////////
    Route::get('/index_transporting',[TransportingController::class , 'index']);
    Route::get('/show_transporting/{id}', [TransportingController::class , 'show']);
    ////////////////////////////////////////
    Route::get('/index_trip',[TripController::class , 'index']);
    Route::post('/update_trip',[TripController::class , 'update']);
    Route::get('/show_trip/{id}', [TripController::class , 'show']);
    Route::post('/destroy_trip', [TripController::class , 'destroy']);
    /////////////////////////////////////////
    Route::get('/index_trip_r',[Trip_RequestController::class , 'index']);
    Route::get('/show_trip_r/{id}', [Trip_RequestController::class , 'show']);
    Route::post('/destroy_trip_r', [Trip_RequestController::class , 'destroy']);
    /////////////////////////////////////////
    Route::post('/show_section', [SectionController::class , 'show']);
    Route::get('/index_section',[SectionController::class , 'index']);
    /////////////////////
    Route::get('/index_t',[TripController::class , 'index_t']);
    ////////////////////////////////
    Route::post('/create_Res', [ReservationController::class , 'create']);
    Route::post('/update_Res',[ReservationController::class , 'update']);
    Route::get('/index_Res', [ReservationController::class , 'index']);
    Route::get('/show_Res/{id}',[ReservationController::class , 'show']);
    Route::post('/destroy_Res', [ReservationController::class , 'destroy']);
    ///////////////
    Route::get('/searchbysection/{name}', [TripController::class , 'searchbysection']);
    Route::get('/searchbydate/{date}', [TripController::class , 'searchbydate']);
    Route::get('/searchbytime/{time}', [TripController::class , 'searchbytime']);
    Route::get('/indextrip_res', [TripController::class , 'indextrip_res']);
    ////////////////////////////////
    Route::post('/update_ship',[Ship_Goods_ReqController::class , 'update']);
    Route::get('/index_ship', [Ship_Goods_ReqController::class , 'index']);
    Route::get('/show_ship/{id}',[Ship_Goods_ReqController::class , 'show']);
    Route::post('/destroy_ship', [Ship_Goods_ReqController::class , 'destroy']);
    ////////////////////
    Route::get('/index_com', [ComplaintController::class , 'index']);
    Route::get('/show_com/{id}',[ComplaintController::class , 'show']);
    ///////////////////////////
    Route::get('/show_price/{id}',[PriceTripController::class , 'show_p']);
    ///////////////////////////////



});
