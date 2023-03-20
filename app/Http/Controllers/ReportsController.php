<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    //
    private $fpdf;
    public function index()
    {
        //return view('reports.index');
        return 'hello world';
    }

    public function ajax(Request $request)
    {
        $action = strtolower($request['action']);
        switch ($action) {
            case 'generateclassfilereport':
                $this->fpdf = new Fpdf;
                $this->fpdf->AddPage("L", ['100', '100']);
                $this->fpdf->Text(10, 10, "Hello FPDF");       
                
                $this->fpdf->Output();
                //$pc = new PdfController();
                //$pc->ajax();
                break;
        }
    }
}
