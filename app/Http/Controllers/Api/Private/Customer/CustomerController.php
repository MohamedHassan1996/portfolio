<?php

namespace App\Http\Controllers\Api\Private\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Resources\Customer\AllCustomerCollection;
use App\Http\Resources\Customer\CustomerResource;
use App\Services\Customer\CustomerService;
use App\Utils\PaginateCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    protected $customerService;
    public function __construct(CustomerService $customerService)
    {
        $this->middleware('auth:api');
        $this->middleware('permission:all_customers', ['only' => ['allCustomers']]);
        $this->middleware('permission:create_customer', ['only' => ['create']]);
        $this->middleware('permission:edit_customer', ['only' => ['edit']]);
        $this->middleware('permission:update_customer', ['only' => ['update']]);
        $this->middleware('permission:delete_customer', ['only' => ['delete']]);
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allCustomers = $this->customerService->allCustomers();

        return response()->json(
            new AllCustomerCollection(PaginateCollection::paginate($allCustomers, $request->pageSize?$request->pageSize:10))
        , 200);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(CreateCustomerRequest $createCustomerRequest)
    {

        try {
            DB::beginTransaction();

            $customerData = $createCustomerRequest->validated();

            $customer = $this->customerService->createCustomer($createCustomerRequest->validated());

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
     * Show the form for editing the specified resource.
     */

    public function edit(Request $request)
    {
        $customer  =  $this->customerService->editCustomer($request->customerId);

        return response()->json(
            new CustomerResource($customer)//new UserResource($user)
        ,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $updateCustomerRequest)
    {

        try {
            DB::beginTransaction();

            $customerData = $updateCustomerRequest->validated();

            $this->customerService->updateCustomer($customerData);

            DB::commit();
            return response()->json([
                 'message' => __('messages.success.updated')
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
            $this->customerService->deleteCustomer($request->customerId);
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
