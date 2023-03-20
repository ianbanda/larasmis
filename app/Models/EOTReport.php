<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EOTReport extends Model
{
    use HasFactory;
    private $stdcode;
    private $stdname;
    private $schoolname;
    private $schooladdress;
    private $stdposition;
    private $stdclass;
    private $classcode;
    private $classname;
    private $assigctr = 3;
    private $testctr = 2;
    private $sic;
    private $term;
    private $termname;
    private $termnumber;
    private $nextterm;
    private $comment;
    private $year;
    private $fepercentage = 60;
    private $capercentage = 40;
    
    private $rows = array();
    
    private $empty=true;

    /**
     * Post constructor
     * @param int $id the ID of the post
     * @return void
     */
    public function __construct( $std, $classid, $termid) {
        $this->stdclass = $classid;
        $this->classcode = $classid;
        $this->term = $termid;   

		
		$term = " '".$termid."' ";
		if(intval($termid)<=0)
		{
			$term = "(SELECT svalue FROM settings WHERE skey='thisterm' LIMIT 1)";
		}
		
		$class = " '".$classid."'";
		if(intval($classid)<=0)
		{
			$class = "(SELECT classid FROM studentsinclass WHERE studentid = '$std' AND termid=$term LIMIT 1)";
		}
        
        $sql = "SELECT 
            (SELECT CONCAT_WS(' ',p.firstname,p.othernames,p.surname) FROM profile WHERE user_id='$std') AS stdname
            ,(SELECT word FROM teachers_comments WHERE commenttype='ft' AND studentid='$std' AND termid=$term AND classid=$class LIMIT 1) AS ftcomment
            ,(SELECT name FROM classes WHERE ID=$class) AS classname
            ,(SELECT number FROM terms WHERE ID=$term) AS termnumber
            ,(SELECT no_of_assignments FROM terms WHERE ID='$termid' LIMIT 1) AS numofhws
            ,(SELECT no_of_tests FROM terms WHERE ID='$termid' LIMIT 1) AS testctr
            ,(SELECT name FROM academic_years WHERE ID=(SELECT year FROM terms WHERE ID=$term LIMIT 1)) AS academicyear
            ,(SELECT next_term_opens FROM term_settings WHERE termid=$term) AS nexttermopens
         FROM profile p WHERE user_id = '$std'";

        $data = array();
        
        //$data = DB::select($sql);
        $result = DB::select($sql);
        //print_r();
        foreach($result as $row)
        {
            $data[] = (array) $row;
            
        }

        //dd($data[0]);

        $data = $data[0];
        $this->assigctr = $data["numofhws"];
        $this->testctr = $data["testctr"];
        $this->stdname = $data["stdname"];
        $this->classname = $data["classname"];
        $this->termnumber = $data["termnumber"];
        $this->year = $data["academicyear"];
        $this->comment = $data["ftcomment"];
        $this->nextterm = $data["nexttermopens"];

        $this->generateRows($std, $classid, $termid,);

        
        //$this->rows = array("ian","brian","banda");

        //print_r($result);

        $this->stdcode = $std;

    }


    /**
     * Set the creator of the post
     * @param int $c the creator
     * @return void
     */
    public function setCreator($c) {
        $this->creator = $c;
    }

    public function getClass() {
        return $this->stdclass;
    }

    public function getStudentName() {
        return $this->stdname;
    }

    public function getClassName() {
        return $this->classname;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getTerm() {
        return $this->term;
    }

    public function getNextTerm() {
        return $this->nextterm;
    }

    public function getTermnumber() {
        return $this->termnumber;
    }

    public function getYear() {
        return $this->year;
    }
    
    public function isEmpty() {
        return $this->empty;
    }

    public function generateRows($std, $classid, $termid) {

        $scoresql = $this->scoreSqlStr($std, $classid, $termid,$this->assigctr);
        $gradesql = $this->gradeSqlStr($std, $classid, $termid,$this->assigctr);

        if(intval($termid)>0)
        {
            $termid = "'$termid'";
        }else
        {
            $termid = "(SELECT svalue FROM settings WHERE skey='thisterm' LIMIT 1)";
        }

        $sql = "SELECT ss.*
            , (SELECT name FROM subjects WHERE ID=ss.subjectid LIMIT 1) AS subjectname
            , $scoresql AS score
            $gradesql
         FROM std_subjects ss WHERE studentid='$std' AND termid=$termid";

        $result = array();
        
        
		$result = DB::select($sql);

        

        for($i=0;$i<15;$i++){
            if(isset($result[$i])){
                $d[] = (array)$result[$i];
                
                $data = $d[0];
                
                //$row = array($data["subjectname"],$data["score"],$data["grade"]);
                $row = $data;
                $row["subjectname"] = $data["subjectname"];
                $row["score"] = $data["score"];
                $row["grade"] = $data["grade"];
            }else
            {
                $row["subjectname"] = "";
                $row["score"] = "";
                $row["grade"] = "";
            }
            

            $this->rows[] = $row;
            //dd($this->rows);
        }
         
    }

    public function getRows() {
        return $this->rows;
    }

    private function scoreHWSqlStr($std, $classid, $termid,$assigcount=3)
    {
        $paperterm = "(SELECT termid FROM papers WHERE ID=sc.paperid LIMIT 1)=$termid";
        /*$numofhws = "(SELECT no_of_assignments FROM terms WHERE ID=$termid LIMIT 1)";
        $contribution = "(SELECT assigpercentage FROM terms WHERE ID=$termid LIMIT 1)";
        $subjectsql = "(SELECT subjectid FROM papers WHERE ID=paperid LIMIT 1)";
        $papertypeval = "(SELECT papertype FROM papers WHERE ID=paperid LIMIT 1)";
        $paperids = "(SELECT paperid FROM class_assignments WHERE classid='$classid')";
        $hwvalue = "((SELECT (SUM(scoreValue)/$numofhws)*($contribution/100)) FROM scores WHERE studentid='$std' AND $subjectsql=ss.subjectid AND paperid IN $paperids)/$numofhws)";
        */
        $hwvalue = "(SELECT (SUM(scoreValue)/(SELECT no_of_assignments FROM terms WHERE ID=$termid LIMIT 1))*(10/100) FROM scores sc 
        WHERE studentid='$std' AND $paperterm AND (paperid IN (SELECT paperid FROM class_assignments WHERE (SELECT subjectid FROM papers WHERE ID=paperid LIMIT 1)=ss.subjectid)) LIMIT $assigcount)";     
        /*
        SELECT (SUM(scoreValue)/(SELECT no_of_assignments FROM terms WHERE ID='1' LIMIT 1))*(10/100)
        FROM scores WHERE studentid='143' AND (paperid IN (SELECT paperid FROM class_assignments WHERE (SELECT subjectid FROM papers WHERE ID=paperid LIMIT 1)='9')) LIMIT 3
        */
        
        //$s = "ROUND(($hwvalue)*(10/100))";
        $s = "IFNULL(ROUND($hwvalue),0)";

        return $s;
    }

    private function scoreTestSqlStr($std, $classid, $termid,$testcount=2)
    {
        $paperterm = "(SELECT termid FROM papers WHERE ID=sc.paperid LIMIT 1)=$termid";
        $contribution = "(SELECT testpercentage FROM terms WHERE ID=$termid LIMIT 1)";
        $subjectsql = "(SELECT subjectid FROM papers WHERE ID=paperid LIMIT 1)";

        $testvalue = "(SELECT (SUM(scoreValue)/(SELECT no_of_tests FROM terms WHERE ID=$termid LIMIT 1))*($contribution/100) 
        FROM scores sc WHERE studentid='$std' AND $paperterm 
        AND (paperid IN (SELECT paperid FROM class_exam_papers WHERE examgroupid!=1 AND $subjectsql=ss.subjectid)) LIMIT $testcount)";     

        $s = "IFNULL(ROUND($testvalue),0)";

        return $s;
    }

    private function scoreFinalSqlStr($std, $classid, $termid)
    {
        $paperterm = "(SELECT termid FROM papers WHERE ID=sc.paperid LIMIT 1)=$termid";
        $contribution = "(SELECT testpercentage FROM terms WHERE ID=$termid LIMIT 1)";
        $subjectsql = "(SELECT subjectid FROM papers WHERE ID=paperid LIMIT 1)";

        $testvalue = "(SELECT (SUM(scoreValue)/(SELECT no_of_tests FROM terms WHERE ID=$termid LIMIT 1))*($contribution/100) 
        FROM scores sc WHERE studentid='$std' AND $paperterm 
        AND (paperid IN (SELECT paperid FROM class_exam_papers WHERE examgroupid=1 AND $subjectsql=ss.subjectid)))";     

        $s = "IFNULL(ROUND($testvalue),0)";

        return $s;
    }


    private function scoreSqlStr($std, $classid, $termid,$assigctr=3)
    {
        if(intval($termid)>0)
        {
            $termid = "'$termid'";
        }else
        {
            $termid = "(SELECT svalue FROM settings WHERE skey='thisterm' LIMIT 1)";
        }
        $homeworkscore = $this->scoreHWSqlStr($std,$classid,$termid,$assigctr);
        $testscore = $this->scoreTestSqlStr($std,$classid,$termid,$this->testctr);
        $finalexamscore = $this->scoreFinalSqlStr($std,$classid,$termid);
       
        $s = "($homeworkscore+$testscore+$finalexamscore)";
        $s = "($homeworkscore+$testscore)";
        //$s = "($homeworkscore)";
        //$s = "(10)";

        return $s;
    }

    private function gradeSqlStr($std, $classid, $termid,$assigctr=3)
    {
        $classgradingsystem = "(SELECT gsid FROM class_grading_systems WHERE classid='$classid' AND termid='$termid' LIMIT 1)";
        $score = $this->scoreSqlStr($std, $classid, $termid,$assigctr);
        return $g = ",(SELECT grade FROM gradingranges WHERE ($score BETWEEN scorefrom AND scoreto) AND gsid=$classgradingsystem LIMIT 1) AS grade";
        //return $g = ",(SELECT grade FROM gradingranges WHERE ($score BETWEEN scorefrom AND scoreto) LIMIT 1) AS grade";
    }
}
