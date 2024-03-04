<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAlert;
use App\Models\Customer;

class NotificationApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
        * @OA\Get(
        * path="/api/v1/notification/{id}",
        * operationId="GetNotifications",
        * tags={"Notification"},
        * summary="GetNotifications",
        * description="Get Notifications",
        *      @OA\Parameter(
        *          name="id",
        *          description="id",
        *          required=true,
        *          in="path",
        *          @OA\Schema(
        *              type="integer"
        *          )
        *      ),
        *      @OA\Response(
        *          response=200,
        *          description="Notification Found",
        *       )
        * )
    */
    public function index(Request $request)
    {
        $data = Customer::where("id",$request->id)->first();
        $result=[];
        
        if($data){
            if(!$data->userUserAlerts->isEmpty()){
                foreach($data->userUserAlerts as $n){
                    $result[] = ["id"=>$n->id,"title"=>$n->alert_text,"desc"=>$n->alert_link];
                }
            }
           
                $msg="Notification get Successfully";
                $status="success";
        }else{
            $msg="Notification get not Successfully";
            $status="error";
        }
        return response()->json(["status"=>$status,"msg"=>$msg,"data"=>$result])->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
