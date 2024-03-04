<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContactUsRequest;
use App\Http\Requests\StoreContactUsRequest;
use App\Http\Requests\UpdateContactUsRequest;
use App\Models\ContactUs;
use Gate;
use App\Models\Team;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contact_us_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
         $data=ContactUs::first();
         if(!$data){ 
            $branches = ''; 
         }else{
            $branches = unserialize($data->branch); 
         }
        return view('admin.contactuses.index', compact('data',"branches"));
    }

    public function create()
    {
        abort_if(Gate::denies('contact_us_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.contactuses.create');
    }

    public function store(Request $request)
    {           
        $branches = [];
        for($a=0;$a<3;$a++){
            
            //get address lat,lng
            $address=$_POST["branchaddress"][$a];
            if($address!=''){

                $json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key=AIzaSyAyhvBo01uEPaA_hveasggrIgMctN6kam8');
                $output= (array)json_decode($json,200);
                if (!empty($output['results'])){
                    $add_lat=$output['results'][0]['geometry']['location']['lat'];
                    $add_lng=$output['results'][0]['geometry']['location']['lng'];
                }
            }else{
                $add_lat='';
                $add_lng='';
            }
            
            $branches[] = [
                "name"=>$_POST["branchName"][$a],
                "branchaddress"=>$_POST["branchaddress"][$a],
                "telephone"=>$_POST["telephone"][$a],
                "pobox"=>$_POST["pobox"][$a],
                "postalcode"=>$_POST["postalcode"][$a],
                "branchemail"=>$_POST["branchemail"][$a],
                "lat"=>$add_lat,
                "lng"=>$add_lng,
            ];
        }   
        $contactuses=ContactUs::first();    
         if(!$contactuses){ 
                $contactuses = new ContactUs();
         }
            $contactuses->title = $request->input('title');
            $contactuses->title_ar = $request->input('title_ar');
            $contactuses->hot_line = $request->input('hot_line');
            $contactuses->reception_line = $request->input('reception_line');
            $contactuses->address = $request->input('address');
            $contactuses->auditor_service_manager = $request->input('auditor_service_manager');
            $contactuses->fax = $request->input('fax');
            $contactuses->branch = serialize($branches);
            $contactuses->email = $request->input('email');
            // $contactuses->team_id = $id;
            $contactuses->save();
         return redirect()->route('admin.contactuses.index');
    }

    public function edit(ContactUs $contactUs)
    {
        abort_if(Gate::denies('contact_us_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactUs->load('team');

        return view('admin.contactuses.edit', compact('contactUs'));
    }

    public function update(UpdateContactUsRequest $request, ContactUs $contactUs)
    {
        $contactUs->update($request->all());

        return redirect()->route('admin.contactuses.index');
    }

    public function show(ContactUs $contactUs)
    {
        abort_if(Gate::denies('contact_us_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactUs->load('team');

        return view('admin.contactuses.show', compact('contactUs'));
    }

    public function destroy(ContactUs $contactUs)
    {
        abort_if(Gate::denies('contact_us_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactUs->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactUsRequest $request)
    {
        ContactUs::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
