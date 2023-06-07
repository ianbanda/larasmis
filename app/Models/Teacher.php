<?php

namespace App\Models;

use App\Models\LessonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Teacher extends User {

    private $id;
    private $code;
    private $firstname;
    private $othernames;
    private $surname;
    private $fullname;
    private $dob;
    private $gender;
    private $classid;
    private $classurname;
    private $staffcolor;
    private $photo;
    private $nationality;
    private $sic;
    private $registry;

    public function __construct($id=0, $code = 0, $fetchdetails = true) {
        
        $this->id = $id;
        $this->code = $code;

		if ($this->id == 0) {
        }
        else if ($this->id == 0 && $fetchdetails){
            $sql = "SELECT users.*, p.* "
            . ",(SELECT classID FROM studentinfo WHERE studentid='" . $id . "' LIMIT 1) AS classid"
            . ",(SELECT name FROM classes WHERE code=(SELECT classID FROM studentinfo WHERE studentid='" . $id . "' LIMIT 1) LIMIT 1) AS classurname"
            . ",(SELECT COUNT(*) FROM studentsinclass WHERE classID=(SELECT classID FROM studentinfo WHERE studentid='" . $id . "' LIMIT 1) LIMIT 1) AS sic"
			. ",(SELECT name FROM pics WHERE ID=p.photo LIMIT 1) AS photo"
			. ",(SELECT LTRIM(colorvalue) FROM sitecolors WHERE ID=(SELECT colorcode FROM staff WHERE user_id=p.user_id LIMIT 1) LIMIT 1) AS staffcolor"
            . "  FROM users, profile p WHERE ID='" . $id . "' AND p.user_id=users.ID";

            $row = DB::query($sql);



            $this->firstname = $row["firstname"];
            $this->othernames = $row["othernames"];
            $this->surname = $row["surname"];
            $this->dob = $row["user_dob"];
            $this->gender = $row["gender"];
            $this->photo = $row["photo"];
            $this->id = $row["ID"];
            $this->nationality = $row["nationality"];
            $this->staffcolor = strtolower($row["staffcolor"]);
            //echo $row["xname"];

            $this->fullname = $this->firstname . " " . $this->othernames . " " . $this->surname;

            $this->gender = $row["gender"];


            return $this;
        }
    }

    public function getCode() {
        return $this->code;
    }

    public function getfirstname() {
        return $this->firstname;
    }

    public function getothernames() {
        return $this->othernames;
    }

    public function getsurname() {
        return $this->surname;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function timeBeforeNextLesson() {
        $sql = "SELECT tp.teacherid,p.ID, 
        TIMEDIFF(CURRENT_TIME,p.starttime) AS timeBeforeNextLesson
        FROM teacherperiods tp,periods p WHERE p.ID=tp.periodid AND tp.teacherid='1' AND p.weekday=DAYNAME(CURRENT_DATE) AND p.starttime>CURRENT_TIME; ";

        $row = DB::query($sql);

        return $row["timeBeforeNextLesson"];
            
    }

    public function nextLessonPeriod() {
        $sql = "SELECT tp.*,p.ID, 
        MINUTE(TIMEDIFF(p.starttime,CURRENT_TIME)) AS timeBeforeNextLesson
        FROM teacherperiods tp,periods p WHERE p.ID=tp.periodid AND tp.teacherid='".$this->id."' AND p.weekday=DAYNAME(CURRENT_DATE) AND p.starttime>CURRENT_TIME; ";

        $lp = null;
        DB::query($sql);
		if ($this->registry->getObject('db')->numRows() == 1) {
			$rows = $this->registry->getObject('db')->getRows();
			$data = $rows[0];

            $lp = new LessonPeriod($data["periodid"],false);
            $lp->setTimeBeforeStart($data['timeBeforeNextLesson']);
        }

        return $lp;
            
    }

    public function getIncompleteSubjectHws() {
        $sql = "
            SELECT *
            , (assigctr-assiggiven) AS assigdiff
            FROM (SELECT *
            ,(SELECT abbr FROM subjects WHERE ID=ts.subjectid LIMIT 1) AS subabbr 
            ,(SELECT no_of_assignments FROM terms WHERE ID=ts.termid LIMIT 1) AS assigctr 
            ,(SELECT COUNT(*) FROM class_assignments ca WHERE termid=ts.termid AND classid=ts.classid AND (SELECT pp.subjectid FROM papers pp WHERE ID=ca.paperid LIMIT 1)=ts.subjectid) AS assiggiven
            FROM teachersubjects ts WHERE ts.teacherid='1') AS assessstats WHERE (assigctr-assiggiven)>0
        ";

        $data = null;
        DB::query($sql);
		if ($this->registry->getObject('db')->numRows() > 0) {
			$rows = $this->registry->getObject('db')->getRows();
			$data = $rows;

            //print_r($rows);
        }

        
        return $data;
            
    }

    
    /**
     * Convert the event data to template tags
     * @param String $prefix prefix for the template tags
     * @return voID
     */
    public function toTags($prefix = '') {
        foreach ($this as $field => $data) {
            if (!is_object($data) && !is_array($data)) {
                if ($this->registry->getObject('authenticate')->isLoggedIn()) {
                    $this->registry->getObject('template')->getPage()->addTag($prefix . $field, $data);
                } else {
                    if ($field == "name") {
                        $this->registry->getObject('template')->getPage()->addTag($prefix . $field, $data);
                    } else {
                        $this->registry->getObject('template')->getPage()->addTag($prefix . $field, "Login to view this information");
                    }
                }
            }
        }
    }

    /**
     * Generate paginated members list
     * @param int $offset the offset
     * @return Object pagination object
     */
    public function getPeriods($day="",$date="") {
        $filter =" AND teacherid ='".$this->id."' ";
        if(!empty($day))
        {
            $filter = " AND weekday='$day'";
        }
       
	   	$sql = "SELECT p.*,tps.*
			, (SELECT abbr FROM subjects WHERE ID=subjectid LIMIT 1) AS subjectabbr
			, (SELECT name FROM subjects WHERE ID=subjectid LIMIT 1) AS subjectname
			, (SELECT name FROM classes WHERE ID=tps.classid LIMIT 1) AS classname
			, (SELECT abbr FROM classes WHERE ID=tps.classid LIMIT 1) AS classabbr
			, DATE_FORMAT(starttime,'%H:%i') AS fstart
            , DATE_FORMAT(endtime,'%H:%i') AS fend
			FROM periods p, teacherperiods tps WHERE tps.periodid=p.ID ".$filter;

        $cache = $this->registry->getObject('db')->cacheQuery($sql);
        return $cache;
    }
}

