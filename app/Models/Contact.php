<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    private $firstname = "";
    private $othernames = "";
    private $surname = "";
    private $phone1 = "";
    private $phone2 = "";
    private $email = "";
    private $relationship = "";
    private $location = "";

    public function getFirstname() {
        return $this->firstname;
    }
    public function getOthernames()
    {
        return $this->othernames;
    }
    public function getSurname()
    {
        return $this->surname;
    }

    public function getEmail() {
        return $this->email;
    }
    public function getPhone1() {
        return $this->phone1;
    }
    public function getPhone2() {
        return $this->phone2;
    }    
    public function getRelationship() {
        return $this->relationship;
    }
    public function getLocation() {
        return $this->relationship;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }
    public function setOthernames($othernames) {
        $this->othernames = $othernames;
    }
    public function setSurname($s) {
        $this->surname = $s;
    }
    public function setPhone1($s) {
        $this->phone1 = $s;
    }
    public function setPhone2($s) {
        $this->phone2 = $s;
    }
    public function setEmail($s) {
        $this->email = $s;
    }
    public function setRelationship($s) {
        $this->relationship = $s;
    }
    public function setLocation($s) {
        $this->location = $s;
    }
}
