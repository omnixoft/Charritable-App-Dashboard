<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateThawaniSettingRequest;
use App\Http\Resources\Admin\ThawaniSettingResource;
use App\Models\ThawaniSetting;
use Gate;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Symfony\Component\HttpFoundation\Response;

class ThawaniSettingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('thawani_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ThawaniSettingResource(ThawaniSetting::with(['team'])->get());
    }

    public function update(UpdateThawaniSettingRequest $request, ThawaniSetting $thawaniSetting)
    {
        $thawaniSetting->update($request->all());

        return (new ThawaniSettingResource($thawaniSetting))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
    /**
     * @OA\Get(
     * path="/api/v1/thawaniPay/{id}",
     * operationId="thawaniPay",
     * tags={"Thawani Pay"},
     * summary="Get thawaniPay",
     * description="Get thawaniPay here",
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
     *          description="setting fetched successfully",
     *          @OA\JsonContent(type="array",@OA\Items()),
     *          @OA\XmlContent(type="array",@OA\Items())
     *       )
     * )
     */
    public function thawaniPay(Request $request)
    {
        $data = [];
        $thawani = ThawaniSetting::where("team_id", $request->id)->first();
        if ($thawani) {
            if ($thawani->is_live == 0) {
                $data = [
                    "url" => env('THAWANI_DEMO_URL'),
                    'secret_key' => env('THAWANI_SECRET_DEMO_KEY'),
                    'publish_key' => env('THAWANI_PUBLISH_DEMO_KEY'),
                    'customer_id' => '',
                ];
            } else {
                $data = [
                    "url" => $thawani->url,
                    'secret_key' => $thawani->secret_key,
                    'publish_key' => $thawani->publish_key,
                    'customer_id' => $thawani->customer_id,
                ];
            }
        } else {
            $data = [
                "url" => env('THAWANI_DEMO_URL'),
                'secret_key' => env('THAWANI_SECRET_DEMO_KEY'),
                'publish_key' => env('THAWANI_PUBLISH_DEMO_KEY'),
                'customer_id' => '',
            ];
        }

        return response()->json(['status' => 'success', 'msg' => 'setting fetched successfully', "data" => $data])->setStatusCode(200);
    }
    /**
     * @OA\Post(
     * path="/api/v1/payment",
     * operationId="payment",
     * tags={"Thawani Pay"},
     * summary="payment url",
     * description="payment url here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"thawani_url", "customer_id", "type", "amount", "name","key","publish"},
     *               @OA\Property(property="thawani_url", type="text"),
     *               @OA\Property(property="amount", type="number"),
     *               @OA\Property(property="customer_id", type="number"),
     *               @OA\Property(property="type", type="text"),
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="key", type="text"),
     *               @OA\Property(property="publish", type="text"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Payment url get Successfully",
     *          @OA\XmlContent(type="array",@OA\Items()),
     *       )
     * )
     */

    public function paymentUrl(Request $request)
    {
        validate_req($request, ["thawani_url", "customer_id", "type", "amount", "name", "key", "publish"]);

        $url = thawaniPayment($request->thawani_url, $request->customer_id, $request->type, $request->amount, $request->name, $request->key, $request->publish);
        return response()->json(['status' => 'success', 'msg' => 'payment url fetched successfully', "data" => $url])->setStatusCode(200);
    }
}