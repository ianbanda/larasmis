<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timetables extends Model
{
    use HasFactory;

	public function getTypes($type = "") {
		$w = "";
        $sql = "SELECT * FROM timetabletypes ".$w;

        $cache = DB::select($sql);
        return $cache;
    }
}
