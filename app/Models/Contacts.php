<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contacts extends Model
{
    use HasFactory;

    public function saveContact($contact)
    {
        $f =  $contact->getFirstname();
        $o =  $contact->getOthernames();
        $s =  $contact->getSurname();
        $p1 =  $contact->getPhone1();
        $p2 =  $contact->getPhone2();
        $location =  $contact->getLocation();
        $email1 =  $contact->getEmail();
        $sql = "INSERT INTO `contacts` (firstname,othernames,surname, `phone1`, `phone2`, `postal_address`, `physical_address`, `email1`, `email2`, `ucode`, `nok`, `r_to_nok`, `nokphone`) 
        VALUES ( '$f','$o','$s','$p1', '$p2', '', '$location', '$email1', '', '', '', '', '');";
        DB::insert($sql);

        return DB::getPdo()->lastInsertId();
    }
    public function contactCount($contact)
    {
        $p1 =  $contact->getPhone1();
        $p2 =  $contact->getPhone2();
        $email1 =  $contact->getEmail();
        $sql = "SELECT COUNT(*) FROM contacts WHERE phone1 = '$p1' OR phone2='$p2' OR email1 = '$email1'";
        DB::insert($sql);

        return DB::getPdo()->lastInsertId();
    }
}
