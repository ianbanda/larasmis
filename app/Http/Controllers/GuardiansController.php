<?php

namespace App\Http\Controllers;

use App\Models\Guardians;
use Illuminate\Http\Request;

class GuardiansController extends Controller
{
    //
    public function getStudentGuardians(Request $request)
    {
        $guardiansModel = new Guardians();
        $guardians = $guardiansModel->getStudentGuardians($request['stdid']);
    }
}
