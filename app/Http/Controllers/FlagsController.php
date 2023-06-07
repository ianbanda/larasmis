<?php

namespace App\Http\Controllers;

use App\Models\FlagEngine;
use App\Models\Flags;
use Illuminate\Http\Request;

class FlagsController extends Controller
{
    //
    public function check(Request $request)
    {
        if(isset($_REQUEST['userid'])&&isset($_REQUEST['utype'])){
            $userid = $_REQUEST['userid'];
			$utype = $_REQUEST['utype'];
        }
        $userid = 1;
		$utype = 1;
					
                    $flags = new Flags();
                    
					/*require_once(FRAMEWORK_PATH . "Models/teacher.php");
                    $teacher = new Teacher($this->registry,$userid);
                    $rows = $teacher->getIncompleteSubjectHws();
                    //$rows = $registry->getObject('db')->dataFromCache($cache);
                    foreach($teacher->getIncompleteSubjectHws() as $subhw)
                    {
                        //$subid = $subhw['subjectid'];
                        $about = $subhw['teacherid'];
                        $subabbr = $subhw['subabbr'];
                        $hwctr = $subhw['assigdiff'];
                        
                        $dest=$userid;
                        $type = 30;
                        
                        $body = $hwctr." ".$subabbr." Homeworks still missing for your students";
                        
                        $source = 0;
                        
                        $flags->saveFlag($source,$dest,$body,$type,$about);
                    }
                    */
                   

                    
					FlagEngine::createFlaggable('10', '30', $userid);
					FlagEngine::initFlags($userid,$utype);
					
                    $this->checkNotifications($userid,$utype);
    }

    private function checkNotifications($uid,$utype) {
         $flags = new Flags();

         $flaglist = $flags->getFlags($uid,$utype);


         //print_r($flaglist);
        $jflags = "";
        for ($i = 0; $i < count($flaglist); $i++) {
            $flag = $flaglist[$i];
            //$jflags .= "{\"id\":\"" . $flag['ID'] . "\",\"name\":\"" . $flag['classname'] . "\"}";
            
            $jflags .= "{\"id\":\"" . $flag->ID . "\",\"flagtitle\":\"" 
                . $flag->title."\""
                .",\"flagtext\":\"" . $flag->body . "\""
                .",\"flagtype\":\"" . $flag->flagtype . "\""
                .",\"flagabout\":\"" . $flag->flagabout . "\""
                .",\"flagsource\":\"" . $flag->source . "\""
                ."}";
            if ($i < count($flaglist) - 1) {
                $jflags .= ",";
            }
			$flags->updateFlag($flag->ID,'0','0','0','1');
        }

        echo "{\"flags\":[" . $jflags . "]}";
    }


}
