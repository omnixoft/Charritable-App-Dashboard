<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAyahtRequest;
use App\Http\Requests\UpdateAyahtRequest;
use App\Http\Resources\Admin\AyahtResource;
use App\Models\Ayaht;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AyahtsApiController extends Controller
{
    
 /**
        * @OA\Get(
        * path="/api/v1/randomAyahts",
        * operationId="Get Ayahts ",
        * tags={"Ayahts"},
        * summary="Get Ayahts ",
        * description="Get Ayahts",
        *      @OA\Response(
        *          response=200,
        *          description="Ayahts Found",
        *       )
        * )
        */
        public function index()
        { 
            $ayahts = Ayaht::inRandomOrder()->limit(1)->get(["id","title","title_ar","ayaht as ayaht_ar","translation as ayaht","refrence","refrence_ar"]);
           
           
            if(!$ayahts->isEmpty()){
                $status = 'success';
                $msg = "Ayahts found successfully.";
            }else{
                $status = 'error';
                $msg = 'Ayahts not found';
            }
            return response()->json(["status"=>$status,"msg"=>$msg,"data"=>$ayahts])->setStatusCode(200);
        }
}
