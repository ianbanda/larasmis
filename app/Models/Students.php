<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Students extends Model
{
    use HasFactory;
     public function getStudentSubjects($stdid)
     {
        $sql = "SELECT 
        ss.*, sub.* FROM std_subjects ss, subjects sub WHERE sub.ID=ss.subjectid AND studentid='$stdid'";
        return DB::select($sql);
     }
}
