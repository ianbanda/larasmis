<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    use HasFactory;
    public function getClasses($termid=1) {
        $sql = "SELECT *"
                . ", (SELECT COUNT(studentid) FROM studentsinclass WHERE classID=ID LIMIT 1) AS numofstudents"
                . ", (
						SELECT 
							GROUP_CONCAT((SELECT abbr FROM subjects WHERE ID=subjectid LIMIT 1),' ') 
						FROM classsubjects WHERE classid=cl.ID LIMIT 1
					 ) AS subjects"
                . ", (SELECT COUNT(*) FROM classteachers WHERE classid=ID LIMIT 1) AS numofteachers"
                . ", (SELECT COUNT(*) FROM studentsinclass WHERE classID=cl.ID LIMIT 1) AS numonroll"
                . ", (SELECT COUNT(*) FROM studentsinclass sic WHERE classID=cl.ID AND (SELECT gender FROM profile WHERE user_id=sic.studentid LIMIT 1)='MALE' LIMIT 1) AS numofboys"
                . ", (SELECT COUNT(*) FROM studentsinclass sic WHERE classID=cl.ID AND (SELECT gender FROM profile WHERE user_id=sic.studentid LIMIT 1)='FEMALE' LIMIT 1) AS numofgirls"
                . ", (SELECT name FROM terms WHERE ID=term LIMIT 1) AS termname"
                . ", (ID) AS classid"
                . " FROM classes cl";

        $cache = DB::select($sql);;
        return $cache;
    }
}
