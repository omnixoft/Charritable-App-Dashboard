<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateThawaniSettingRequest;
use App\Models\ThawaniSetting;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ThawaniSettingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('thawani_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

         $team = Team::where("owner_id",Auth()->user()->id)->first();
         if($team){
            $id = $team->id;
         }else{
             $id = Auth()->user()->team_id;
         }
         $data =ThawaniSetting::where('team_id',$id)->first();
        return view('admin.thawaniSettings.index',compact('data'));
    }

    public function insert(Request $request)
    {
         $team = Team::where("owner_id",Auth()->user()->id)->first();
               $c_id = '';
         if($team){
            $id = $team->id;
            $body = '{
               "client_customer_id":"'.str_replace(' ','',$team->name).'",
         }';
            $res = CurlApi('https://uatcheckout.thawani.om/api/v1/customers','rRQ26GcsZzoEhbrP2HZvLYDbn9C9et',$body);
         //  echo '<pre>';
            $res = json_decode($res);
         //  print_r($res);
            if($res->success==1){
               $c_id =  $res->data->id;
            }
         }else{
             $id = Auth()->user()->team_id;
         }
         if(isset($request->id)){ 
            $thawanisetting=ThawaniSetting::find($request->id);    
         }else{
                $thawanisetting = new ThawaniSetting();
         }
         
        //  die();
         
            $thawanisetting->url = $request->input('url');
            $thawanisetting->secret_key = $request->input('secret_key');
            $thawanisetting->publish_key = $request->input('publish_key');
            $thawanisetting->is_live = $request->input('is_live');
            $thawanisetting->customer_id = $c_id;
            $thawanisetting->team_id = $id;
            $thawanisetting->save();
            return redirect()->route('admin.thawani-settings.index');
    }
}
