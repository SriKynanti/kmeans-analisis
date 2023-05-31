<?php

namespace App\Http\Controllers;

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
        
        $base_url = config('app.base_url');
        $url = $base_url . 'API/get_class.php';

        $request = file_get_contents($url);
        $response = json_decode( $request );
        if ( $response->status == 200 ) {

            foreach ( $response->result AS $isi ) {

                array_push( $dt_kelas, $isi );
            }
        }


        // apabila sudah melakukan filter
        if ( $res->filled('v') ){

            $base_url = config('app.base_url');
            $url = $base_url . 'API/get_mahasiswa.php';

            $request = file_get_contents($url);
            $response = json_decode( $request );

            
            if ( $response->status == 200 ) {
                foreach ( $response->result AS $isi ) {

                    foreach ( $res->kelas AS $filt_kelas )  {

                        if ( $filt_kelas == $isi->level ) {

                            array_push( $dt_mahasiswa, $isi );
                        }
                    }
                }
            }
        }


        // print_r( $dt_mahasiswa );


        // echo 
        return view('klasterisasi/perhitungan', compact('dt_kelas', 'res', 'dt_mahasiswa'));
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
