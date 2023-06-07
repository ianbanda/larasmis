<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attendances extends Model
{
    use HasFactory;
    /**
     * Get a list of students in attendance based on class, exam, or etc
     * @return int (database cache)
     */
    public function getStudents($date,$classid,$atttype,$period=0) {
		$attstatus = "(SELECT attstatus FROM studentattendance 
						WHERE studentid=p.user_id AND classid='$classid' AND atttype='$atttype' AND attdate='$date'
						 LIMIT 1)";
		$timein = "(SELECT timein FROM studentattendance 
						WHERE studentid=p.user_id AND classid='$classid' AND atttype='$atttype' AND attdate='$date'
						 LIMIT 1)";
		$attstatusclass = "(SELECT 
			CASE
				WHEN attstatus='P' THEN 'present'
				WHEN attstatus='A' THEN 'absent'
				WHEN attstatus='L' THEN 'Late'
				WHEN attstatus='S' THEN 'sick'
				WHEN attstatus='H' THEN 'holiday'
				
				ELSE 'present'
			END
		FROM studentattendance WHERE studentid=p.user_id AND classid='$classid' AND attdate='$date' LIMIT 1)";
		
		//if($for=="class"){
			$sql = "SELECT sic.*,p.* "
                . ", (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=sic.studentid LIMIT 1) AS stdname"
                . ", (studentid) AS studentid"
				. ", (SELECT GROUP_CONCAT(attstatus SEPARATOR ', ') FROM studentattendance WHERE studentid=p.user_id AND atttype='$atttype' GROUP BY studentid) AS atthist"
                . ", IFNULL($attstatus,'P') AS attstatus"
                . ", IFNULL($timein,'0.00') AS timein"
                . ", IFNULL($attstatusclass,'present') AS attstatuscolor"
                . " FROM studentsinclass sic, profile p WHERE p.user_id=sic.studentid AND classID='" . $classid . "'";
        /*
		}
		if($for=="period"){
			$sql = "SELECT sic.*,p.* "
                . ", (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=sic.studentid LIMIT 1) AS stdname"
                . ", (studentid) AS studentid"
				. ", (SELECT GROUP_CONCAT(attstatus SEPARATOR ', ') FROM studentattendance WHERE studentid=p.user_id AND atttype='Period' GROUP BY studentid) AS atthist"
                . ", IFNULL((SELECT IFNULL(attstatus,'P') FROM studentattendance WHERE studentid=p.user_id AND classid='$classid' AND attdate='$date' AND periodid='$period' LIMIT 1),'P') AS attstatus"
                . " FROM studentsinclass sic, profile p WHERE p.user_id=sic.studentid AND classID='" . $classid . "'";
        
		}
		*/
		$cache = DB::select($sql);
		//print_r($cache);
        return $cache;
    }

	public function saveAttendance($date, $classid, $recorder, $students,$lessonid=0) 
	{
		$v = $_POST['students'];
		$atttype = "class";
		if(intval($lessonid)>0){
			$atttype = "Lesson";
		}
        $sql = "INSERT INTO studentattendance (recordedby,studentid, classid,periodid, attstatus, atttype, attdate,timein) VALUES ";
		$values = "";
		
		$ctr = 0;
		$v = "straight";

		
		
		//print_r($post);
		if(intval($recorder)>0&&!isset($students))
		{
			$v = 'here';
			//$array = json_decode($post[$recorder]);
		}
		else
		{
			$array = json_decode($students);
			//$v = $array;
		}
			
		
		if(is_array($array))
		{
			
			for($i=0;$i<sizeof($array);$i++)
			{
				
				$ctr++;
				$sca = $array[$i];
				$v = $sca;

				
				if($i>0){
					$values .= ",";
				}

				
				$datevalue  = "";
				$v = $_REQUEST;
				if(isset($_REQUEST['date'])){
					$datevalue  = $_REQUEST['date'];
					$v = $datevalue;
				}

				if($datevalue!=0)
				{
					$datevalue=date("Y-m-d");
				}

				$periodid = "";
				$timein = "";
				
				
				if($atttype=="Lesson")
				{
					$periodid = $sca->periodid;
					if($sca->time==null)
					{
						$timein = $sca->time;
					}
				}
				
				
				$values = " ('".$recorder."','".$sca->studentid."','".$sca->classid."','".$periodid."','".$sca->attstatus."','$atttype','".$datevalue."','".$timein."')";
				$update = " ON DUPLICATE KEY UPDATE attstatus='".$sca->attstatus."'";
				//$s = $sql . $values . $update;
				$s = $sql . $values ;
				
				
				$del = "DELETE FROM studentattendance WHERE classid='"
				.$sca->classid."' AND studentid='".$sca->studentid."' AND attdate='".$datevalue."' AND atttype='Daily'";
				if($atttype=='Lesson')
				{
					$del = "DELETE FROM studentattendance WHERE classid='"
					.$sca->classid."' AND periodid='".$sca->periodid."' AND studentid='".$sca->studentid."' AND attdate='".$datevalue."' AND atttype='Daily'";
				}

				//(recordedby,studentid, classid,periodid, attstatus, atttype, attdate,timein)
				$insertArray = array(
										"recordedby"=>$recorder
										,"studentid"=>$sca->studentid
										,"classid"=>$sca->classid
										,"periodid"=>$periodid
										,"attstatus"=>$sca->attstatus
										,"atttype"=>$atttype
										,"attdate"=>$datevalue
										,"timein"=>$timein
									);
				
				try {
					$v = $del;
					DB::delete($del);

					
					//DB::insert($s);
					DB::table('studentattendance')->insert($insertArray);
					
				} catch(\Illuminate\Database\QueryException $ex){ 
					//dd($ex->getMessage()); 
					$v = $ex->getMessage();
					// Note any method of class PDOException can be called on $ex.
				}
				//DB::

				$flagbody = "You were recorded as ";
				switch($sca->attstatus)
				{
					case "A":
						$flagbody .= " Absent";
						break;
					case "P":
						$flagbody .= " Present";
						break;
					case "L":
						$flagbody .= " on Leave";
						break;
					case "H":
						$flagbody .= " on Holiday";
						break;
					case "D":
						$flagbody .= " Dropped out";
						break;
				}

				
				$flagsql = "INSERT INTO flags (flaggableid, title, body, notified, flagtype, flagtime, source, flagabout) 
										VALUES ('0','Class attendance registration ".$datevalue."','$flagbody'
										,'".$sca->studentid."','5','',".intval('').",LAST_INSERT_ID())";
				//$this->registry->getObject('db')->executeQuery($flagsql);
				try{
					DB::insert($flagsql);
				} catch(\Illuminate\Database\QueryException $ex){ 
					//dd($ex->getMessage()); 
					$v = $ex->getMessage();
					// Note any method of class PDOException can be called on $ex.
				}
				
				
			}
			
			if($ctr>0){
				//$sql .= $values;
				//$this->registry->getObject('db')->executeQuery($sql);
				//$this->registry->getObject('db')->executeQuery($sql);
			}
			
		
		}

		//$this->checkLongTermAbsentees();

		

		
		return $v;
    }
	

}
