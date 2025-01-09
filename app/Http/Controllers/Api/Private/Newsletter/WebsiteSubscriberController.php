<?php

namespace App\Http\Controllers\Api\Private\Newsletter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Newsletter\Subscriber\CreateSubscriberRequest;
use App\Mail\NewsletterSubscription;
use App\Models\Newsletter\Subscriber;
use App\Services\Newsletter\SubscriberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class WebsiteSubscriberController extends Controller
{
    protected $subcsciberService;

    public function __construct(SubscriberService $subcsciberService)
    {
        $this->subcsciberService = $subcsciberService;
    }



    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateSubscriberRequest $createSubscriberRequest)
    {

        try {
            DB::beginTransaction();

            $subscriber = Subscriber::where('email', $createSubscriberRequest->email)->first();

            if ($subscriber) {
                return response()->json([
                    'message' => __('messages.error.subscriber.exists')
                ], 401);
            }


            $subscriber = $this->subcsciberService->createSubscriber($createSubscriberRequest->validated());

            Mail::to($subscriber->email)->send(new NewsletterSubscription($subscriber->email, $subscriber->token));

            DB::commit();

            return response()->json([
                'message' => __('messages.success.created')
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {

        try {
            DB::beginTransaction();
            $subscriber = Subscriber::where('token', $request->token)->where('email', $request->email)->first();
            DB::commit();
            return response()->json([
                'message' => __('messages.success.deleted')
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }


}
