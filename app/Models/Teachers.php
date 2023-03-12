<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teachers extends Model
{
    use HasFactory;
    public function getTeachers($classid=0,$term=1)
    {
        if(intval($term)<=0)
        {
            $term = "(SELECt svalue FROM settings WHERE skey='thisterm' LIMIT 1)";
        }else
        {
            $term = '$term';
        }
        
        $termq = " termid=$term";
        $sql = "SELECT *
		, (SELECT name FROM subjects WHERE ID=subjectid LIMIT 1) AS name 
		, (SELECT abbr FROM subjects WHERE ID=subjectid LIMIT 1) AS abbr 
		FROM classsubjects WHERE classid='" . $classid . "' AND $termq";
        $sql = "SELECT *
		, CONCAT_WS(' ',firstname,othernames,surname) AS teachername
		, (SELECT name FROM designations WHERE ID=(SELECT designation FROM users WHERE ID=p.user_id LIMIT 1) LIMIT 1) AS designame
		, (SELECT (SELECT LTRIM(LOWER(colorvalue)) FROM sitecolors WHERE ID=colorcode LIMIT 1) FROM staff WHERE user_id=p.user_id LIMIT 1) AS teachercolor
		 FROM staff s,profile p WHERE designation='2' AND p.user_id=s.user_id";
        $subjects = DB::select($sql);
        return $subjects;
    }
}
