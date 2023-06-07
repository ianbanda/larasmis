<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Paper extends Model
{
    use HasFactory;

    public function getScores($id=0,$classid=0){
        $sql = "SELECT * FROM scores WHERE paperid='$id'";
        $sql = "SELECT *
            ,(SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=studentid LIMIT 1) AS username
            ,(SELECT IFNULL(scoreValue,'0') FROM scores WHERE scores.studentid=sic.studentid AND paperid='$id' LIMIT 1) AS scorevalue
            ,IFNULL((SELECT scoreid FROM scores WHERE scores.studentid=sic.studentid AND paperid='$id' LIMIT 1),0) AS scoreid
            FROM studentsinclass sic WHERE classid='$classid'";

        $cache = DB::select($sql);
        return $cache; 
    }

    public function saveScore($studentid,$paperid,$scoreid,$scorevalue)
    {
        if(intval($scoreid)>0)
        {
            DB::delete('delete scores where scoreid = ?', $scoreid);
        }

        $sql = "INSERT INTO scores (paperid,studentid,scoreValue) VALUES ('$paperid', '$studentid', '$scorevalue')";
        //DB::query($sql);
        DB::insert($sql);

        echo $sql;
    }
}
