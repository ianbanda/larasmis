<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FlagEngine extends Model
{
    use HasFactory;

    public static function initFlags($myid,$utype) {

        $flaggables = new Flaggables();
        $flaggables->initFlaggables($myid,$utype);
		
        //echo "utype is ".$utype;

        //Checks the type of the users requesting flags
        switch($utype."")
        {
            case "2":
                
                $teacher = new Teacher($myid,0,false);
                $lp =  $teacher->nextLessonPeriod();
                if($lp != null){
                    $mins = $lp->getTimeBeforeStart();

                    $flags = new Flags();

                    $title = "You have a lesson starting in $mins minutes";
                    if($mins=="5" || $mins=='10' || $mins == '20' || $mins=="30" || $mins=="60")
                    {
                            
                            $flag = $flags->getFlagSQL("SELECT * FROM flags WHERE title='$title' LIMIT 1");
                            if($flag!=null && $flag->getTitle()==$title)
                            {
                                
                            }else{
                                /*$flag = new FlagModel(0,false);
                                $flag->setId(0);
                                $flag->setTitle($title);
                                $flag->setText('11C, ICT ');
                                $flag->setType('20');
                                $flag->setFlaggableid('50');
                                $flag->setNotified($myid);
                                $flag->save();*/
                            }
                    }
                }
                break;
        
            default:
                
                break;
        
        }
	}
	
    public static function loadMyFlags($myid,$utype) {
        $flags = new Flags();

        $flaggables = new Flaggables();
        $cache = $flaggables->getFlaggables($myid,$utype);

        //$data = $this->registry->getObject('mysql');
        while ($data = $cache) {
            //$flagbody = "";
            //print_r($data);
            switch ($data['itstype']) {
                case "3":
                    $flagbody = "" . $data['creatorname'] . " created a page:  " . $data['aboutname'] . "";
                    $type = $data['itstype'];
                    $dest = $myid;
                    $flags->saveFlag($data['creator'], $dest, $flagbody, $type, $data['item']);
                    break;
                case "11":
                    $flagbody = "" . $data['creatorname'] . " created an event:  " . $data['aboutname'] . "";
                    $type = $data['itstype'];
                    $dest = $myid;
                    $flags->saveFlag($data['creator'], $dest, $flagbody, $type, $data['item']);
                    break;
            }
        }

        //echo "ID is :".$data['id'];
        //print_r($data);

        /* require_once( FRAMEWORK_PATH . 'Models/flagsubs.php' );
          $fsubs = new Flagsubs($this->registry);

          $uid = $this->registry->getObject('authenticate')->getUser()->getUserId();

          $cacheId = $fsubs->getFlagsubs($uid);

          while ($data = $this->registry->getObject('db')->resultsFromCache( $cacheId ) )
          {
          //print_r($data);
          echo $sql = "SELECT * FROM events WHERE country = '".$data['subto']."'";
          } */
    }

    public static function createFlaggable($item, $type, $creator) {
        $sql = "INSERT INTO flaggables (item,itstype,creator) VALUES ('$item','$type','$creator')";
        DB::query($sql);
    }

    public static function createFlagSub($item, $type, $user) {
        echo $sql = "INSERT INTO flagsubs (subto,subtype,user) VALUES ('$item','$type','$user')";
        DB::query($sql);
    }
}
