<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Guardians extends Model
{
    use HasFactory;
    public function getStudentGuardians($stdid=0)
    {
        $sql = "SELECT *
                    , (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=sg.guardianid LIMIT 1) AS fullname
                    , gc.*
                    , cont.*
                    FROM studentguardians sg, guardian_contacts gc, contacts cont WHERE gc.guardianID=sg.guardianid AND cont.ID=gc.contactID AND studentid=$stdid";
        return DB::select($sql);
    }

    public function guardianExists(){
        $sql = "SELECT COUNT(*) FROM guardian_contacts WHERE ";
    }
}
