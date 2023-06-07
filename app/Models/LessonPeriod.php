<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonPeriod extends Model
{


	/**
	 * ID of the lesson period
	 */
	private $id;
	
	/**
	 * ID of the creator of the lesson period
	 */
	private $creator;
	
	/**
	 * ID of the creator of the lesson period
	 */
	private $classid,$classname,$classabbr;
	
	/**
	 * Name of the creator of the lesson period
	 */
	private $subAbbr;
	
	/**
	 * Starting Time  of the next lesson period
	 */
	private $starttime;
	
	/**
	 * Name of the teacher of the lesson
	 */
	private $teachername, $teacherid;
	
	/**
	 * Ending Time  of the next lesson period
	 */
	private $endtime;
	
	/**
	 * Time before this period starts of the lesson period
	 */
	private $timebeforestart;
	
	/**
	 * date of creation of the lesson period
	 */
	private $date;
	
	/**
	 * date of creation of the lesson period
	 */
	private $pdate;
	
	/**
	 * date of creation of the lesson period
	 */
	private $status;
	
	/**
	 * Timestamp of when the lesson period was created
	 */
	private $created;
	
	/**
	 * Friendly representation of when the lesson period was created
	 */
	private $createdFriendly;
	
	/**
	 *  of the content the lesson period relates to
	 */
	private $content;
	
	/**
	 * The type lesson period itself
	 */
	private $studentscache;
	
	/**
	 * lesson period constructor
	 * @param Registry $registry the registry object
	 * @param int $id the ID of the lesson period
	 * @return void
	 */
	public function __construct( $id=0, $fetchdetails = true, $date="" )
	{
		$this->id = $id;
		if( $this->id > 0 && $fetchdetails )
		{
			//$sql = "SELECT * FROM lessons WHERE ID='$id'";

			$statusstr = ",('Not Available') AS status";
			$datediff = "DATEDIFF(DATE_FORMAT(CURRENT_DATE(),'%Y-%m-%d'),'$date')";

			if($date!=""){
				$statusstr = "
					,(CASE
						WHEN DATE_FORMAT(CURRENT_TIME(),'%H:%i') < DATE_FORMAT(starttime,'%H:%i') 
							THEN IF($datediff>0,'past','upcoming')
						WHEN DATE_FORMAT(CURRENT_TIME(),'%H:%i') BETWEEN starttime AND endtime 
							THEN IF($datediff>0,'past',IF($datediff<0,'upcoming','ongoing'))
						WHEN DATE_FORMAT(CURRENT_TIME(),'%H:%i') > CAST(endtime AS CHAR CHARACTER SET utf8) THEN 'past'
						ELSE 'Not Available'
					END) as status
				";
			}
			//echo $statusstr = ",DATEDIFF(DATE_FORMAT(CURRENT_DATE(),'%Y-%m-%d'),'$date') AS status";
			//echo $statusstr = ",DATE_FORMAT(CURRENT_DATE(),'%Y-%m-%d') AS status";

			$sql = "SELECT p.*
				, IFNULL((SELECT abbr FROM subjects WHERE ID=(SELECT subjectid FROM teacherperiods WHERE periodid = p.ID LIMIT 1) LIMIT 1),'--') AS subjectabbr
				, IFNULL((SELECT name FROM subjects WHERE ID=(SELECT subjectid FROM teacherperiods WHERE periodid = p.ID LIMIT 1) LIMIT 1),'--') AS subjectname
				, IFNULL((SELECT (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=teacherid LIMIT 1) FROM teacherperiods WHERE periodid = p.ID LIMIT 1),'Not Available') AS teachername
				, (SELECT classid FROM teacherperiods WHERE periodid = p.ID LIMIT 1) AS classid
				, IFNULL((SELECT name FROM classes WHERE ID=(SELECT classid FROM teacherperiods WHERE periodid = p.ID LIMIT 1) LIMIT 1),'--') AS classname
				, IFNULL((SELECT abbr FROM classes WHERE ID=(SELECT classid FROM teacherperiods WHERE periodid = p.ID LIMIT 1) LIMIT 1),'--') AS classabbr
				, IFNULL(
					(SELECT (SELECT (SELECT LOWER(TRIM(colorvalue)) FROM sitecolors sc WHERE ID=staff.colorcode LIMIT 1) FROM staff WHERE user_id=tp.teacherid LIMIT 1) FROM teacherperiods tp WHERE periodid = p.ID LIMIT 1)
				, 'white') AS teachercolor
				, (SELECT teacherid FROM teacherperiods WHERE periodid = p.ID LIMIT 1) AS teacherid
				, DATE_FORMAT(starttime,'%H:%i') AS fstart
				, DATE_FORMAT(endtime,'%H:%i') AS fend
				$statusstr
			FROM periods p WHERE p.ID='$id'";

			$this->registry->getObject('db')->executeQuery( $sql );
			if( $this->registry->getObject('db')->numRows() > 0 )
			{
				$data = $this->registry->getObject('db')->getRows();
				$data = $data[0];
				$this->id = $data['ID'];
				$this->subAbbr = $data['subjectabbr'];
				$this->starttime = $data['fstart'];
				$this->endtime = $data['fend'];
				$this->classname = $data['classname'];
				$this->classabbr = $data['classabbr'];
				$this->classid = $data['classid'];
				$this->status = $data['status'];
				$this->teacherid = $data['teacherid'];
				$this->teachername = $data['teachername'];
				
				//$this->studentscache = $this->getStudents($this->classid);
			}
			else
			{
				$this->id = 0;
			}
		}
	}
	
	/**
	 * Set the creator of the post
	 * @param int $c the creator
	 * @return void
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Set the creator of the post
	 * @param int $c the creator
	 * @return void
	 */
	public function getClassid()
	{
		return $this->classid;
	}
	
	/**
	 * get the date the period is being taught post
	 * @param int $c the creator
	 * @return void
	 */
	public function getDate()
	{
		return $this->date;
	}
	
	
	/**
	 * get the date the period is being taught post
	 * @param int $c the creator
	 * @return void
	 */
	public function getTeachername()
	{
		return $this->teachername;
	}
	
	/**
	 * Set the creator of the post
	 * @param int $c the creator
	 * @return void
	 */
	public function getTimeBeforeStart()
	{
		return $this->timebeforestart;
	}
	
	/**
	 * Set the creator of the post
	 * @param int $c the creator
	 * @return void
	 */
	public function setCreator( $c )
	{
		$this->creator = $c;
	}
	
	/**
	 * Set the creator of the post
	 * @param int $c the creator
	 * @return void
	 */
	public function setDate( $c )
	{
		$this->date = $c;
	}
	
	/**
	 * Set the topic the post relates to
	 * @param int $t the topic ID
	 * @return void
	 */
	public function setTimeBeforeStart( $t )
	{
		$this->timebeforestart = $t;
	}
	
	/**
	 * Set the post content
	 * @param String $p the post itself
	 * @return void
	 */
	public function setPostfor( $p )
	{
		$this->postfor = $p;
	}
	/**
	 * Set the post content
	 * @param String $p the post itself
	 * @return void
	 */
	public function setPtime( $p )
	{
		$this->ptime = $p;
	}
	/**
	 * Set the post content
	 * @param String $p the post itself
	 * @return void
	 */
	public function setPdate( $p )
	{
		$this->pdate = $p;
	}
	/**
	 * Set the post content
	 * @param String $p the post itself
	 * @return void
	 */
	public function setPosttype( $p )
	{
		$this->posttype = $p;
	}
	
	/**
	 * Save the post in the database
	 * @return void
	 */
	public function saveNow()
	{
		if( $this->id > 0 )
		{
			$update = array();
			$update['topic'] = $this->topic;
			$update['post'] = $this->post;
			$update['creator'] = $this->creator;
			$this->registry->getObject('db')->updateRecords( 'posts', $update, 'ID=' . $this->id );
		}
		else
		{
			$insert = array();
			$insert['content'] = $this->content;
			$insert['postfor'] = $this->postfor;
			$insert['creator'] = $this->creator;
			$insert['posttype'] = $this->posttype;
			$insert['posttime'] = $this->ptime;
			$insert['postdate'] = $this->pdate;
			$this->registry->getObject('db')->insertRecords( 'posts', $insert );
			$this->id = $this->registry->getObject('db')->lastInsertID();
		}
		
	}

	public function getStudents($classid) {
    	$sql = "SELECT sic.*,p.* "
                . ", (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=sic.studentid LIMIT 1) AS stdname"
                . ", (studentid) AS studentid"
                . ", (
                        SELECT 
                            GROUP_CONCAT((SELECT abbr FROM subjects WHERE ID=ss.subjectid LIMIT 1),' ') 
                        FROM std_subjects ss WHERE ss.studentid=sic.studentid LIMIT 1
                        ) AS subjectstaken"
                . ", (
                        SELECT 
                            GROUP_CONCAT((SELECT id FROM subjects WHERE ID=ss.subjectid LIMIT 1),'') 
                        FROM std_subjects ss WHERE ss.studentid=sic.studentid LIMIT 1
                        ) AS subjects"
                . ", (
                        YEAR(CURRENT_DATE) 
                        - 
                        YEAR( (SELECT user_dob FROM profile WHERE user_id=sic.studentid LIMIT 1))
                        ) AS age"
                . " FROM studentsinclass sic, profile p WHERE p.user_id=sic.studentid AND classid='$classid'";
                 

        $cache = $this->registry->getObject('db')->cacheQuery($sql);
        return $cache;
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
}
