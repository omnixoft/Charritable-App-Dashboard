<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\SocialSolidarity;
use App\Models\Donationtype;
use App\Models\Team;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function donationRecord()
    {
        $donation = Donationtype::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');
        $charity = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.reports.donationReport', compact('donation','charity'));
    }
    public function donationReport(Request $request)
    {
        if ($request->ajax()) {
            $donation = Donation::where('donations.social_solidarity_id', null)->orderBy('id', 'DESC');
            if (isset(request()->company_id)) {
                $donation->where('company_id', $request->company_id);
            }
            if (isset(request()->social_id)) {
                $donation->where('donation_type_id', $request->social_id);
            }
            if (isset(request()->date_from)) {
                $donation->whereDate('date', '>=', date('Y-m-d', strtotime($request->date_from)));
            }
            if (isset(request()->date_to)) {
                $donation->whereDate('date', '<=', date('Y-m-d', strtotime($request->date_to)));
            }
            if (auth()->user()->id != 1 or auth()->user()->team_id != '') {
                $donation->where("company_id", auth()->user()->team_id);
            }
            $donation = $donation->get();
            $donation->load([
                'customer' => function ($query) {
                    $query->withTrashed();
                },
            ]);
            $response = [];
            foreach ($donation as $d) {
                if ($d->customer) {
                    if ($d->customer->profile) {
                        $img = ($d->customer->profile ? $d->customer->profile->getUrl('thumb') : '');
                    } else {
                        $img = asset("public/logo.png");
                    }
                    $imgData = '<div class="avatar-wrapper">
                        <div class="avatar bg-light-success mr-50">
                        <a href="' . $img . '" target="_blank" style="display: inline-block">
                        <img class="" src="' . $img . '" width="42" height="42" alt="img" />
                        </a>
                        </div>
                    </div>';
                } else {
                    $imgData = "";
                }
                if ($d->company) {
                    if ($d->company->logo) {
                        $img1 = ($d->company->logo ? $d->company->logo->getUrl('thumb') : '');
                    } else {
                        $img1 = asset("public/logo.png");
                    }
                    $imgData1 = '<div class="avatar-wrapper">
                        <div class="avatar bg-light-success mr-50">
                        <a href="' . $img1 . '" target="_blank" style="display: inline-block">
                        <img class="" src="' . $img1 . '" width="42" height="42" alt="img" />
                        </a>
                        </div>
                    </div>';
                } else {
                    $imgData1 = "";
                }
                $response[] = [
                    'id' => $d->id ?? '',
                    'customerDetails' => '<div class="d-flex justify-content-left align-items-center">' . $imgData . '<div class="d-flex flex-column"style="margin-left:1px;"><h6 class="user-name text-truncate mb-0">' . (isset($d->customer->name) ? $d->customer->name : '') . '</h6>
                    <small class="text-truncate"><b class="text-info">Friend:</b><b style="color:black;">(+968)</b>' . (isset($d->number) ? $d->number : '') . '</small>
                    </div>
                    </div>',
                    'date' => date("m/d/Y", strtotime($d->date ?? '')),
                    'amount' => $d->amount != '' ? getOmr($d->amount) : '',
                    'donation_type' => $d->donation_type->type ?? '',
                    'social' => $d->social_solidarity->title ?? '',
                    'charity' => '<div class="d-flex justify-content-left align-items-center">' . $imgData1 . '<div class="d-flex flex-column"style="margin-left:1px;"><h6 class="user-name text-truncate mb-0">' . (isset($d->company->name) ? $d->company->name : '') . '</h6>
                    <small class="text-truncate text-info">' . (isset($d->company->name_ar) ? $d->company->name_ar : '') . '</small>
                    </div>
                    </div>'
                ];
            }
            //   echo '<pre>';
            // print_r($response);
            if (!empty($response)) {
                $response[0]["total"] = $donation->sum("amount");
            }
            return json_encode(['donations' => $response]);
        } else {
            abort(403);
        }
    }

    public function socialRecord()
    {
        $donation = Donationtype::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');
        $charity = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.reports.socialReport', compact('donation','charity'));
    }
    public function socialReport(Request $request)
    {
        if ($request->ajax()) {
            $donation = Donation::where('donations.social_solidarity_id', '!=', null)->orderBy('id', 'DESC');
            if (isset(request()->company_id)) {
                $donation->where('company_id', $request->company_id);
            }
            if (isset(request()->social_id)) {
                $donation->where('donation_type_id', $request->social_id);
            }
            if (isset(request()->date_from)) {
                $donation->whereDate('date', '>=', date('Y-m-d', strtotime($request->date_from)));
            }
            if (isset(request()->date_to)) {
                $donation->whereDate('date', '<=', date('Y-m-d', strtotime($request->date_to)));
            }
            if (auth()->user()->id != 1 or auth()->user()->team_id != '') {
                $donation->where("company_id", auth()->user()->team_id);
            }
            $donation = $donation->get();
            $donation->load([
                'customer' => function ($query) {
                    $query->withTrashed();
                },
            ]);
            $response = [];
            foreach ($donation as $d) {
                if ($d->customer) {
                    if ($d->customer->profile) {
                        $img = ($d->customer->profile ? $d->customer->profile->getUrl('thumb') : '');
                    } else {
                        $img = asset("public/logo.png");
                    }
                    $imgData = '<div class="avatar-wrapper">
                        <div class="avatar bg-light-success mr-50">
                        <a href="' . $img . '" target="_blank" style="display: inline-block">
                        <img class="" src="' . $img . '" width="42" height="42" alt="img" />
                        </a>
                        </div>
                    </div>';
                } else {
                    $imgData = "";
                }
                if ($d->company) {
                    if ($d->company->logo) {
                        $img1 = ($d->company->logo ? $d->company->logo->getUrl('thumb') : '');
                    } else {
                        $img1 = asset("public/logo.png");
                    }
                    $imgData1 = '<div class="avatar-wrapper">
                        <div class="avatar bg-light-success mr-50">
                        <a href="' . $img1 . '" target="_blank" style="display: inline-block">
                        <img class="" src="' . $img1 . '" width="42" height="42" alt="img" />
                        </a>
                        </div>
                    </div>';
                } else {
                    $imgData1 = "";
                }
                $response[] = [
                    'id' => $d->id ?? '',
                    'customerDetails' => '<div class="d-flex justify-content-left align-items-center">' . $imgData . '<div class="d-flex flex-column"style="margin-left:1px;"><h6 class="user-name text-truncate mb-0">' . (isset($d->customer->name) ? $d->customer->name : '') . '</h6>
                    <small class="text-truncate"><b class="text-info">Friend:</b><b style="color:black;">(+968)</b>' . (isset($d->number) ? $d->number : '') . '</small>
                    </div>
                    </div>',
                    'date' => date("m/d/Y", strtotime($d->date ?? '')),
                    'amount' => $d->amount != '' ? getOmr($d->amount) : '',
                    'donation_type' => $d->donation_type->type ?? '',
                    'social' => $d->social_solidarity->title ?? '',
                    'charity' => '<div class="d-flex justify-content-left align-items-center">' . $imgData1 . '<div class="d-flex flex-column"style="margin-left:1px;"><h6 class="user-name text-truncate mb-0">' . (isset($d->company->name) ? $d->company->name : '') . '</h6>
                    <small class="text-truncate text-info">' . (isset($d->company->name_ar) ? $d->company->name_ar : '') . '</small>
                    </div>
                    </div>'
                ];
            }
            if (!empty($response)) {
                $response[0]["total"] = $donation->sum("amount");
            }
            return json_encode(['donations' => $response]);
        } else {
            abort(403);
        }
    }
}