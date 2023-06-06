<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class KlusterisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $res )
    {

        $dt_kelas = array();
        $dt_mahasiswa = array();
        $dt_lessons = array();
        
        $base_url = config('app.base_url');
        $url = $base_url . 'API/get_class.php';

        $request = file_get_contents($url);
        $response = json_decode( $request );
        if ( $response->status == 200 ) {

            foreach ( $response->result AS $isi ) {

                array_push( $dt_kelas, $isi );
            }
        }


        // ambil data lesson 
        $url = $base_url . 'API/get_lesson.php';

        $request = file_get_contents($url);
        $response = json_decode( $request );
        if ( $response->status == 200 ) {

            foreach ( $response->result AS $isi ) {

                array_push( $dt_lessons, $isi );
            }
        }


        // apabila sudah melakukan filter
        if ( $res->filled('v') && $res->filled('kelas') ){

            // $base_url = config('app.base_url');
            // $url = $base_url . 'API/get_mahasiswa.php';

            // $request = file_get_contents($url);
            // $response = json_decode( $request );

            
            // if ( $response->status == 200 ) {
            //     foreach ( $response->result AS $isi ) {

            //         foreach ( $res->kelas AS $filt_kelas )  {

            //             if ( $filt_kelas == $isi->level ) {

            //                 array_push( $dt_mahasiswa, $isi );
            //             }
            //         }
            //     }
            // }

            $dataset = $this->dataset($res->id_lesson);
            foreach ( $dataset AS $isi ) {

                foreach ( $res->kelas AS $filt_kelas )  {
                    if ( $filt_kelas == $isi['kelas'] ) {

                        array_push( $dt_mahasiswa, $isi );
                    }
                }
            }
        }


        // print_r( $dt_mahasiswa );


        // echo 
        return view('klasterisasi/perhitungan', compact('dt_kelas', 'res', 'dt_mahasiswa', 'dt_lessons'));
    }







    function dataset( $id_lesson ) {


        // $id_lesson = "11";
        // ambil dataset from log
        $base_url = config('app.base_url');
        $url = $base_url . 'API/get_mahasiswa.php';

        $dt_dataset = array();
        $dt_mahasiswa = array();

        $request = file_get_contents($url);
        $response = json_decode( $request );
        if ( $response->status == 200 ) {

            foreach ( $response->result AS $isi ) {

                array_push( $dt_mahasiswa, $isi );
            }
        }



        // looping data mhs
        if ( count( $dt_mahasiswa ) > 0 ) {

            foreach ( $dt_mahasiswa AS $isi ) {

                if ( $isi->email ) {

                    $base_url = config('app.base_url');
                    $url = $base_url . 'API/get_log.php?email='.$isi->email.'&id_lesson='.$id_lesson;

                    try{

                        $request = file_get_contents($url);
                        $response = json_decode( $request );


                        // ambil informasi waktu
                        $url_diff = $base_url . 'API/get_log_diff.php?email='.$isi->email.'&id_lesson='.$id_lesson;

                        $request_diff = file_get_contents($url_diff);
                        $response_diff = json_decode( $request_diff );

                        
                        // filter
                        if ( $response->status == 200 && count($response->result) > 0 ) {

                            $waktu = 0;
                            if ( $response_diff->status == 200 && count($response_diff->result) > 0  ) {

                                $waktu = $response_diff->result[0]->difference;
                            }


                            // add response dataaset
                            $response->waktu = $waktu;

                            array_push( $dt_dataset, $response );
                        }

                    } catch( Exception $e ) {

                        // echo "error";
                    }
                }

                
            }
        }



        // check 
        $dataset_cleaning = array();
        // echo count($dt_dataset);
        if ( count( $dt_dataset ) > 0 ){

            foreach ( $dt_dataset AS $isi ) {

                // jumlah 
                $w_jawaban_2 = 0;
                $w_jawaban_3 = 0;

                $g_jawaban_2 = 0;
                $g_jawaban_3 = 0;
                
                $name = "";
                $kelas = "";
                $id = "";
                $email = "";
                foreach ( $isi->result AS $mhs ) {

                    $w_jawaban_2 += $mhs->W_Jawaban2;
                    $w_jawaban_3 += $mhs->W_Jawaban3;
                    $g_jawaban_2 += $mhs->G_Jawaban2;
                    $g_jawaban_3 += $mhs->G_Jawaban2;

                    $name = $mhs->nama;
                    $kelas = $mhs->level;
                    $id = $mhs->id_user;
                    $email = $mhs->email;
                }

                // tambah
                $salah_wr  = $w_jawaban_2 + $w_jawaban_3;
                $salah_gnd = $g_jawaban_2 + $g_jawaban_3;
                $jumlah_gnd_wr = $salah_wr + $salah_gnd;
                $nilai = 0;
                $time = $isi->waktu;

                array_push( $dataset_cleaning, [

                    'id'    => $id,
                    'nama'  => $name,
                    'email' => $email,
                    'kelas' => $kelas,
                    'time'  => $time,
                    'salah_wr'   => $salah_wr,
                    'salah_gnd'     => $salah_gnd,
                    'jumlah_gnd_wr' => $jumlah_gnd_wr,
                    'nilai'       => $nilai
                ]);
            }
        }



        return $dataset_cleaning;
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
