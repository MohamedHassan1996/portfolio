<?php

namespace App\Services\Customer;

use App\Filters\Customer\FilterCustomer;
use App\Models\Customer\Customer;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CustomerService{

    private $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function allCustomers()
    {
        $customers = QueryBuilder::for(Customer::class)
            ->allowedFilters([
                AllowedFilter::custom('search', new FilterCustomer()), // Add a custom search filter
            ])->get();

        return $customers;

    }

    public function createCustomer(array $customerData): Customer
    {

        $customer = Customer::create([
            'name' => $customerData['name'],
            'email' => $customerData['email'],
            'phone' => $customerData['phone'],
            'address' => $customerData['address'],
            'description' => $customerData['description'],
        ]);

        return $customer;

    }

    public function editCustomer(int $customerId)
    {
        return Customer::find($customerId);
    }

    public function updateCustomer(array $customerData): Customer
    {

        $customer = Customer::find($customerData['customerId']);

        $customer->update([
            'name' => $customerData['name'],
            'email' => $customerData['email'],
            'phone' => $customerData['phone'],
            'address' => $customerData['address'],
            'description' => $customerData['description'],
        ]);

        return $customer;


    }


    public function deleteCustomer(int $customerId)
    {

        return Customer::find($customerId)->delete();

    }


}
