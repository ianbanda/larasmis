<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Flaggables extends Model
{

    /**
     * Messages constructor
     * @param Registry $registry
     * @return void
     */
    

    /**
     * Get a users inbox
     * @param int $user the user
     * @return int the cache of messages
     */
    public function getFlaggables($myid,$utype) {

        $where = " 
		
		";

        $namesql = "
                    ,(
                            CASE
                                    WHEN itstype = 1 THEN 'The quantity is greater than 30'
                                    WHEN itstype = 2 THEN 'The quantity is 30'
                                    WHEN itstype = 3 THEN (SELECT name FROM events WHERE events.ID=item LIMIT 1)
                                    ELSE 'The quantity is something else'
                            END
                    ) AS aboutname
		";

        $sql = "SELECT *
		, (SELECT CONCAT(firstname,' ',othernames,' ',surname) FROM profile WHERE user_id=creator LIMIT 1) AS creatorname
		"
                . $namesql .
                "
		FROM flaggables fls $where";
        $cache = DB::query($sql);
        return $cache;
    }
	
	public function createFlaggable($item,$type,$creator)
    {
        $sql = "INSERT INTO flaggables (item,itstype,creator) VALUES ('$item','$type','$creator')";
        DB::query($sql);
    }
	public function initFlaggables($myid,$utype)
	{
		$utype = "(SELECT utype FROM users WHERE ID='$myid' LIMIT 1)";
		$title = "
				(
					CASE
							WHEN itstype = 1 THEN CONCAT_WS(' ','New',(SELECT CAST(abbr AS CHAR CHARACTER SET utf8) FROM subjects WHERE ID=(SELECT subjectid FROM papers WHERE ID=flgs.item LIMIT 1) LIMIT 1), 'homework was uploaded')
							WHEN itstype = 2 THEN 'The quantity is 30'
							WHEN itstype = 3 THEN (SELECT name FROM events WHERE events.ID=item LIMIT 1)
							WHEN itstype = 5 THEN 'Class attendance registration'
							WHEN itstype = 24 THEN 'Teacher Reported Absent (Whole day)'
							WHEN itstype = 25 THEN 'Teacher Reported Absent (Some Periods)'
                            WHEN itstype = 27 THEN 'Disciplinary case was recorded'
                            WHEN itstype = 28 THEN CONCAT((SELECT CONCAT_WS(' ',CAST(firstname AS CHAR CHARACTER SET utf8),CAST(othernames AS CHAR CHARACTER SET utf8),CAST(surname AS CHAR CHARACTER SET utf8)) FROM profile WHERE user_id=item LIMIT 1),' has been absent for a prolonged period')
							WHEN itstype = 30 THEN '2 Homeworks still missing'
							ELSE 'The quantity is something else'
					END
				)
				";

        $absentteacheridsql = "(SELECT teacherid FROM teacherabsentperiods WHERE ID=item LIMIT 1)";
        $absentdatesql = "(SELECT dateabsent FROM teacherabsentperiods WHERE ID=item LIMIT 1)";
				
		$profilestr = "SELECT CONCAT_WS(' ',CAST(firstname AS CHAR CHARACTER SET utf8),CAST(surname AS CHAR CHARACTER SET utf8)) FROM profile WHERE user_id";
				
		$body = "
				(
					CASE
							WHEN itstype = 1 THEN 'click to view'
							WHEN itstype = 2 THEN 'The quantity is 30'
							WHEN itstype = 3 THEN (SELECT name FROM events WHERE events.ID=item LIMIT 1)
							WHEN itstype = 4 THEN (SELECT name FROM events WHERE events.ID=item LIMIT 1)
							WHEN itstype = 5 THEN (SELECT CONCAT_WS(' ',CAST(firstname AS CHAR CHARACTER SET utf8),'You were recorded') FROM profile WHERE user_id='$myid' LIMIT 1)
							WHEN itstype = 24 THEN CONCAT_WS(' ',($profilestr=$absentteacheridsql LIMIT 1),' Day Absent',DAYNAME($absentdatesql),$absentdatesql)
							WHEN itstype = 25 THEN CONCAT_WS(' ',($profilestr=$absentteacheridsql LIMIT 1),' Day Absent',DAYNAME($absentdatesql),$absentdatesql)
							WHEN itstype = 27 THEN 'Please Check'
							WHEN itstype = 28 THEN 'Please Follow up'
							WHEN itstype = 30 THEN 'Please record 2 more ICT homeworks as expected'
							WHEN itstype = 31 THEN 'Please record 2 more ICT Exams/Tests as expected'
                            ELSE 'The quantity is something else'
					END
				)
				";
		
		$sql = "INSERT INTO flags(flaggableid, title, body, notified, flagtype, flagtime, source, flagabout) ";
		//$title = "''";
		//$body = "''";
		
		$select = " SELECT id, $title, $body, '$myid', itstype, timecreated, creator, item FROM flaggables flgs";
		
        //$thisterm = $this->registry->getSetting('thisterm');
        $thisterm = 1;

        $flagdontexist = "((SELECT COUNT(*) FROM flags WHERE flaggableid=flgs.id AND notified = '$myid' ) = 0)";
        $utypestr = "(SELECT utype FROM users WHERE ID='$myid' LIMIT 1)";
        $subscribed = ""
                    ."( 
                        ((SELECT COUNT(*) FROM flagsubs WHERE userid='$myid' AND flagtype=flgs.itstype AND termid='$thisterm') > 0) 
                        OR (flgs.itstype=20)
                        OR ($utypestr=3 AND flgs.itstype=1)
                        OR ($utypestr=4 AND flgs.itstype=1)"
                        ." OR ($utypestr=3 AND flgs.itstype=1)"//if user is student and subject choice changed
                        ." OR ($utypestr=2 AND flgs.itstype=23)"//if user is student and subject choice changed
                        ." OR ($utypestr=2 AND flgs.itstype=24)"//if user is staff and teacher reported as absent the whole day
                        ." OR ($utypestr=2 AND flgs.itstype=25)"//if user is staff and teacher reported as absent for some periods
                        ." OR ($utypestr=2 AND flgs.itstype=27)"//if staff has recorded a disciplinary case
                        ." OR ($utypestr=2 AND flgs.itstype=28)"//if staff has recorded a disciplinary case
                        ." OR ($utypestr=2 AND flgs.itstype=30)"//if staff is teacher check if expected number of hws recorded
                        ." OR ($utypestr=2 AND flgs.itstype=31)"//if staff is teacher check if expected number of Exams recorded
                    .")";
                    //Checks if user is subscribed to flaggable. if user type is (3 student or 4 parent) default is yes 
        $ismyconcern = "
        (
            CASE
                WHEN flgs.itstype = 1 AND 
                        (
                            SELECT COUNT(classid) FROM class_assignments ca WHERE paperid=item 
                            AND (
                                    classid=(SELECT classID FROM studentsinclass WHERE studentid='$myid' AND termid='$thisterm' LIMIT 1)
                                ) 
                            LIMIT 1
                        )>0 THEN '1'
                WHEN flgs.itstype = 5 AND (SELECT COUNT(*) FROM studentsinclass WHERE classID=flgs.item)>0 THEN '1'
                WHEN flgs.itstype = 20 THEN 10
                WHEN flgs.itstype = 24 AND $utypestr=2 THEN 10
                WHEN flgs.itstype = 27 AND $utypestr=2 THEN 10
                WHEN flgs.itstype = 28 AND $utypestr=2 THEN 10
                WHEN flgs.itstype = 30 AND $utypestr=2 THEN 10
                WHEN flgs.itstype = 31 AND $utypestr=2 THEN 10
                ELSE '0'
            END
        ) > 0     
        "; 
        
        $where = " WHERE $flagdontexist AND $subscribed AND $ismyconcern ";
        $where = " WHERE $flagdontexist AND $subscribed AND $ismyconcern ";
        //$where = "";
		
		$sql .= $select." ".$where;
        $cache = DB::query($sql);
        //return $cache;
	}

}


