<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDonationtypeRequest;
use App\Http\Requests\UpdateDonationtypeRequest;
use App\Http\Resources\Admin\DonationtypeResource;
use App\Models\Donationtype;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DonationtypesApiController extends Controller
{
 /**
        * @OA\Get(
        * path="/api/v1/donationTypes",
        * operationId="Get Donation Types",
        * tags={"Charity"},
        * summary="Get Donation Types ",
        * description="Get Donation Types",
        *      @OA\Response(
        *          response=200,
        *          description="Donation Types Found",
        *       )
        * )
        */
        public function index(Request $request)
        {
            $Donationtype = Donationtype::whereNull("deleted_at");

            if(isset($request->limit)){
                $Donationtype->offset($request->offset)->limit($request->limit);
            }
            $Donationtype = $Donationtype->get(["id","type","type_ar"]);
            
            if(!$Donationtype->isEmpty()){
                
                $status = 'success';
                $msg = "Donation type found successfully.";
            }else{
                $status = 'error';
                $msg = 'Donation type not found';
            }
            return response()->json(["status"=>$status,"msg"=>$msg,"data"=>$Donationtype])->setStatusCode(200);
        }
}
