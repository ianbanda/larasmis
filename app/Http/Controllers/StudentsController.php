<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ContactsController;
use App\Models\Guardians;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;

class StudentsController extends Controller
{
    //
    private $studentsModel = null;
    public function getContacts(Request $request)
    {
        $contacts = array(
            ["phone" =>"0999914577","name"=>"John","relationship"=>"Father"],
            ["phone" =>"0993958732","name"=>"bae","relationship"=>"Mother"]
        );
        $guardiansModel = new Guardians();
        $contacts = $guardiansModel->getStudentGuardians($request['studentid']);
        return response()->json( [
            'contacts' => $contacts
        ]);
    }

    public function getStudentSubjects(Request $request)
        {
            $subjects = array(
                ["phone" =>"0999914577","name"=>"John","relationship"=>"Father"],
                ["phone" =>"0993958732","name"=>"bae","relationship"=>"Mother"]
            );
            $studentsModel = new Students();
            $subjects = $studentsModel->getStudentSubjects($request['studentid']);
            return response()->json( [
                'subjects' => $subjects
            ]);
        }

    public function saveNewContact(Request $request)
    {
        $contactsController = new ContactsController();
        $contactid = $contactsController->contactExists($request);

        $relationship = $request['relationship'];

        //$contactid > 0 means contact exists
        //$contactid = 0 means contact doesnt exist
        $result = "Contact already exists";
        $userid = 0;
        $studentid = $request['studentid'];

        if(intval($contactid) <= 0)
        {
            $contactid = $contactsController->saveNewContact($request);
            if(intval($contactid) > 0) {
                if($relationship=="owner") {

                }else
                {
                    /*$sql = "INSERT INTO users (username,password) VALUES ('user','123456')";
                    DB::query($sql);
                    $userid = DB::getPdo()->lastInsertId();*/

                    $sql = "INSERT INTO guardians (studentid,contactid) VALUES ('$studentid','$contactid')";
                    DB::insert($sql);
                    $result = $request;
                }
            }
        }

        return $result;

    }

    public function saveStudentGuardian($studentid, $contactid)
    {

    }
}
