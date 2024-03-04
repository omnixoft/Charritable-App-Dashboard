<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Http\Resources\Admin\FeedbackResource;
use App\Models\Feedback;
use Gate;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedbackApiController extends Controller
{
     /**
        * @OA\Post(
        * path="/api/v1/feedback",
        * operationId="feedback",
        * tags={"User"},
        * summary="feedback",
        * description="User feedback here",
        *     @OA\RequestBody(
        *         @OA\JsonContent(),
        *         @OA\MediaType(
        *            mediaType="multipart/form-data",
        *            @OA\Schema(
        *               type="object",
        *               required={"name","number","message"},
        *               @OA\Property(property="name", type="text"),
        *               @OA\Property(property="message", type="text"),
        *               @OA\Property(property="number", type="number")
        *            ),
        *        ),
        *    ),
        *      @OA\Response(
        *          response=200,
        *          description="User Created Successfully",
        *          @OA\JsonContent(type="array",@OA\Items()),
        *          @OA\XmlContent(type="array",@OA\Items())
        *       )
        * )
    */
    public function feedback(Request $request)
    {
        validate_req($request,["name","message","number"]);

        $feedback = Feedback::create($request->all());
        if($feedback){
            
            $status = 'success';
            $msg = 'feedback added successfully.';
        }else{
            $status = 'error';
            $msg = 'something went wrong';
        }
        return response()->json(["status"=>$status,"msg"=>$msg,"data"=>$feedback])->setStatusCode(200);
    }

   
}
