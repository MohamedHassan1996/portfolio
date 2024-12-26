<?php

namespace App\Services\ContactUs;

use App\Enums\ContactUs\SenderType;
use App\Mail\ContactUsMessageNotification;
use App\Models\ContactUs\ContactUs;
use App\Models\ContactUs\ContactUsMessage;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ContactMessageService implements ContactMessageServiceInterface{


    public function allContactUsMessages(){
        $allContactUsMessages = QueryBuilder::for(ContactUsMessage::class)
        ->allowedFilters([
            AllowedFilter::exact('contactUsId'), // Add a custom search filter
        ])->get();

        return $allContactUsMessages;
    }

    public function createContactUsMessage(array $contactUsData){
        $contactUsMessage = ContactUsMessage::create([
            'contact_us_Id' => $contactUsData['contactUsId'],
            'message' => $contactUsData['message'],
            'is_admin' => SenderType::from($contactUsData['isAdmin'])->value,
            'is_read' => $contactUsData['isRead']??null
        ]);

        $contactUs = ContactUs::find($contactUsData['contactUsId']);

        //Mail::to($contactUs->email)->send(new ContactUsMessageNotification($contactUsMessage, $contactUs));


        return $contactUsMessage;
    }

    public function editContactUsMessage(int $contactUsId){
        $contactUsMessage = ContactUsMessage::find($contactUsId);
        return $contactUsMessage;
    }

    //public function updateContactUsMessage(array $contactUsData): ContactUs;

    //public function deleteContactUsMessage(int $contactUsId);

    //public function changeStatus(int $contactUsId, bool $status);

    /*protected function sendContactUsEmail(ContactUsMessage $contactUsMessage)
    {
        // Implement email logic, e.g., using Laravel's Mail facade
        Mail::to('support@example.com')->send(new ContactUsMessageNotification($contactUsMessage));
    }*/



}
