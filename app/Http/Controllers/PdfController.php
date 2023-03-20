<?php

namespace App\Http\Controllers;

use App\Models\EOTReport;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;


class PdfController extends Controller
{
    //
    protected $fpdf;
 

    public function ajax() 
    {
        /*$pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        $pdf->loadHTML('<h1>Test</h1><h2 style="color:red">Test H2</h2>');
        return $pdf->stream();*/

        $report = new EOTReport(143,1,1);

        $rows = $report->getRows();
        $data = [
                    'title' => $report->getStudentName()
                    ,'stdname'=>$report->getStudentName()
                    ,'classname'=>$report->getClassName()
                    ,'nexttermopens'=>$report->getNextTerm()
                    ,'term'=>$report->getTerm()
                    ,'accyear'=>$report->getYear()
                    ,'comment'=>$report->getComment()
                    ,'rows'=>$rows
                ];

        //$pdf = PDF::loadView('pdfs.myPDF', $data);
        $pdf = PDF::loadView('pdf.eot', $data);

  

        return $pdf->download(preg_replace('/\s+/', '',$report->getStudentName()).':EOT Report.pdf');
        
    }
}
