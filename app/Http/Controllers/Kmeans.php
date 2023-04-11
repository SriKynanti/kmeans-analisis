<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Kmeans extends Controller
{
    //
    function index() {

        /**
         *  1. Menyiapkan dataset
         *  2. Centroid Random
         *  3. Menentukan jarak
         */


        // @TODO 1 : Persiapan dataset
        $dataset = $this->createOwnDataset();

        // @TODO 2 : centroid 
        $jumlahCentroid = 5;
        // dinamis
        // $centroid = $this->centroidRandom($jumlahCentroid, $dataset);

        // statis
        $centroid = $this->centroidSimulasi();

        // @TODO 3 : jarak centroid dengan dataset
        $jarak = $this->jarakCentroid( $centroid, $dataset );
        
        // @TODO 4 : Pembuatan centroid baru
        $centroidbaru = $this->pembuatanCentroidBaru( $jarak, $dataset );

        // echo json_encode( $centroid );
    }



    function createOwnDataset() {

        $nilai = [

            [10, 88, 90],
            [9, 50, 75],
            [20, 60, 80],
            [13, 70, 90],
            [9, 92, 100], 
            [20, 50, 60],
            [12,75,80],
            [10,85 ,100],
            [15,50 ,75],
            [15, 65,85],
            [9, 90,100],
            [13, 75,85],
            [15, 90,100],
            [14, 70,85],
            [9, 80, 100],
            [6, 80,100],
            [8,50 ,85],
            [9, 75, 90],
            [12, 90,95],
            [7, 75,90],
            [5, 60, 80],
            [10, 65,90],
            [14,90 ,100],
            [10, 55, 75],
            [9, 90, 80],
            [7, 65, 75],
            [10, 68 , 70],
            [13, 60 , 80],
            [12, 85, 80],
            [15, 75 , 80],
        ];

        $dt_baru = array();
        foreach ( $nilai AS $urutan => $isi ) {

            array_push( $dt_baru, array(

                "id"    => $urutan + 1, 
                "waktu" => $isi[0],
                "pretest" => $isi[1],
                "postest" => $isi[2],
            ) );
        }
        return $dt_baru;
    }


    function centroidSimulasi(){

        $nilai = [

            [20, 60, 80],
            [9, 80, 100],
            [14, 90, 100],
        ];

        $dt_baru = array();
        foreach ( $nilai AS $urutan => $isi ) {

            array_push( $dt_baru, array(
                "waktu" => $isi[0],
                "pretest" => $isi[1],
                "postest" => $isi[2],
            ) );
        }
        return $dt_baru;
    }



    // 2 : centroid random 
    function centroidRandom( $amount, $dataset ){

        $dt_centroid = array();
        for ( $i = 0; $i < $amount; $i++ ) {
            
            $random = rand(1, (count( $dataset ) - 1));
            array_push( $dt_centroid, $dataset[$random] );
        }


        return $dt_centroid;
    }


    // 3 : jarak centroid + penentuan kelas
    function jarakCentroid( $centroid, $dataset ) {

        $dt_baru = array();
        foreach ( $dataset AS $urutan => $isi ) {

            // echo "<h1>Siswa ke ".$isi['id']."</h1>";
            
            $ds_waktu = $isi['waktu'];
            $ds_pretest = $isi['pretest'];
            $ds_postest = $isi['postest'];


            // buka centroid : hitung jarak
            $ED_keseluruhan = [];
            foreach ( $centroid AS $urutan_c => $isi_centroid ) {

                $c_waktu   = $isi_centroid['waktu'];
                $c_pretest = $isi_centroid['pretest'];
                $c_postest = $isi_centroid['postest'];

                $d = sqrt( pow( ($ds_waktu - $c_waktu), 2) + pow( ($ds_pretest - $c_pretest), 2 ) + pow( ($ds_postest - $c_postest), 2 ) );

                // $d = number_format( $d, 2 );
                // echo "<b>Nilai dari d$urutan_c adalah : $d</b><br>";

                array_push( $ED_keseluruhan, $d );
            }


            // keputusan nilai minimum
            $min = min( $ED_keseluruhan );
            // [31, 12, 10] = 10
            // min = 10

            $kelas = array_search($min, $ED_keseluruhan);
            // kelas = array_search ( 10, [31, 12, 10]);

            // $kelas += 1;
            // echo "<h4>D$kelas</h4>";

            $isi["ed"]      = $ED_keseluruhan;
            $isi["kelas"]   = $kelas;
            array_push( $dt_baru, $isi);
        }


        return $dt_baru;
    }



    // 4 : pembuatan centroid baru 
    function pembuatanCentroidBaru( $jarak, $dataset ) {

        $dt_baru = array();
        $dt_totalCentroid = array();

        foreach ( $dataset AS $index => $isi ) {

            // cek posisi kelas 
            echo "<h1>Siswa ".$isi["id"]."</h1>";
            $kelas = $jarak[$index]["kelas"];
            
            if ( count( $dt_totalCentroid ) > 0 ) {

                // cek poin sampai pengisian index . . .
                // $dt_totalCentroid[$kelas][0] = 
            }
            
            // echo "Posisi ". $kelas;
        }

        // foreach ( $jarak AS $isi ) {

        //     $kelas = $isi['kelas'];
        //     $dt_totalCentroid[$kelas] = 
        // }
    }
}
