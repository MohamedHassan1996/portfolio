<?php

namespace App\Services\ContactUs;

use App\Enums\ContactUs\ContactMessagesStatus;
use App\Enums\ContactUs\ContactUsStatus;
use App\Filters\ContactUs\FilterContactUs;
use App\Models\ContactUs\ContactUs;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ContactUsService{

    private $contactUs;
    public function __construct(ContactUs $contactUs)
    {
        $this->contactUs = $contactUs;
    }

    public function allContactUss()
    {
        $contactUss = QueryBuilder::for(ContactUs::class)
            ->allowedFilters([
                AllowedFilter::custom('search', new FilterContactUs()), // Add a custom search filter
            ])->get();

        return $contactUss;

    }

    public function createContactUs(array $contactUsData): ContactUs
    {

        $contactUs = ContactUs::create([
            'name' => $contactUsData['name'],
            'subject' => $contactUsData['subject'],
            'email' => $contactUsData['email'],
            'phone' => $contactUsData['phone'],
            'status' => ContactMessagesStatus::from($contactUsData['status'])->value,
        ]);


        return $contactUs;

    }

    public function editContactUs(int $contactUsId)
    {
        return ContactUs::with('messages')->find($contactUsId);
    }

    public function updateContactUs(array $contactUsData): ContactUs
    {

        $contactUs = ContactUs::find($contactUsData['contactUsId']);
        $contactUs->update([
            'name' => $contactUsData['name'],
            'subject' => $contactUsData['subject'],
            'email' => $contactUsData['email'],
            'phone' => $contactUsData['phone'],
            'status' => ContactMessagesStatus::from($contactUsData['status'])->value,
        ]);
        return $contactUs;


    }


    public function deleteContactUs(int $contactUsId)
    {

        $contactUs  = ContactUs::find($contactUsId);

        $contactUs->delete();

    }

    public function changeStatus(int $contactUsId, bool $status)
    {
        $contactUs = ContactUs::find($contactUsId);
        $contactUs->status = $status;
        $contactUs->save();
    }




}
