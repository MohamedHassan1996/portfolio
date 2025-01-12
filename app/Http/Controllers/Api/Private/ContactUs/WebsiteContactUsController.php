<?php

namespace App\Http\Controllers\Api\Private\ContactUs;

use App\Enums\ContactUs\SenderType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUs\UpdateContactUsRequest;
use App\Http\Resources\ContactUs\AllContactUsCollection;
use App\Http\Resources\ContactUs\ContactUsResource;
use App\Models\ContactUs\ContactUs;
use App\Models\ContactUs\ContactUsMessage;
use App\Utils\PaginateCollection;
use App\Services\ContactUs\ContactUsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WebsiteContactUsController extends Controller
{
    protected $contactUsService;

    public function __construct(ContactUsService $contactUsService)
    {
        $this->contactUsService = $contactUsService;
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function create(Request $request)
    {

        try {
            DB::beginTransaction();


            $contactUs  = ContactUs::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
            ]);

            $contactUsMessages = ContactUsMessage::create([
                'contact_us_id' => $contactUs->id,
                'message' => $request->message,
                'is_admin' => 1,
                'is_read' => null

            ]);

            DB::commit();

            return response()->json([
                'message' => __('messages.success.created'),
            ],200);


        }catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

}
