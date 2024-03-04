<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactUsRequest;
use App\Http\Requests\UpdateContactUsRequest;
use App\Http\Resources\Admin\ContactUsResource;
use App\Models\ContactUs;
use App\Models\FaqQuestion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactUsApiController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/v1/contactDetail",
     * operationId="Get conactDetail",
     * tags={"Contact"},
     * summary="Get contact Detail",
     * description="Get contact Detail",
     *      @OA\Response(
     *          response=200,
     *          description="contact Detail Found",
     *       )
     * )
     */
    public function contactDetail()
    {
        $ContactUs = ContactUs::first();
        if ($ContactUs) {
            $branches = unserialize($ContactUs->branch);
            $ContactUs->branch = $branches;
            $status = 'success';
            $msg = "Contact Us found successfully.";
        } else {
            $status = 'error';
            $msg = 'Contact Us detail not found';
        }
        return response()->json(["status" => $status, "msg" => $msg, "data" => $ContactUs])->setStatusCode(200);
    }
    /**
     * @OA\Get(
     * path="/api/v1/faq",
     * operationId="Get faqs",
     * tags={"FAQ's"},
     * summary="Get FAQ's",
     * description="Get FAQ's",
     *      @OA\Response(
     *          response=200,
     *          description="FAQ Found",
     *       )
     * )
     */
    public function faq()
    {
        $faq = FaqQuestion::get(["question", "question_ar", "answer_ar", "answer"]);
        if ($faq) {

            $status = 'success';
            $msg = "FAQ's found successfully.";
        } else {
            $status = 'error';
            $msg = 'something went wrong';
        }
        return response()->json(["status" => $status, "msg" => $msg, "data" => $faq])->setStatusCode(200);
    }
}