<?php

namespace App\Services\ContactUs;

use App\Models\ContactUs\ContactUs;

interface ContactMessageServiceInterface{


    public function allContactUsMessages();

    public function createContactUsMessage(array $contactUsData);

    public function editContactUsMessage(int $contactUsId);

    //public function updateContactUsMessage(array $contactUsData): ContactUs;

    //public function deleteContactUsMessage(int $contactUsId);

    //public function changeStatus(int $contactUsId, bool $status);


}
