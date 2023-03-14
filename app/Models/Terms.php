<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Terms extends Model
{
    use HasFactory;

    public function getTerms($year = 0) {
		$w = "";
		if(intval($year)>0)
		{
			$y = "'".$year."'";
		}
		else
		{
			$year = "(SELECT svalue FROM settings WHERE skey='thisyear' LIMIT 1)";
		}

		$w = " WHERE year = ".$year."";
		
        $sql = "SELECT *
			, (SELECT name FROM academic_years WHERE id=t.year LIMIT 1) AS yearname FROM terms t ".$w;

        $cache = DB::select($sql);
        return $cache;
    }
	
	public function getTermReportSettings($term="") {
		$w = " WHERE ID=(SELECT svalue FROM settings WHERE skey='thisterm' LIMIT 1)";
		
		
        $sql = "SELECT *
			, (SELECT name FROM academic_years WHERE id=t.year LIMIT 1) AS yearname FROM terms t ".$w;

        $cache = DB::select($sql);
        return $cache;
    }

}
