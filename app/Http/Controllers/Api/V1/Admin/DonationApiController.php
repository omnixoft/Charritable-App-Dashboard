<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDonationRequest;
use App\Http\Requests\UpdateDonationRequest;
use App\Http\Resources\Admin\DonationResource;
use App\Models\Customer;
use App\Models\Donation;
use App\Models\User;
use App\Models\Team;
use App\Models\SocialSolidarity;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DonationApiController extends Controller
{

    /**
     * @OA\Get(
     * path="/api/v1/donationHistory/{id}",
     * operationId="Get Donation Detail",
     * tags={"Donation"},
     * summary="Get Donation Detail",
     * description="Get Donation Detail",
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
     *          description="Donation Detail Found",
     *       )
     * )
     */
    public function index(Request $request)
    {
        $donation = DB::table("donations")->leftJoin("donationtypes", "donationtypes.id", "donations.donation_type_id")->where('user_id', $request->id)->whereNull("donations.deleted_at")->orderBy("id", "desc")->get(["number", "amount", "date", "donations.id", "user_id", "donations.company_id", "social_solidarity_id", "donationtypes.type"]);
        $response = [];
        $total = 0;
        foreach ($donation as $d) {
            $charity = Team::find($d->company_id);

            if ($charity) {
                $d->charity = [
                    "name" => $charity->name,
                    "name_ar" => $charity->name_ar,
                    "description" => $charity->description,
                    "description_ar" => $charity->description_ar,
                    "logo" => '',
                ];
                if ($charity->logo) {
                    $d->charity["logo"] = ($charity->logo ? $charity->logo->getUrl('preview') : '');
                }
            } else {
                $d->charity = $charity;
            }

            $social = SocialSolidarity::find($d->social_solidarity_id);
            if ($social) {
                $d->social_solidarities = [
                    "title" => $social->title,
                    "title_ar" => $social->title_ar,
                ];
            } else {
                $d->social_solidarities = $social;
            }

            $response[] = $d;
        }
        if (!empty($response)) {
            $total  = $donation->sum("amount");
            $status = 'success';
            $msg = "Donation Detail found successfully.";
        } else {
            $status = 'error';
            $msg = 'Donation Detail not found';
        }
        return response()->json(["status" => $status, "msg" => $msg, "data" => $response, "total" => $total])->setStatusCode(200);
    }

    /**
     * @OA\Post(
     * path="/api/v1/donation",
     * operationId="Donation",
     * tags={"Donation"},
     * summary="Donation",
     * description="Donation here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"user_id","amount","charity_id","type_id","social_id","t_id","number"},
     *               @OA\Property(property="user_id", type="number"),
     *               @OA\Property(property="amount", type="number"),
     *               @OA\Property(property="charity_id", type="number"),
     *               @OA\Property(property="type_id", type="number"),
     *               @OA\Property(property="t_id", type="number"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Donation Successfully",
     *          @OA\JsonContent(type="array",@OA\Items()),
     *          @OA\XmlContent(type="array",@OA\Items())
     *       )
     * )
     */
    public function create(Request $request)
    {
        validate_req($request, ["user_id", "amount", "charity_id", "t_id", "type_id"]);
        $donation =  new Donation();
        if ($donation) {
            $donation->user_id  = $request->user_id ?? '';
            $user = User::find($request->user_id);
            if ($user) {
                $message =  'لقد تبرع عنك فاعل خير من خلال تطبيق الهيئة العمانية للإعمال الخيرية';
                $to = '968' . $user->phone;
                sendSms($to, $message);
            }


            $donation->donation_type_id  = $request->type_id ?? '';
            $donation->company_id  = $request->charity_id ?? '';
            // $donation->team_id  = $request->charity_id??'';
            $donation->amount  = $request->amount ?? 0;
            $donation->number  = $request->number ?? 0;
            if ($request->number) {
                $message =  'لقد تم إستقبال تبرعك بنجاح من خلال تطبيق الهيئة العمانية للإعمال الخيرية';
                $to = '968' . $request->number;
                sendSms($to, $message);
            }



            $donation->transaction_id = $request->t_id ?? '';
            $donation->date  = date("Y-m-d");
            $donation->social_solidarity_id   = $request->social_id ?? 0;
            $donation->save();
            $msg = 'Donation successfully';
            $status = 'success';
        } else {
            $msg = 'something went wrong.';
            $status = 'error';
        }
        return response()->json(['status' => $status, 'msg' => $msg, 'data' => $donation])->setStatusCode(200);
    }
}