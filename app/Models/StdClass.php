<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StdClass extends Model
{
    use HasFactory;
    /**
     * Types of group that are available
     */
    private $types = array('public', 'private', 'private-member-invite', 'private-self-invite');

    /**
     * The registry object
     */
    private $registry;

    private $ajax = false;

    /**
     * ID of the group
     */
    private $id;

    /**
     * The name of the class
     */
    private $name;

    /**
     * The abbreviation of the class
     */
    private $abbr;
    /**
     * The class term
     */
    private $term;

    /**
     * Description of the group
     */
    private $description;

    /**
     * The creator of the group
     */
    private $creator;

    /**
     * Name of the creator of the group
     */
    private $creatorName;

    /**
     * Time the group was created
     */
    private $created;

    /**
     * Friendly representation of when the group was created
     */
    private $numberOfStudents;

    /**
     * Type of group
     */
    private $type;

    /**
     * If the group is active or not
     */
    private $active = 1;

    /**
     * If the selected group is valid or not
     */
    private $valid;

    /**
     * Group constructor
     * @param Registry $registry the registry
     * @param int $id the ID of the group
     * @return void
     */
    public function __construct($id = 0, $term = 0, $ajax = false) {
        $this->id = intval($id);
        $this->term = $term;
        
        if(intval($term)<=0)
        {
            $term = "(SELECt svalue FROM settings WHERE skey='thisterm' LIMIT 1)";
        }else
        {
            $term = '$term';
        }

        if ($this->id > 0) {
            
            $sql = "SELECT *"
                    . ", (SELECT COUNT(studentid) FROM studentsinclass WHERE classID=ID AND termid=$term LIMIT 1) AS numberOfStudents"
                    . " FROM classes WHERE ID='" . $this->id . "'";
            $class = DB::select($sql);
            if ($class != NULL) {
                $data = $class;
                //print_r($data);
                $data = $data[0];
                //$this->id = $data['ID'];
                $this->name = $data->name;
                $this->abbr = $data->abbr;
                //$this->description = $data['description'];
                //$this->numberOfStudents = $data['numberOfStudents'];
            } else {
                $this->valid = false;
            }
        } else {
            //$this->id = 0;
        }
        
        //echo "Class id is in const ".$this->id;
    }

    /**
     * Set the name of the group
     * @param String $name
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Set the description of the group
     * @param String $description the description
     * @return void
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Set the creator of the group
     * @param int $creator
     * @return void
     */
    public function setCreator($creator) {
        $this->creator = $creator;
    }

    /**
     * Set the type of the group
     * @param String $type
     * @return void
     */
    public function setType($type) {
        if (in_array($type, $this->types)) {
            $this->type = $type;
        }
    }

    /**
     * Save the group
     * @return void
     */
    

    /**
     * Get a list of topics assigned to this group ( we could paginate this if we wanted to later)
     * @return int (database cache)
     */
    public function getSubjects() {
        $sql = "SELECT *
		, (SELECT name FROM subjects WHERE ID=subjectid LIMIT 1) AS name 
		, (SELECT abbr FROM subjects WHERE ID=subjectid LIMIT 1) AS abbr 
		, (SELECT (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id = ts.teacherid LIMIT 1) FROM teachersubjects ts WHERE ts.subjectid=cs.subjectid AND ts.classid=cs.subjectid LIMIT 1) AS taughtby 
		, (1) AS teacherid 
		FROM classsubjects cs WHERE classid='" . $this->id . "'";
        $cache = DB::select($sql);
        return $cache;
    }

    /**
     * Get a list of topics assigned to this group ( we could paginate this if we wanted to later)
     * @return int (database cache)
     */
    public function getClassHomeworks() {
        /*$sql = "SELECT *
		, (SELECT name FROM subjects WHERE ID=subjectid LIMIT 1) AS name 
		, (SELECT abbr FROM subjects WHERE ID=subjectid LIMIT 1) AS abbr 
		FROM classsubjects WHERE classid='" . $this->id . "'";
        */
        $sql = "SELECT 
                ca.*, 
                pp.* 
                ,(SELECT (GROUP_CONCAT(DISTINCT(classid))) AS classlist FROM class_assignments WHERE paperid=ca.paperid) AS classidlist
                ,(SELECT GROUP_CONCAT(DISTINCT(SELECT abbr FROM classes WHERE ID=classid LIMIT 1)) FROM class_assignments WHERE paperid=ca.paperid) AS classabbrlist
                ,(SELECT name FROM classes WHERE ID=ca.classid LIMIT 1) AS classname
                FROM class_assignments ca, papers pp WHERE pp.ID=ca.paperid AND ca.classid='" . $this->id . "'";
        $cache = DB::select($sql);
        return $cache;
    }

    /**
     * Get a list of topics assigned to this group ( we could paginate this if we wanted to later)
     * @return int (database cache)
     */
    public function getClassExams() {
        /*$sql = "SELECT *
		, (SELECT name FROM subjects WHERE ID=subjectid LIMIT 1) AS name 
		, (SELECT abbr FROM subjects WHERE ID=subjectid LIMIT 1) AS abbr 
		FROM classsubjects WHERE classid='" . $this->id . "'";
        */
        $sql = "SELECT 
                ca.*, 
                pp.*, 
                sub.*,
                (SELECT name FROM classes WHERE ID=ca.classid LIMIT 1) AS classname,
                (SELECT name FROM papertypes WHERE ID=pp.papertype LIMIT 1) AS papertypename
                ,(SELECT (GROUP_CONCAT(DISTINCT(classid))) AS classlist FROM class_exam_papers WHERE paperid=ca.paperid) AS classidlist
                ,(SELECT GROUP_CONCAT(DISTINCT(SELECT abbr FROM classes WHERE ID=classid LIMIT 1)) FROM class_exam_papers WHERE paperid=ca.paperid) AS classabbrlist
                FROM class_exam_papers ca, papers pp, subjects sub WHERE pp.ID=ca.paperid AND sub.ID=(SELECT subjectid FROM papers WHERE ID=ca.paperid LIMIT 1) AND ca.classid='" . $this->id . "'";
        $cache = DB::select($sql);
        return $cache;
    }


    /**
     * Get a list of topics assigned to this group ( we could paginate this if we wanted to later)
     * @return int (database cache)
     */
    
    public function getStudents() {
        $term = $this->term;
        if(intval($term)<=0)
        {
            $term = "(SELECt svalue FROM settings WHERE skey='thisterm' LIMIT 1)";
        }else
        {
            $term = '$term';
        }
        
        $termq = " termid=$term";
        
		if(intval($this->id)>0){
			$sql = "SELECT sic.*,p.* 
                , (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=sic.studentid LIMIT 1) AS stdname
                , (studentid) AS studentid
                , (SELECT username FROM users WHERE ID=p.user_id LIMIT 1) AS stdcode
				, (
						SELECT 
							GROUP_CONCAT((SELECT abbr FROM subjects WHERE ID=ss.subjectid LIMIT 1),' ') 
						FROM std_subjects ss WHERE ss.studentid=sic.studentid AND $termq LIMIT 1
					 ) AS subjectstaken
				 , (
						SELECT 
							GROUP_CONCAT((SELECT id FROM subjects WHERE ID=ss.subjectid LIMIT 1),'') 
						FROM std_subjects ss WHERE ss.studentid=sic.studentid AND $termq LIMIT 1
					 ) AS subjects
				 , (
						YEAR(CURRENT_DATE) 
						- 
						YEAR( (SELECT user_dob FROM profile WHERE user_id=sic.studentid LIMIT 1))
					 ) AS age
                   ,c.phone1
                   ,c.phone2
                   ,c.email1
                   ,c.email2
                   , (SELECT GROUP_CONCAT(attstatus SEPARATOR ', ') FROM studentattendance WHERE studentid=p.user_id GROUP BY studentid) AS atthist
                  FROM studentsinclass sic, profile p, contacts c WHERE p.user_id=sic.studentid  AND c.ID=p.contactid
                  AND classID='" . $this->id . "' AND $termq";

                  /*
                  , IFNULL(p.firstname,c.firstname) AS firstname
                   , IFNULL(p.othernames,c.othernames) AS othernames
                   , IFNULL(p.surname,c.surname) AS surname
                  */
        }
		else{
			$sql = "SELECT sic.*,p.* "
                . ", (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=sic.studentid LIMIT 1) AS stdname"
                . ", (studentid) AS studentid"
				. ", (
						SELECT 
							GROUP_CONCAT((SELECT abbr FROM subjects WHERE ID=ss.subjectid LIMIT 1),' ') 
						FROM std_subjects ss WHERE ss.studentid=sic.studentid AND $termq LIMIT 1
					 ) AS subjectstaken"
				. ", (
						SELECT 
							GROUP_CONCAT((SELECT id FROM subjects WHERE ID=ss.subjectid  LIMIT 1),'') 
						FROM std_subjects ss WHERE ss.studentid=sic.studentid  AND $termq LIMIT 1
					 ) AS subjects"
				. ", (
						YEAR(CURRENT_DATE) 
						- 
						YEAR( (SELECT user_dob FROM profile WHERE user_id=sic.studentid LIMIT 1))
					 ) AS age"
		        . ", (SELECT GROUP_CONCAT(attstatus SEPARATOR ', ') FROM studentattendance WHERE studentid=p.user_id GROUP BY studentid) AS atthist"
                . " FROM studentsinclass sic, profile p WHERE p.user_id=sic.studentid  AND $termq ";
        }
		$cache = DB::select($sql);
        return $cache;
    }

    /**
     * Get a list of teachers assigned to this class
     * @return int (database cache)
     */
    public function getTeachers($term = 0) {
        $t = "AND termid=(SELECT svalue FROM settings WHERE skey='thisterm' LIMIT 1)";
        if(intval($term)>0)
        {
            $t = "AND termid = '$term'";
        }
        $sql = "SELECT * "
                . ", (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=ct.teacherid LIMIT 1) AS teachername"
                . " FROM classteachers ct WHERE classID='" . $this->id . "' $t";
        $cache = DB::select($sql);
        return $cache;
    }

    /**
     * Get a list of teachers assigned to this class
     * @return int (database cache)
     */
    public function getNonFormTeachers($term = 0) {
        $t = "AND termid=(SELECT svalue FROM settings WHERE skey='thisterm' LIMIT 1)";
        if(intval($term)>0)
        {
            $t = "AND termid = '$term'";
        }
        $sql = "SELECT * "
                . ", (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=u.ID LIMIT 1) AS teachername"
                . " FROM users u WHERE u.utype='2' AND (u.ID NOT IN (SELECT teacherid FROM form_teachers ft WHERE classid='".$this->id."')) ";
        $cache = DB::select($sql);
        return $cache;
    }

    /**
     * Get a list of form teachers assigned to this class
     * @return int (database cache)
     */
    public function getFormTeachers($term = 0) {
        $t = "AND termid=(SELECT svalue FROM settings WHERE skey='thisterm' LIMIT 1)";
        if(intval($term)>0)
        {
            $t = "AND termid = '$term'";
        }
        $sql = "SELECT * "
                . ", (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=ft.teacherid LIMIT 1) AS teachername"
                . " FROM form_teachers ft WHERE classid='" . $this->id . "' $t";
        $cache = DB::select($sql);
        return $cache;
    }

    /**
     * Get the ID of the group
     */
    public function getID() {
        return $this->id;
    }

    public function getType() {
        return $this->type;
    }

    public function getStudentAttendanceList($for,$date) {
        $sql = "";
        $classid = $this->id;
        

        $attstatus = "(SELECT attstatus FROM studentattendance WHERE studentid=p.user_id AND classid='$classid' AND attdate=$date LIMIT 1)";
        $timein = "(SELECT timein FROM studentattendance WHERE studentid=p.user_id AND classid='$classid' AND attdate=$date LIMIT 1)";

        $btncolor = "
                CASE
                    WHEN $attstatus = 'P' THEN 'present'
                    WHEN $attstatus = 'A' THEN 'absent'
                    WHEN $attstatus = 'L' THEN 'late'
                    WHEN $attstatus = 'H' THEN 'holiday'
                    WHEN $attstatus = 'D' THEN 'dropout'
                    ELSE 'present'
                END
                ";

        $atthiststr = "(SELECT GROUP_CONCAT(attstatus SEPARATOR ', ') FROM studentattendance WHERE studentid=p.user_id GROUP BY studentid)";

        if($for=="class"){
            $sql = "SELECT sic.*,p.* "
                . ", (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=sic.studentid LIMIT 1) AS stdname"
                . ", (studentid) AS studentid"
                . ", ($btncolor) AS btnbg"
                . ", IFNULL($atthiststr,'') AS atthist"
                . ", IFNULL($attstatus,'P') AS attstatus"
                . ", IFNULL($btncolor,'present') AS attstatuscolor"
                . ", IFNULL($timein,'0:00') AS timein"
                . " FROM studentsinclass sic, profile p WHERE p.user_id=sic.studentid AND classID='" . $classid . "'";
        
        }
        if($for=="period"){
            $sql = "SELECT sic.*,p.* "
                . ", (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=sic.studentid LIMIT 1) AS stdname"
                . ", (studentid) AS studentid"
                . ", ($btncolor) AS btnbg"
                . ", IFNULL($atthiststr,'') AS atthist"
                . ", IFNULL($attstatus,'P') AS attstatus"
                . ", IFNULL($timein,'0:00') AS timein"
                . ", (SELECT GROUP_CONCAT(attstatus SEPARATOR ', ') FROM studentattendance WHERE studentid=p.user_id GROUP BY studentid) AS atthist"
                . ", (SELECT IFNULL(attstatus,'P') FROM studentattendance WHERE studentid=p.user_id AND classid='$classid' AND attdate='$date' AND lessonid='$period' LIMIT 1) AS attstatus"
                . " FROM studentsinclass sic, profile p WHERE p.user_id=sic.studentid AND classID='" . $classid . "'";
        
        }

        $outp = DB::select($sql);

        /*if ($this->ajax) {
            echo json_encode($outp);
        }else
        {*/
            return $outp;
        //}
    }

    public function getStudentSubjects()
    {
       
        $classid = $this->id;
        
        ///IFNULL((SELECT COUNT(*) FROM std_stubjects WHERE studentid=sic.studentid LIMIT 1),1)
        $sql = "SELECT sic.studentid
            , (CONCAT_WS(' ',p.firstname,p.othernames,p.surname)) AS stdname
            ,(SELECT GROUP_CONCAT(IF((SELECT COUNT(*) FROM std_subjects ss WHERE ss.studentid=sic.studentid AND ss.subjectid=cs.subjectid)>0,'T','D')) FROM classsubjects cs WHERE cs.classid='$classid') AS takingstatuses
            ,(SELECT GROUP_CONCAT(cs.subjectid) FROM classsubjects cs WHERE cs.classid='$classid') AS thesubjects
        FROM studentsinclass sic, profile p WHERE p.user_id=sic.studentid AND sic.classid='$classid'
        ORDER BY (SELECT ROUND(IFNULL(SUM(scoreValue)/IFNULL((SELECT COUNT(*) FROM std_subjects ss WHERE ss.studentid=sic.studentid LIMIT 1),0),0)) FROM scores sc WHERE sc.studentid=sic.studentid AND (SELECT papertype FROM papers WHERE ID=sc.paperid LIMIT 1)!=2 LIMIT 1) DESC
        ";

        /*
        $sql = "SELECT sic.studentid
        , (CONCAT_WS(' ',p.firstname,p.othernames,p.surname)) AS stdname
        ,(SELECT GROUP_CONCAT(IF((SELECT COUNT(*) FROM std_subjects ss WHERE ss.studentid=sic.studentid AND ss.subjectid=cs.subjectid)>0,'T','D')) FROM classsubjects cs WHERE cs.classid='$classid') AS takingstatuses
        ,(SELECT GROUP_CONCAT(cs.subjectid) FROM classsubjects cs WHERE cs.classid='$classid') AS thesubjects
        FROM studentsinclass sic, profile p WHERE p.user_id=sic.studentid AND sic.classid='$classid'
        ORDER BY (SELECT ROUND(IFNULL(SUM(scoreValue)/IFNULL((SELECT COUNT(*) FROM std_subjects ss WHERE ss.studentid=sic.studentid LIMIT 1),0),0)) FROM scores sc WHERE sc.studentid=sic.studentid AND (SELECT papertype FROM papers WHERE ID=sc.paperid LIMIT 1)!=2 LIMIT 1) DESC
        ";
        */
        
        return DB::select($sql);
        //return $sql;
        //return DB::select(DB::raw($sql));
        /*$data = DB::table('raw_plans')
            ->select(DB::raw("group_concat(raw_plans.name)"))
            ->groupBy('flag')
            ->where('assignement_id',1)
            ->get();*/
        //return DB::select($sql);
            
    }
    public function getOtherClasses($classid=0) {
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
                . " FROM classes cl WHERE ID!='$classid'";

        $cache = DB::select($sql);
        return $cache;
    }


    /**
     * Convert the group data to template tags
     * @param String $prefix prefix for the template tags
     * @return void
     */
    public function toTags($prefix = '') {
        foreach ($this as $field => $data) {
            if (!is_object($data) && !is_array($data)) {
                $this->registry->getObject('template')->getPage()->addTag($prefix . $field, $data);
            }
        }
    }

    public function isValid() {
        return $this->valid;
    }

    public function isActive() {
        return $this->active;
    }

    public function getCreator() {
        return $this->creator;
    }

}
