<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Http\Resources\Admin\BannerResource;
use App\Models\Banner;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BannersApiController extends Controller
{
    use MediaUploadingTrait;


   /**
        * @OA\Get(
        * path="/api/v1/banners",
        * operationId="Get Promotion banners ",
        * tags={"Banners"},
        * summary="Get Promotion banners ",
        * description="Get Promotion banners",
        *      @OA\Response(
        *          response=200,
        *          description="Promotion banners Found",
        *       )
        * )
        */
        public function index()
        { 
            $banner = Banner::where("status",1)->get();
            $banners = [];
           
            if(!$banner->isEmpty()){
                foreach($banner as $k=> $b){
                    $banners[$k] = [
                        "id"=>$b->id,
                        "link"=>$b->link ,
                        "title"=>$b->title,
                        "status"=>$b->status,
                        "image"=>$b->image->geturl()
                    ] ;
                   
              }
                $status = 'success';
                $msg = "Promotion banners found successfully.";
            }else{
                $status = 'error';
                $msg = 'Promotion banners not found';
            }
            return response()->json(["status"=>$status,"msg"=>$msg,"data"=>$banners])->setStatusCode(200);
        }
}
