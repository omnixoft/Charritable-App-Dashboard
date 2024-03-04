<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSocialSolidarityRequest;
use App\Http\Requests\UpdateSocialSolidarityRequest;
use App\Http\Resources\Admin\SocialSolidarityResource;
use App\Models\Customer;
use App\Models\SocialSolidarity;
use App\Models\Donation;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SocialSolidarityApiController extends Controller
{
    use MediaUploadingTrait;


    /**
     * @OA\Get(
     * path="/api/v1/socialSolidarity",
     * operationId="Get Social Solidarity ",
     * tags={"Social Solidarity"},
     * summary="Get Social Solidarity ",
     * description="Get Social Solidarity",
     *      @OA\Response(
     *          response=200,
     *          description="Social Solidarity Found",
     *       )
     * )
     */
    public function index(Request $request)
    {
        $banner = DB::table("social_solidarities")->where(["active" => 1, "deleted_at" => null]);


        if (isset($request->name)) {
            $banner->where('title', 'LIKE', '%' . $request->name . '%');
            $banner->orWhere('title_ar', 'LIKE', '%' . $request->name . '%');
        }

        $banner = $banner->orderBy("id", "desc")->get(["id", "title", "title_ar", "description", "description_ar", "date", "target_amount"]);
        $banners = [];

        if (!$banner->isEmpty()) {
            foreach ($banner as $k => $b) {
                $social = SocialSolidarity::find($b->id);
                // $b->image = 
                $imgs = [];
                if (isset($social->images_and_videos)) {
                    foreach ($social->images_and_videos as $img) {
                        $imgs[] = $img->geturl();
                    }
                }
                $charity = [];
                if ($social) {
                    if ($social->team) {
                        $charity = ["id" => $social->team->id, "name" => $social->team->name ?? '', "name_ar" => $social->team->name_ar];
                    }
                }
                if ($social->donation) {
                    $donation = $social->donation->sum("amount");
                } else {
                    $donation = 0;
                }
                $b->donation = $donation;
                $b->charity = $charity;
                $b->images = $imgs;
                $b->type = $social->donation_type;
                $banners[] = $b;
            }
            $status = 'success';
            $msg = "Social Solidarity found successfully.";
        } else {
            $status = 'error';
            $msg = 'Social Solidarity not found';
        }
        return response()->json(["status" => $status, "msg" => $msg, "data" => $banners])->setStatusCode(200);
    }

    /**
     * @OA\Get(
     * path="/api/v1/socialSolidarityById/{id}",
     * operationId="Get Social Solidarity Detail",
     * tags={"Social Solidarity"},
     * summary="Get Social Solidarity Detail",
     * description="Get Social Solidarity Detail",
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
     *          description="Social Solidarity Detail Found",
     *       )
     * )
     */
    public function socialSolidarityById(Request $request)
    {
        $banner = DB::table("social_solidarities")->where(["active" => 1, "id" => $request->id]);

        if (isset($request->name)) {
            $banner->where('title', 'LIKE', '%' . $request->name . '%');
            $banner->orWhere('title_ar', 'LIKE', '%' . $request->name . '%');
        }

        $banner = $banner->get(["id", "title", "title_ar", "description", "description_ar", "date", "target_amount"]);
        $banners = [];

        if (!$banner->isEmpty()) {
            foreach ($banner as $k => $b) {
                $social = SocialSolidarity::find($b->id);
                // $b->image = 
                $imgs = [];
                if (isset($social->images_and_videos)) {
                    foreach ($social->images_and_videos as $img) {
                        $imgs[] = $img->geturl();
                    }
                }
                $charity = [];
                if ($social->team) {
                    if ($social->team->logo) {
                        $logo = $social->team->logo->geturl("thumb");
                    } else {
                        $logo = asset("logo.png");
                    }
                    $charity = [
                        "id" => $social->team->id,
                        "name" => $social->team->name ?? '',
                        "name_ar" => $social->team->name_ar,
                        "logo" => $logo
                    ];
                }
                $b->charity = $charity;
                $b->images = $imgs;
                $b->type = $social->donation_type;
                $profiles = [];
                if ($social->donation) {
                    $donation = $social->donation->sum("amount");
                    foreach ($social->donation as $d) {
                        if (isset($d->customer)) {
                            if ($d->customer->profile) {
                                $profiles[$d->customer->id] = $d->customer->profile->geturl("thumb");
                            }
                        }
                    }
                } else {
                    $donation = 0;
                }
                $b->donation = $donation;
                $b->profiles = array_values($profiles);
                $banners[] = $b;
            }
            $status = 'success';
            $msg = "Social Solidarity found successfully.";
        } else {
            $status = 'error';
            $msg = 'Social Solidarity not found';
        }
        return response()->json(["status" => $status, "msg" => $msg, "data" => $banners])->setStatusCode(200);
    }
}