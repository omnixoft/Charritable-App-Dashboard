<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Http\Resources\Admin\TeamResource;
use App\Models\Team;
use DB;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamApiController extends Controller
{
    use MediaUploadingTrait;



    /**
     * @OA\Get(
     * path="/api/v1/charities",
     * operationId="GetCharities",
     * tags={"Charity"},
     * summary="GetCharities",
     * description="Get Charities",
     *      @OA\Response(
     *          response=200,
     *          description="Charities Found",
     *       )
     * )
     */
    public function index(Request $request)
    {
        $charity = DB::table("teams")->where("active", 1)->whereNull("deleted_at");
        if (isset($request->name)) {
            $charity->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if (isset($request->name_ar)) {
            $charity->where('name_ar', 'LIKE', '%' . $request->name_ar . '%');
        }
        if (isset($request->governorate_id)) {
            $charity->where('governorate_id', $request->governorate_id);
        }
        if (isset($request->wilayat_id)) {
            $charity->where('wilayat_id', $request->wilayat_id);
        }
        if (isset($request->limit)) {
            $charity->offset($request->offset)->limit($request->limit);
        }
        $charity = $charity->orderBy("id", "asc")->get(["id", "name", "name_ar", "active", "wilayat_id", "governorate_id"]);
        $charities = [];
        if (!$charity->isEmpty()) {
            foreach ($charity as $k => $b) {
                $c = Team::find($b->id);
                if ($c->logo) {
                    $b->logo = $c->logo->geturl("thumb");
                } else {
                    $b->logo = asset("logo.png");
                }
                $charities[$k] = $b;
            }
            $status = 'success';
            $msg = "charities found successfully.";
        } else {
            $status = 'error';
            $msg = 'charities not found';
        }
        return response()->json(["status" => $status, "msg" => $msg, "data" => $charities])->setStatusCode(200);
    }


    /**
     * @OA\Get(
     * path="/api/v1/charityById/{id}",
     * operationId="Get Charity Detail",
     * tags={"Charity"},
     * summary="Get Charity Detail",
     * description="Get Charity Detail",
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
     *          description="Charity Detail Found",
     *       )
     * )
     */
    public function charityById(Request $request)
    {
        $charity = DB::table("teams")->where(["active" => 1, "id" => $request->id]);
        if (isset($request->name)) {
            $charity->where('name', 'LIKE', '%' . $request->name . '%');
            $charity->orWhere('name_ar', 'LIKE', '%' . $request->name . '%');
        }
        if (isset($request->governorate_id)) {
            $charity->where('governorate_id', $request->governorate_id);
        }
        if (isset($request->wilayat_id)) {
            $charity->where('wilayat_id', $request->wilayat_id);
        }
        if (isset($request->limit)) {
            $charity->offset($request->offset)->limit($request->limit);
        }
        $charity = $charity->get(["id", "description", "description_ar", "name", "name_ar", "active", "wilayat_id", "governorate_id"]);
        $charities = [];
        if (!$charity->isEmpty()) {
            foreach ($charity as $k => $b) {
                $c = Team::find($b->id);
                if ($c->logo) {
                    $b->logo = $c->logo->geturl("thumb");
                } else {
                    $b->logo = asset("logo.png");
                }
                $imgs = [];
                $types = [];
                if ($c->images) {
                    foreach ($c->images as $m) {
                        $imgs[] = $m->geturl("preview");
                    }
                }
                if ($c->type_of_donations) {
                    $types = $c->type_of_donations;
                }
                $b->images = $imgs;
                $b->types = $types;
                $charities[$k] = $b;
            }
            $status = 'success';
            $msg = "charity Detail found successfully.";
        } else {
            $status = 'error';
            $msg = 'charity Detail not found';
        }
        return response()->json(["status" => $status, "msg" => $msg, "data" => $charities])->setStatusCode(200);
    }
}