<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dt_lessons = array();

        $base_url = config('app.base_url');
        $url = $base_url . 'API/get_lesson.php';

        $request = file_get_contents($url);
        $response = json_decode( $request);
        if ( $response->status == 200 ){
            foreach ( $response->result AS $isi ) {
                array_push( $dt_lessons, $isi );
            }
        }

        return view('nilai/nilai', compact('dt_lessons'));
    }



    public function download_excel()
    {

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
                
        // Header Lesson
        $activeWorksheet->mergeCells('A1:B1');
        $activeWorksheet->setCellValue('A1', "Jenis Lesson : ");
        $activeWorksheet->setCellValue('C1', '');

        // Header Tabel 
        $activeWorksheet->setCellValue('A3', "No.")->getColumnDimension('A')->setWidth(4);
        $activeWorksheet->setCellValue('B3', "Nama Mahasiswa")->getColumnDimension('B')->setWidth(31);
        $activeWorksheet->setCellValue('C3', "Nilai Pre Test")->getColumnDimension('B')->setWidth(13);
        $activeWorksheet->setCellValue('D3', "Nilai Post Test")->getColumnDimension('B')->setWidth(13);
        $activeWorksheet->setCellValue('E3', "Nilai Delay Test")->getColumnDimension('B')->setWidth(13);
        // Body
        

        // end ---

        $writer = new Xlsx($spreadsheet);
        // redirect output to client browser
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="nilai.xls"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
