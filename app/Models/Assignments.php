<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Assignments extends Model
{
    use HasFactory;

    public static function getAssignments($classid=0,$subjectid=0,$state="all",$q="") {
		//echo "Query : after".$q;
		$i =0;
		$classsql = "";
		$subjectsql = "";
		$statesql = "";
		$thissubject = "";

		$class_is_set = false;
		$subject_is_set = false;
		$state_is_set = false;


		$subid = "(SELECT subjectid FROM papers WHERE ID=ca.paperid LIMIT 1)";

		//echo "Classid is $classid AND sub id is $subjectid";
		if(intval($subjectid)>0)
		{
			$subject_is_set = true;
			$i++;
			$thissubject=" ((SELECT COUNT(*) FROM papers WHERE ID=ca.paperid AND subjectid='$subjectid')>0) ";
			$thissubject=" (SELECT subjectid FROM papers WHERE ID=ca.paperid LIMIT 1)=$subjectid ";
			$subjectsql=" $subid=$subjectid ";
		}

		$classsql = "";

		if(intval($classid)>0)
		{
			$class_is_set = true;
			$i++;
			$classsql=" ca.classid='$classid' ";
		}

		if($state!="all"&&strlen($state)>0)
		{
			$state_is_set = true;
			$i++;
			if($state=="Upcoming"){
			    $statesql=" duedate>=CURRENT_DATE() ";
			}
			if($state=="Past"){
			    $statesql=" duedate<CURRENT_DATE() ";
			}
		}


		$w = "";
		if(intval($i)>0)
		{
			if($class_is_set && $subject_is_set){
				$w = " WHERE $subjectsql AND $classsql";
			}
			if(!$class_is_set && $subject_is_set){
				$w = " WHERE $subjectsql";
			}
			if($class_is_set && !$subject_is_set){
				$w = " WHERE $classsql";
			}
			
			if($state_is_set && intval($i>1)){
				$w = " WHERE $statesql";
			}
		}
		
		if(strlen($q)>0)
		{
		    $w = " WHERE (SELECT name FROM papers WHERE ID=ca.paperid LIMIT 1) LIKE '%$q%'";
		}
		
		$filled = "((SELECT COUNT(*) FROM scores WHERE paperid=ca.paperid)>1)";

		$stdctr = "(SELECT COUNT(*) FROM studentsinclass WHERE classid IN (SELECT classid FROM class_assignments WHERE paperid=ca.paperid))";
		$sql = "SELECT ca.*
		
		, (GROUP_CONCAT(((SELECT abbr FROM classes WHERE ID=classid LIMIT 1)) SEPARATOR ', ')) AS classabbrs
		, (GROUP_CONCAT(((SELECT ID FROM classes WHERE ID=ca.classid LIMIT 1)) SEPARATOR ',')) AS classids
		
		FROM class_assignments ca $w GROUP BY paperid";
		
        $sql = "SELECT *
            , (
			ROUND(
				(
					(SELECT COUNT(*) FROM scores WHERE paperid=ca.paperid)/($stdctr)
				)*100
			)
		) AS submissionpercentage
		, (SELECT abbr FROM subjects WHERE ID=$subid LIMIT 1) AS subjectabbr
		, (SELECT name FROM subjects WHERE ID=$subid LIMIT 1) AS subjectname
		, DATE(duedate) AS duedate
		, (SELECT name FROM papers WHERE ID=ca.paperid LIMIT 1) AS name
		, (SELECT outof FROM papers WHERE ID=ca.paperid LIMIT 1) AS outof
		, (SELECT DATE(datecreated) FROM papers WHERE ID=ca.paperid LIMIT 1) AS datecreated
		, (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=(SELECT creator FROM papers WHERE ID=ca.paperid LIMIT 1) LIMIT 1) AS creatorname
		, (SELECT name FROM classes WHERE ID=ca.classid LIMIT 1) AS classname
		, (SELECT abbr FROM classes WHERE ID=ca.classid LIMIT 1) AS classabbr
		, (SELECT name FROM papers WHERE ID=ca.paperid LIMIT 1) AS papername
        , (SELECT subjectid FROM papers WHERE ID=ca.paperid LIMIT 1) AS subjectid
		
		, (IF(filled=1 OR $filled,'Edit Scores','Fill Marks')) AS fillBtnText
		, (IF(filled=1 OR $filled,'fillmarks','fillmarks')) AS fillBtnAction
		, (IF(filled=1 OR $filled,'display:block','display:none')) AS publishBtnStyle
         FROM class_assignments ca";
		$cache = DB::select($sql);
        return $cache;
    }
	
	
}
