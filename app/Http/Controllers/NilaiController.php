<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

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




        $data = Lesson::all();// Ambil data dari sumber data yang sesuai, misalnya database
        return view('nilai.nilai', compact('dt_lessons','data'));

        
    }

    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'userfile' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('userfile');
 
		try {

            $file_excel = IOFactory::load($file->getRealPath());
            $activeWorksheet = $file_excel->getActiveSheet();
            
            $row_limit = $activeWorksheet->getHighestDataRow();
            $column_limit = $activeWorksheet->getHighestDataColumn();

            $row_range = range(4, $row_limit);
            $column_range = range('A', $column_limit);

            $start = 4;

            $data = array();
            foreach ( $row_range AS $isi ) {

                $nama = $activeWorksheet->getCell('B'.$start);
                $pre_test = $activeWorksheet->getCell('C'.$start);
                $post_test = $activeWorksheet->getCell('D'.$start);
                $delay_test = $activeWorksheet->getCell('E'.$start);

                array_push( $data, [

                    'nama'      => $nama,
                    'pre_test'  => $pre_test,
                    'post_test' => $post_test,
                    'delay_test' => $delay_test
                ]);

                
                $start++;
            }


            DB::table("nilai")->insert( $data );

            return redirect('nilai');

        } catch ( Exception $e ) {
            

        }
    }

    public function showNilai()
    {
        $data = Lesson::all();// Ambil data dari sumber data yang sesuai, misalnya database
        return view('nilai.nilai', compact('data'));
    }

    public function download_excel( Request $request )
    {

        
        $id_lesson = $request->id_lesson;
        
        // ambil informasi lesson 
        $base_url = config('app.base_url');
        $url = $base_url . 'API/get_lesson.php?id_lesson='. $id_lesson;

        $dt_lesson = array();
        $dt_mahasiswa = array();
        $request = file_get_contents($url);
        $response = json_decode( $request );
        if ( $response->status == 200 ) {

            foreach ( $response->result AS $isi ) {

                array_push( $dt_lesson, $isi );
            }
        }


        // API mhs
        $url = $base_url . 'API/get_mahasiswa.php';
        $request = file_get_contents($url);
        $response = json_decode( $request );
        if ( $response->status == 200 ) {

            foreach ( $response->result AS $isi ) {

                array_push( $dt_mahasiswa, $isi );
            }
        }



        $nama_lesson = $dt_lesson[0]->nama_lesson;

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
                
        // Header Lesson
        $activeWorksheet->mergeCells('A1:B1');
        $activeWorksheet->setCellValue('A1', "Jenis Lesson : ");
        $activeWorksheet->setCellValue('C1', $id_lesson.' - '. $nama_lesson);

        // Header Tabel 
        $activeWorksheet->setCellValue('A3', "No.")->getColumnDimension('A')->setWidth(4);
        $activeWorksheet->setCellValue('B3', "Nama Mahasiswa")->getColumnDimension('B')->setWidth(31);
        $activeWorksheet->setCellValue('C3', "Nilai Pre Test")->getColumnDimension('B')->setWidth(13);
        $activeWorksheet->setCellValue('D3', "Nilai Post Test")->getColumnDimension('B')->setWidth(13);
        $activeWorksheet->setCellValue('E3', "Nilai Delay Test")->getColumnDimension('B')->setWidth(13);


        
        $activeWorksheet->getColumnDimension('B')->setWidth(30);

        // Body

        $mulai = 4;
        $urutan = 1;
        foreach ( $dt_mahasiswa AS $isi ) {

            $activeWorksheet->setCellValue('A'. $mulai, $urutan);
            $activeWorksheet->setCellValue('B'. $mulai, $isi->nama);

            $mulai++;
            $urutan++;
        }
        

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
