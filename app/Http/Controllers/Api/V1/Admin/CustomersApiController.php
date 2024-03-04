<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\Admin\CustomerResource;
use App\Models\Customer;
use Gate;
use Image;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CustomersApiController extends Controller
{
    use MediaUploadingTrait;
    /**
     * @OA\Post(
     * path="/api/v1/signUp",
     * operationId="Signup",
     * tags={"User"},
     * summary="User Signup",
     * description="User Signup here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name","phone"},
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="phone", type="number")
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
    public function signUp(Request $request)
    {
        validate_req($request, ["name", "phone"]);
        $user = Customer::where("phone", $request->phone)->first();
        if (!$user) {
            $user = new Customer();
        }

        $user->name = $request->name ?? '';
        // $user->email = $request->email??'';
        $user->phone = $request->phone ?? '';
        $user->status = 1;
        $user->save();
        $user->otp = rand(1000, 9999);
        $message =  $user->otp . ' : ' . 'رقم تسجيل الدخول الخاص بك ';
        $to = '968' . $user->phone;
        sendSms($to, $message);
        if ($user) {
            $status = 'success';
            $msg = 'user created successfully';
        } else {
            $status = 'error';
            $msg = 'something went wrong';
            $user = null;
        }
        return response()->json(["status" => $status, "msg" => $msg, "data" => $user])->setStatusCode(200);
    }
    /**
     * @OA\Post(
     * path="/api/v1/login",
     * operationId="Login",
     * tags={"User"},
     * summary="User Login",
     * description="User Login here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"phone"},
     *               @OA\Property(property="phone", type="number")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="User Find Successfully",
     *          @OA\JsonContent(type="array",@OA\Items()),
     *          @OA\XmlContent(type="array",@OA\Items())
     *       )
     * )
     */
    public function login(Request $request)
    {
        validate_req($request, ["phone"]);
        $num_check = DB::Table('customers')->select("id", "name", "email", "phone", "status", "is_notify")->where(['phone' => $request->phone, "status" => 1])->first();
        if ($num_check) {
            $user = Customer::find($num_check->id);
            $num_check->otp = rand(1000, 9999);
            $message =  $user->otp . ' : ' . 'رقم تسجيل الدخول الخاص بك ';
            $to = '968' . $user->phone;
            sendSms($to, $message);
            $status = 'success';
            $msg = 'user find successfully';
            $num_check->profile = isset($user->profile) ? $user->profile->geturl("thumb") : 'N/A';
            $is_notify = $num_check->is_notify;
        } else {
            $is_notify = 0;
            $status = 'error';
            $msg = 'user not found';
        }
        return response()->json(["status" => $status, "msg" => $msg, "data" => $num_check, "is_notify" => $is_notify])->setStatusCode(200);
    }
    /**
     * @OA\Post(
     * path="/api/v1/updateProfile",
     * operationId="updateProfile",
     * tags={"User"},
     * summary="update Profile",
     * description="update Profile here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"id","name"},
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="profile", type="file"),
     *               @OA\Property(property="id", type="number")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="update Profile Successfully",
     *          @OA\JsonContent(type="array",@OA\Items()),
     *          @OA\XmlContent(type="array",@OA\Items())
     *       )
     * )
     */
    public function updateProfile(Request $request)
    {
        validate_req($request, ["id", "name"]);
        $user = Customer::find($request->id);
        if (!empty($user)) {
            if ($request->has('profile')) {

                $files1 = $request->file('profile');
                $ImageUpload1 = Image::make($files1);
                $originalPath1 = storage_path('tmp/uploads/');
                $time1 = time();
                $ImageUpload1->save($originalPath1 . $time1 . $files1->getClientOriginalName());
                $image1 = $time1 . $files1->getClientOriginalName();
                $user->addMedia(storage_path('tmp/uploads/' . basename($image1)))->toMediaCollection('profile');
            }

            $user->name = $request->name ?? '';
            // $user->phone=$request->phone;
            $user->save();
            $fetch = DB::Table('customers')->select("id", "name", "email", "phone", "status")->where(['id' => $user->id])->first();
            $fetch->profile = isset($user->profile) ? $user->profile->geturl("thumb") : 'N/A';
            return response()->json(['status' => 'success', 'msg' => 'update data successfully', 'data' => $fetch])->setStatusCode(200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'record not found', 'data' => []])->setStatusCode(200);
        }
    }

    /**
     * @OA\Post(
     * path="/api/v1/updateToken",
     * operationId="Update Token",
     * tags={"Update Token"},
     * summary="Update Token",
     * description="Update Token here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"id","token"},
     *               @OA\Property(property="id", type="number"),
     *               @OA\Property(property="token", type="number")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Update Token Successfully",
     *          @OA\JsonContent(type="array",@OA\Items()),
     *          @OA\XmlContent(type="array",@OA\Items())
     *       )
     * )
     */
    public function updateToken(Request $request)
    {
        validate_req($request, ["id", "token"]);
        $user = Customer::find($request->id);
        $data = [];
        if ($user) {
            $user->otp = $request->token;
            $user->save();
            $msg = 'token updated successfully';
            $status = 'success';
            $data[] =  $request->token;
        } else {
            $msg = 'user not found';
            $status = 'error';
        }

        return response()->json(['status' => $status, 'msg' => $msg, 'data' => $data])->setStatusCode(200);
    }
    /**
     * @OA\Post(
     * path="/api/v1/notificationToggle",
     * operationId="Update Token",
     * tags={"Update notification Toggle"},
     * summary="Update notification Toggle",
     * description="Update notification Toggle here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"id","toggle"},
     *               @OA\Property(property="id", type="number"),
     *               @OA\Property(property="toggle", type="number")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Update notification Toggle Successfully",
     *          @OA\JsonContent(type="array",@OA\Items()),
     *          @OA\XmlContent(type="array",@OA\Items())
     *       )
     * )
     */
    public function notificationToggle(Request $request)
    {
        validate_req($request, ["id", "toggle"]);
        $user = Customer::find($request->id);
        if ($user) {
            $user->is_notify = $request->toggle;
            $user->save();
            $msg = 'token updated successfully';
            $status = 'success';
            $is_notify = $user->is_notify;
        } else {
            $is_notify = "";
            $msg = 'user not found';
            $status = 'error';
        }

        return response()->json(['status' => $status, 'msg' => $msg, 'is_notify' => $is_notify])->setStatusCode(200);
    }
}