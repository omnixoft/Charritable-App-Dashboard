<?php

namespace App\Http\Controllers\admin;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppVersion;
use Illuminate\Support\Facades\DB;

class Version_SettingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('app_version_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
         $data =AppVersion::first(["android","ios"]);
        return view('admin.app-version-settings.index',compact('data'));
    }

    public function insert(Request $request)
    {
         $app_version = AppVersion::first();
         if(!$app_version){
            $app_version = new AppVersion();
         }
         $app_version->android =$request->input('android');
         $app_version->ios =$request->input('ios');
         $app_version->save();

         if ($app_version) {

             return redirect()->route('admin.app-version-settings.index');
         }
    }
}
