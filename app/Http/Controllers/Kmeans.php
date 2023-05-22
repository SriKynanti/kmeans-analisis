<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class Kmeans extends Controller
{


    function index() {

        // menyiapkan variabel 
        $dt_variabel = array(
            'time', 'salah_gnd', 'salah_wr', 'jumlah_gnd_wr', 'nilai'
        );


        // inputan user
        $dt_variabel_pilihan = ['time', 'salah_wr', 'salah_gnd', 'nilai'];
        $memilih_kelas = ['2I', '2G'];
        $dt_ids = [2, 7, 17];


        $datasets = $this->dataset();


        // filter mahasiswa berdasarkan kelas 
        $dataset_filtered = array();
        $dt_centroid = array();
        foreach ( $datasets AS $isi ) {


            // ambil centroid 
            foreach ( $dt_ids AS $id ) {

                if ( $id == $isi['id'] ) {

                    array_push( $dt_centroid, $isi );
                    break;
                }
            }

            // filter kelas
            foreach ( $memilih_kelas AS $filter_kelas ) {

                if ( $filter_kelas == $isi['kelas'] ) {

                    array_push( $dataset_filtered, $isi );
                    break;
                }
            }


            // iterasi 1 : 
            // reno | 2I
            // $isi['nama'] = reno 
            // $isi['kelas'] = 2I 
            //     // iterasi 1.1. 
            //     filter_kelas = 2I 
            //     apakah filter_kelas == $isi['kelas']
            //     apakah 2I == 2I ? 
            //     array_push : masuk filtering .. 

            //     // iterasi 1.2 x

            // // iterasi 2 : 
            // versa : 2I 
            //     // iterasi 2.1 
            //     filter_kelas = 2I 
            //     filter_kelas == $isi['kelas'] ? 
            //     iya break 



        }





        // proses perhitungan 
        $hasil_cluster = [];
        $hasil_jarak = [];
        $data_centroid_baru = [];
        foreach ( $dataset_filtered AS $index_ds => $isi_ds ) {

            // jarak antara value per mhs dengan centroid
            $dt_hasil_jarak = array();
            // echo $isi_ds['nama'].'<br>';

            foreach ( $dt_centroid AS $index => $c ) {
                
                $total = 0;
                // seleksi variabel yang dihitung
                foreach ( $dt_variabel_pilihan AS $pilihan ){

                    // echo "Nama variabel $pilihan dari nilai $isi_ds[$pilihan] dan $c[$pilihan]<br>";
                    $x = (int) $isi_ds[$pilihan];
                    $y = (int) $c[$pilihan];
                    $total += pow($x - $y, 2);
                }


                $akar = sqrt($total);
                // echo "Hasil jarak ".sqrt($total)." <br>";

                $dt_hasil_jarak[$index] = sqrt( $total );
            }   

            $minimum = min( $dt_hasil_jarak );
            // print_r( $dt_hasil_jarak );
            // echo "<br>";
            // echo $minimum;

            $kluster = array_search($minimum, $dt_hasil_jarak);

            array_push( $hasil_jarak, $dt_hasil_jarak );
            array_push( $hasil_cluster, $kluster );

            // echo "<br>";
            // echo "centroid terletak pada $index";
            // echo "<hr>";

            // penentuan cluster baru 
            if ( array_key_exists( $kluster, $data_centroid_baru ) ) {
                // echo "untuk looping ke $index_ds ke $kluster ditemukan<br>";
                foreach ( $dt_variabel_pilihan AS $pilihan ) {

                    $data_centroid_baru[$kluster][$pilihan] += $isi_ds[$pilihan];
                    // echo "&emsp; untuk $kluster dan $pilihan = ". $data_centroid_baru[$kluster][$pilihan] . " + ". $isi_ds[$kluster][$pilihan].'<br>';
                }
                $data_centroid_baru[$kluster]["count"]++;

            } else {
    
                $data_centroid_baru[$kluster] = $isi_ds;
                $data_centroid_baru[$kluster]["count"] = 1;
                // echo "untuk looping ke $index_ds ke $kluster tidak ditemukan<br>";
                // echo "&emsp; berarti time bernilai". $data_centroid_baru[$kluster]['time']." wr ". $data_centroid_baru[$kluster]['salah_wr'];
            }

            // echo "<br>";
            
            // print_r( $dt_centroid[$kluster] );
            // $data_centroid_baru[$kluster] = $dt_centroid[$kluster];
            // echo "<br>";
        }


        // jumlahkan keseluruhan centroid baru
        $dt_centroid_terkini = [];
        foreach ( $data_centroid_baru AS $index => $isi ) {

            // print_r( $isi );
            echo "<h2>Hasil index ke - $index</h2>";
            foreach ( $dt_variabel_pilihan AS $pilihan ) {

                $hasil = 0;

                try {

                    $hasil = $data_centroid_baru[$index][$pilihan] / $isi['count'];

                } catch ( Exception $e ) {

                    // zero divide 
                }

                // echo "<h2>Untuk index ke-$index : $hasil</h2>";
                echo $hasil.'<br>';
                // $dt_centroid_terkini[$index][$pilihan] = $hasil;
            }
        }

        // echo json_encode($dt_centroid_terkini);



        



        // foreach ( $data_centroid_baru AS $isi ) {

        //     print_r( $isi );
        //     echo "<hr>";
        // }


        // echo json_encode( $dataset_filtered );
    }



    // dataset 
    function dataset() {

        $dt_dataset = array(

            [
                'nama'  => "rheno",
                'kelas' => "2I",
                'time'  => "39",
                'salah_wr'   => "2",
                'salah_gnd'   => "1",
                'nilai'       => "90"
            ],
            [
                'nama'  => "versacitta",
                'kelas' => "2G",
                'time'  => "43",
                'salah_wr'   => "10",
                'salah_gnd'   => "14",
                'nilai'       => "70"
            ],
            [
                'nama'  => "keith",
                'kelas' => "2I",
                'time'  => "16",
                'salah_wr'   => "0",
                'salah_gnd'   => "0",
                'nilai'       => "50"
            ],
            [
                'nama'  => "abi",
                'kelas' => "2I",
                'time'  => "2",
                'salah_wr'   => "0",
                'salah_gnd'   => "0",
                'nilai'       => "50"
            ],
            [
                'nama'  => "raynor",
                'kelas' => "2I",
                'time'  => "37",
                'salah_wr'   => "2",
                'salah_gnd'   => "1",
                'nilai'       => "50"
            ],
            [
                'nama'  => "mayfana",
                'kelas' => "2I",
                'time'  => "21",
                'salah_wr'   => "2",
                'salah_gnd'   => "4",
                'nilai'       => "80"
            ],
            [
                'nama'  => "septian",
                'kelas' => "2I",
                'time'  => "17",
                'salah_wr'   => "1",
                'salah_gnd'   => "0",
                'nilai'       => "80"
            ],
            [
                'nama'  => "adinda",
                'kelas' => "2I",
                'time'  => "44",
                'salah_wr'   => "0",
                'salah_gnd'   => "0",
                'nilai'       => "60"
            ],
            [
                'nama'  => "raihan",
                'kelas' => "2I",
                'time'  => "39",
                'salah_wr'   => "1",
                'salah_gnd'   => "3",
                'nilai'       => "70"
            ],
            [
                'nama'  => "vinsensius",
                'kelas' => "2I",
                'time'  => "45",
                'salah_wr'   => "5",
                'salah_gnd'   => "4",
                'nilai'       => "30"
            ],
            [
                'nama'  => "rheno",
                'kelas' => "2I",
                'time'  => "39",
                'salah_wr'   => "2",
                'salah_gnd'   => "1",
                'nilai'       => "70"
            ],
            [
                'nama'  => "thoriq",
                'kelas' => "2I",
                'time'  => "21",
                'salah_wr'   => "2",
                'salah_gnd'   => "3",
                'nilai'       => "80"
            ],
            [
                'nama'  => "saefulloh",
                'kelas' => "2I",
                'time'  => "29",
                'salah_wr'   => "12",
                'salah_gnd'   => "7",
                'nilai'       => "50"
            ],
            [
                'nama'  => "mumtaz",
                'kelas' => "2I",
                'time'  => "28",
                'salah_wr'   => "8",
                'salah_gnd'   => "9",
                'nilai'       => "0"
            ],
            [
                'nama'  => "khafillah",
                'kelas' => "2I",
                'time'  => "44",
                'salah_wr'   => "0",
                'salah_gnd'   => "0",
                'nilai'       => "90"
            ],
            [
                'nama'  => "ghaitza",
                'kelas' => "2I",
                'time'  => "18",
                'salah_wr'   => "14",
                'salah_gnd'   => "11",
                'nilai'       => "40"
            ],
            [
                'nama'  => "satria",
                'kelas' => "2I",
                'time'  => "24",
                'salah_wr'   => "8",
                'salah_gnd'   => "7",
                'nilai'       => "50"
            ],
            [
                'nama'  => "faricha",
                'kelas' => "2I",
                'time'  => "25",
                'salah_wr'   => "1",
                'salah_gnd'   => "1",
                'nilai'       => "50"
            ],
            [
                'nama'  => "faizal",
                'kelas' => "2I",
                'time'  => "26",
                'salah_wr'   => "14",
                'salah_gnd'   => "16",
                'nilai'       => "60"
            ],
        );

        $perbarui_dataset_id = array();
        foreach ( $dt_dataset AS $index => $isi) {

            $isi['id'] = $index + 1;
            $isi['jumlah_gnd_wr'] = $isi['salah_wr'] + $isi['salah_gnd'];
            array_push( $perbarui_dataset_id, $isi );
        }

        return $perbarui_dataset_id;
    }





    //
    function index_b() {

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
