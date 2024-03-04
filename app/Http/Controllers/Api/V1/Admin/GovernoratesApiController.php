<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGovernorateRequest;
use App\Http\Requests\UpdateGovernorateRequest;
use App\Http\Resources\Admin\GovernorateResource;
use App\Models\Governorate;
use App\Models\AppVersion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GovernoratesApiController extends Controller
{
   /**
        * @OA\Get(
        * path="/api/v1/governorates",
        * operationId="Get Governorate ",
        * tags={"Governorate"},
        * summary="Get Governorate ",
        * description="Get Governorate",
        *      @OA\Response(
        *          response=200,
        *          description="Governorate Found",
        *       )
        * )
        */
        public function index(Request $request)
        { 
            $gov = Governorate::with("willayats");
           
            if(isset($request->name)){
                $gov->where('name','LIKE','%' .$request->name .'%' );
                $gov->orWhere('name_ar','LIKE','%' .$request->name .'%' );
            }
            if(isset($request->id)){
                $gov->where('id',$request->id);
            }
            $gov = $gov->get(["id","name","name_ar",]);
            if(!$gov->isEmpty()){
                $status = 'success';
                $msg = "Governorate found successfully.";
            }else{
                $status = 'error';
                $msg = 'Governorate not found';
            }
            return response()->json(["status"=>$status,"msg"=>$msg,"data"=>$gov])->setStatusCode(200);
        }

          /**
        * @OA\Get(
        * path="/api/v1/appVersions",
        * operationId="Get App Versions ",
        * tags={"App Versions"},
        * summary="Get App Versions ",
        * description="Get App Versions",
        *      @OA\Response(
        *          response=200,
        *          description="App Versions Found",
        *       )
        * )
        */
        public function appVersions(Request $request)
        { 
            $app = AppVersion::first(["android","ios"]);
            if($app){
                $status = 'success';
                $msg = "App Versions found successfully.";
            }else{
                $status = 'error';
                $msg = 'App Versions not found';
            }
            return response()->json(["status"=>$status,"msg"=>$msg,"data"=>$app])->setStatusCode(200);
        }

}
