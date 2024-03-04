<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWilayatRequest;
use App\Http\Requests\UpdateWilayatRequest;
use App\Http\Resources\Admin\WilayatResource;
use App\Models\Wilayat;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WilayatsApiController extends Controller
{
  
/**
        * @OA\Get(
        * path="/api/v1/wilayats",
        * operationId="Get Wilayat ",
        * tags={"Wilayat"},
        * summary="Get Wilayat ",
        * description="Get Wilayat",
        *      @OA\Response(
        *          response=200,
        *          description="Wilayat Found",
        *       )
        * )
        */
        public function index(Request $request)
        { 
            $wilayat = Wilayat::whereNull("deleted_at");
            if($request->governorate_id){
               $wilayat->where("governorate_id",$request->governorate_id);
            }
            if(isset($request->name)){
                $wilayat->where('name','LIKE','%' .$request->name .'%' );
                $wilayat->orWhere('name_ar','LIKE','%' .$request->name .'%' );
            }
            $wilayat = $wilayat->get(["id","name","name_ar","governorate_id"]);
            if(!$wilayat->isEmpty()){
                $status = 'success';
                $msg = "Wilayat found successfully.";
            }else{
                $status = 'error';
                $msg = 'Wilayat not found';
            }
            return response()->json(["status"=>$status,"msg"=>$msg,"data"=>$wilayat])->setStatusCode(200);
        }
}
