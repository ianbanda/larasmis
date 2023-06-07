<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Flags extends Model
{
    use HasFactory;

	public function getFlags($myid = 0)
	{
		if($myid<=0)
		{
			//$myid = $this->registry->getObject('authenticate')->getUser()->getUserId();
            $myid = 1;
		}
		$filter = " WHERE notified = '".$myid."' AND sent = '0' ";
		$picsql = "
					,IF(flagtype = 'secret','masked.png',(SELECT name FROM pics WHERE belongsto=source AND picfor=IF(flagtype='follow','profile','event') LIMIT 1))
		AS notipic";
		
		$linksql = ",(
			IF(flagtype = '3',CONCAT('{bits}event/',flagabout),'3')
		) AS flaglink";
		
		$sql = "SELECT *,IF(isread=1,'w3-white','w3-pale-red w3-border') AS bgclass".$linksql." FROM flags ".$filter;
		//$sql = "SELECT * FROM flags";
		//return json_encode(DB::select( $sql ));
		$cache = DB::select( $sql );
		return $cache;
	}
	
	public function getMySubscriptions($myid = 0)
	{
		$uid = $_SESSION['auth_session_uid'];
		$sql = "SELECT *,IF((SELECT COUNT(*) FROM flagsubs WHERE userid='$uid' AND flagtype=fts.id)>0,'checked','') AS checked FROM flaggable_types fts";
		$cache = $this->registry->getObject('db')->cacheQuery( $sql );
		return $cache;
	}
	
	public function getFlagSQL($sql)
	{
		$flag = null;

        $rows = array();
	    $rows =	DB::query($sql);
		if (count($rows[0]) == 1) {
			$rows = $this->registry->getObject('db')->getRows();
			$data = $rows[0];
			
            $flag = new FlagModel($this->registry,$data['ID'],false);
			$flag->setId($data['ID']);
			$flag->setTitle($data['title']);
			$flag->setText($data['body']);
			$flag->settype($data['flagtype']);
			$flag->setAbout($data['flagabout']);
			
		}

		return $flag;
	}
	
	public function saveFlag($source,$dest,$body,$type,$about)
	{
		//echo $source;
		$t=time();
		$t . "<br>";
		$datetime = date("Y-m-d h:i:s",$t);
		$date = date("Y-m-d",$t);
		
		//$conn = registry->getObject('db')->$connections[0];
		//$body = $this->registry->getObject('db')->escapeString($body);
		
		$alreadyflagged = false;
		
		if($type=='profile'){
			$testsql = "SELECT ID FROM flags WHERE body='$body' AND DATE(flagtime)='$date'";
			DB::query( $testsql );
			//echo("<br/>".$this->registry->getObject('db')->numRows());
			if($this->registry->getObject('db')->numRows()>=1)
			{
				$alreadyflagged = true;
			}
			else{
			}
		}
		else{
			//echo "<br/>";
			//echo $testsql = "SELECT ID FROM flags WHERE body='$body'";
			$testsql = "SELECT ID FROM flags WHERE body='$body'";
			//$testsql = "SELECT ID FROM flags WHERE notified='$dest' AND DATE(flagtime)='$date'";
			DB::query( $testsql );
			//echo("<br/>".$this->registry->getObject('db')->numRows());
			if($this->registry->getObject('db')->numRows()>=1)
			{
				$alreadyflagged = true;
			}
			else{
				$alreadyflagged = false;
			}
		}
		
		
		if($alreadyflagged==false&&$source!=$dest){
			$sql = " INSERT INTO flags (notified,body,flagtype,flagtime,source,flagabout) VALUES ('$dest','$body','$type','$datetime','$source','$about') ";
			$this->registry->getObject('db')->cacheQuery( $sql );
		}
	}
	
	public function generateEventFlag($creator)
	{
		$eventid = $_SESSION['lastevent'];
		
		$sql = "SELECT ID FROM users WHERE ID != '".$creator."'";
		$cache = DB::query( $sql );
		//print_r($this->registry->getObject('db')->getRows());
		$message = "<a href=\'profile/".$creator."\'>".$this->registry->getObject('authenticate')->getUser()->getFullname()."</a> Created an event: ";
		while($row = $this->registry->getObject('db')->getRows())
		{
			$this->saveFlag($creator,"dest",$row['ID'],$message,"event");
		}
	}
	
	public function updateFlag($flag,$isread='0',$seen='0',$responded='0',$ownernotified='0')
	{
		
		$sql = "UPDATE flags SET isread='$isread', seen='$seen', responded='$responded', sent='$ownernotified' WHERE ID='$flag'";
		$cache = DB::update( $sql );
		
	}
	
	
	public function checkFlaggables()
	{
		$sql = "";
		$cache = DB::query( $sql );
		
		$sql = "INSERT INTO flaggables (id, item, itstype, timecreated, creator) SELECT ";
		$cache = $this->registry->getObject('db')->cacheQuery( $sql );
		return $cache;
	}
	
	public function getLatestFlags($uid = 0)
	{
		$loggedinid = $this->registry->getObject('authenticate')->getUser()->getUserId();
		if($loggedinid != null || $loggedinid !=0)
		{
			$uid = $loggedinid;
		}
		
		$filter = " WHERE notified = '".$uid."'";
		$picsql = "
						,IF(flagtype = 'secret','masked.png',(SELECT name FROM pics WHERE belongsto=source AND picfor=IF(flagtype='follow','profile','event') LIMIT 1))
					AS notipic";
		
		$sql = "SELECT * 3
		";
		$cache = $this->registry->getObject('db')->cacheQuery( $sql );
		return $cache;
	}
	

}
