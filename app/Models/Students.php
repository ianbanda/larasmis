<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Students extends Model
{
    use HasFactory;
     public function getStudentSubjects($stdid)
     {
        $sql = "SELECT 
        ss.*, sub.* FROM std_subjects ss, subjects sub WHERE sub.ID=ss.subjectid AND studentid='$stdid'";
        return DB::select($sql);
     }
     public function getStudentAssignments($stdid)
     {
        $sql = "
            SELECT *
            , (SELECT (SELECT name FROM subjects WHERE ID=subjectid LIMIT 1) FROM papers WHERE ID=ca.paperid LIMIT 1) AS subject
            , (SELECT (SELECT abbr FROM subjects WHERE ID=subjectid LIMIT 1) FROM papers WHERE ID=ca.paperid LIMIT 1) AS abbr
            , (SELECT subjectid FROM papers WHERE ID=ca.paperid LIMIT 1) AS subjectid
            , (SELECT name FROM papers WHERE ID=ca.paperid LIMIT 1) AS name
            ,(SELECT scores.scoreValue FROM scores WHERE scores.paperid=ca.paperid AND scores.studentid=143 LIMIT 1) AS score
            FROM class_assignments ca WHERE ca.classid=1 AND 
            (SELECT COUNT(*) FROM std_subjects ss WHERE ss.studentid='143' AND ss.subjectid=(SELECT subjectid FROM papers WHERE ID=ca.paperid LIMIT 1))>0;
        ";
        return DB::select($sql);
     }
     public function getStudentAttendance($stdid)
     {
        $sql = "SELECT *, (CONCAT(DAYNAME(attdate),', ',DAY(attdate),' ',MONTHNAME(attdate),' ',YEAR(attdate))) AS simpleday FROM studentattendance WHERE studentid='$stdid'";
        return DB::select($sql);
     }
     public function getStudentExams($stdid)
     {
        $sql = "
            SELECT *
            , (SELECT (SELECT name FROM subjects WHERE ID=subjectid LIMIT 1) FROM papers WHERE ID=ca.paperid LIMIT 1) AS subject
            , (SELECT (SELECT abbr FROM subjects WHERE ID=subjectid LIMIT 1) FROM papers WHERE ID=ca.paperid LIMIT 1) AS abbr
            , (SELECT subjectid FROM papers WHERE ID=ca.paperid LIMIT 1) AS subjectid
            , (SELECT name FROM papers WHERE ID=ca.paperid LIMIT 1) AS name
            ,(SELECT scores.scoreValue FROM scores WHERE scores.paperid=ca.paperid AND scores.studentid=143 LIMIT 1) AS score
            FROM class_exam_papers ca WHERE ca.classid=1 AND 
            (SELECT COUNT(*) FROM std_subjects ss WHERE ss.studentid='143' AND ss.subjectid=(SELECT subjectid FROM papers WHERE ID=ca.paperid LIMIT 1))>0;
        ";
        return DB::select($sql);
     }
}
