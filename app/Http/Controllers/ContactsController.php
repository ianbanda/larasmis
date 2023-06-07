<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    //
    public function saveNewContact(Request $request)
    {
        $firstname = "";
        $othernames = "";
        $surname = "";
        $phone1 = "";
        $phone2 = "";
        $email = "";
        $relationship = "";
        $location = "";
        $studentid = "";
        

        $contact = new Contact();
        if(isset($request['firstname'])){$firstname = $request['firstname'];};
        if(isset($request['othernames'])){$othernames = $request['othernames'];};
        if(isset($request['surname'])){$surname = $request['surname'];};
        if(isset($request['email'])){$email = $request['email'];};
        if(isset($request['phone1'])){$phone1 = $request['phone1'];};
        if(isset($request['phone2'])){$phone2 = $request['phone2'];};
        if(isset($request['relationship'])){$relationship = $request['relationship'];};
        if(isset($request['studentid'])){$studentid = $request['studentid'];};

        $contact->setFirstname($firstname);
        $contact->setOthernames($othernames);
        $contact->setSurname($surname);
        $contact->setPhone1($phone1);
        $contact->setPhone2($phone2);
        $contact->setEmail($email);
        $contact->setRelationship($relationship);
        $contact->setLocation($location);

        $contacts = new Contacts();
        return $contacts->saveContact($contact);

        //return $request;
    }

    public function contactExists(Request $request)
    {
        $phone1 = "";
        $phone2 = "";
        $email = "";

        $contact = new Contact();
        
        if(isset($request['email'])){$email = $request['email'];};
        if(isset($request['phone1'])){$phone1 = $request['phone1'];};
        if(isset($request['phone2'])){$phone2 = $request['phone2'];};

        $contact->setPhone1($phone1);
        $contact->setPhone2($phone2);
        $contact->setEmail($email);

        $contacts = new Contacts();
        return $contacts->contactCount($contact);
    }
}
