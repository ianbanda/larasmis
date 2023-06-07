<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Paper;
use Illuminate\Http\Request;

class PapersController extends Controller
{
    //
    public function getScores(Request $request)
    {
        $model = null;
        if($request['papertype'] == 'homework')
        {
            $model = new Assignment();
        }

        $scores = $model->getScores($request['paperid'],$request['classid']);
        return response()->json( [
            'scores'=>$scores
        ]);
        //return 'abcd';
    }

    
    public function saveScores()
    {
        $model = new Paper();
       $post = $_REQUEST;
       $paperid = $post['paperid'];
       $scores = explode("*", $post["scores"]);
       $scores = json_decode($post["scores"]);

       $str = "";
       $score = array();
       foreach($scores as $s){
           //$score = json_decode($s);
           $score = $s;
           $str .= $score->userid;
           $str = $model->saveScore($score->userid, $paperid, $score->scoreid, $score->value);
       }
       return $str;
       
    }
}
