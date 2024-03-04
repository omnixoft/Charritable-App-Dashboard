<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\Donation;
use App\Models\Team;
use App\Models\Customer;
use App\Models\SocialSolidarity;
use App\Models\Task;
class HomeController
{
    public function index()
    {
        $total_donation= 0;
        
        $donation_total=Donation::orderBy("id","desc");
        if(auth()->user()->id!=1 OR auth()->user()->team_id!=''){
            $donation_total->where("company_id",auth()->user()->team_id);
        }
        $donation_total = $donation_total->get();
        // print_r($donation_total);
        // die();
        if(!empty($donation_total))
        {
         foreach($donation_total as $d){
             $total_donation+=$d['amount'];
         }
        }

        $count_number_charity=0;
        $number_charity=Team::whereNull("deleted_at");
        if(auth()->user()->id!=1 OR auth()->user()->team_id!=''){
            $number_charity->where("id",auth()->user()->team_id);
        }
        $number_charity = $number_charity->count();
        if($number_charity>0)
        {
           $count_number_charity=$number_charity;
        }
            $settings1 = [
                'chart_title'=>'Charities',
                'total_donation'=>$total_donation,
                'count_number_charity'=>$count_number_charity
            ];

        $count_client= 0;
        $number_clients=Customer::count();
        if($number_clients>0)
        {
           $count_client=$number_clients;
        }
            $settings2 = [
                'chart_title'=>'Users',
                'count_client'=>$count_client
            ];

        $count_donation= 0;
        $number_donations=Donation::orderBy("id","desc");
        if(auth()->user()->id!=1 OR auth()->user()->team_id!=''){
            $number_donations->where("company_id",auth()->user()->team_id);
        }
        $number_donations = $number_donations->count();
        if($number_donations>0)
        {
           $count_donation=$number_donations;
        }
            $settings3 = [
                'chart_title'=>'Donations',
                'count_donation'=>$count_donation
            ];

        $count_social_solidarity= 0;
        $number_solidarity=SocialSolidarity::whereNull("deleted_at");
        if(auth()->user()->id!=1 OR auth()->user()->team_id!=''){
            $number_solidarity->where("team_id",auth()->user()->team_id);
        }
        $number_solidarity = $number_solidarity->count();
        if($number_solidarity>0)
        {
           $count_social_solidarity=$number_solidarity;
        }
            $settings4 = [
                'chart_title'=>'Social Solidarities',
                'count_social_solidarity'=>$count_social_solidarity
            ];

        $user_list = Customer::limit(5)->orderBy('id', 'DESC')->get();

        $donation_list = Donation::limit(5)->orderBy('id', 'DESC');
        if(auth()->user()->id!=1 OR auth()->user()->team_id!=''){
            $donation_list->where("company_id",auth()->user()->team_id);
        }
        $donation_list = $donation_list->get();
        $todo_list = Task::with(['status', 'tags', 'assigned_to', 'media'])->limit(5)->orderBy('id', 'DESC');
        if(auth()->user()->id!=1 OR auth()->user()->team_id!=''){
            $todo_list->where("team_id",auth()->user()->team_id);
        }
        $todo_list = $todo_list->get();
        return view('home', compact('settings1', 'settings2', 'settings3', 'settings4','user_list','donation_list','todo_list'));
    }

    public function latestDonation(){
         $donation =Donation::limit(10)->orderBy('id', 'DESC');
         if(auth()->user()->id!=1 OR auth()->user()->team_id!=''){
            $donation->where("company_id",auth()->user()->team_id);
         }
        $donation = $donation->get();
                 $donation->load([
                                'customer'=> function ($query) {
                                    $query->withTrashed();
                                },
                            ]);
            $response = [];
            foreach($donation as $d){
            if($d->customer)
            {
                if($d->customer->profile)
                {
                   $img=($d->customer->profile ? $d->customer->profile->getUrl('thumb') : '');
                }else{
                     $img=asset("public/logo.png");
                }
                  $imgData='<div class="avatar-wrapper">
                        <div class="avatar bg-light-success mr-50">
                        <a href="'.$img.'" target="_blank" style="display: inline-block">
                        <img class="" src="'.$img.'" width="42" height="42" alt="img" />
                        </a>
                        </div>
                    </div>';
            }else{
                $imgData="";
            }
            if($d->company)
            {
                if($d->company->logo)
                {
                   $img1=($d->company->logo ? $d->company->logo->getUrl('thumb') : '');
                }else{
                     $img1=asset("public/logo.png");
                }
                  $imgData1='<div class="avatar-wrapper">
                        <div class="avatar bg-light-success mr-50">
                        <a href="'.$img1.'" target="_blank" style="display: inline-block">
                        <img class="" src="'.$img1.'" width="42" height="42" alt="img" />
                        </a>
                        </div>
                    </div>';
            }else{
                $imgData1="";
            }
            $response[] = [
                    'nu'=>'&nbsp;',    
                    'id'=>$d->id ?? '',
                    'customerDetails'=>'<div class="d-flex justify-content-left align-items-center">'.$imgData.'<div class="d-flex flex-column"style="margin-left:1px;"><h6 class="user-name text-truncate mb-0">'.(isset($d->customer->name) ? $d->customer->name : '').'</h6>
                    <small class="text-truncate text-info">'.(isset($d->customer->email) ? $d->customer->email : '').'</small>
                    </div>
                    </div>',
                    'social'=>$d->social_solidarity->title ?? '',
                    'date'=>date("m/d/Y",strtotime($d->date ?? '')),
                    'amount'=> $d->amount!='' ? getOmr($d->amount) : '',
                    'donation_type'=>$d->donation_type->type ?? '',
                    'number'=>$d->number!='' ? getNum($d->number) : '',
                    'charity'=>'<div class="d-flex justify-content-left align-items-center">'.$imgData1.'<div class="d-flex flex-column"style="margin-left:1px;"><h6 class="user-name text-truncate mb-0">'.(isset($d->company->name) ? $d->company->name : '').'</h6>
                    <small class="text-truncate text-info">'.(isset($d->company->name_ar) ? $d->company->name_ar : '').'</small>
                    </div>
                    </div>'
                    ];
            }
          return json_encode(['data' => $response]);
    }
}
