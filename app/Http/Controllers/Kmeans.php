<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Kmeans extends Controller
{

    function hitung_manual( Request $request ) {

        $dt_variabel_pilihan = array();

        $ids = [];
        $kelas = [];
        $variabel = [];

        // memastikan sudah memilih mhs
        if ( $request->filled('email') && count($request->email) > 0 )  {

            foreach ( $request->email AS $isi ) {

               
                $url = config('app.base_url') . 'API/get_mahasiswa.php?email='.$isi;
                $permintaan = file_get_contents($url);

                $decoding = json_decode( $permintaan );

                if ( $decoding->status == 200 ) {

                    $user = $decoding->result[0];
                    array_push( $ids, $user->id_user );
                }
            }
        }

        // ambil kelas 
        if ( $request->filled('kelas') ) {

            $kelas = explode(',', $request->kelas);
        }

        // ambil variabel 
        if ( $request->filled('v') ) {

            $variabel = explode(',', $request->v);
        }


        // change pre, post, or delay to nilai (general)
        $jenisNilai = "";
        foreach ( $variabel AS $index => $variab ) {

            if ( $variab == "pre" || $variab == "post" || $variab == "delay" ) {
                $jenisNilai = $variab;
                $variabel[$index] = "nilai";
                break;
            }
        }


        if ( count( $ids ) > 0 && count($kelas) > 0 && count($variabel) > 0 ) {

            $this->hitung( $variabel, $ids, $kelas, $request->id_lesson, $jenisNilai, "intuisi" );
            return redirect('hasil-kmeans');
            
        } else {

            echo "tidak dapat memproses, harap periksa form parameter anda";
        }

        
    }



    function hitung_random( Request $request ) {

        $dt_variabel_pilihan = array();
        $ids = [];

        $kelas = [];
        $variabel = [];

        // memastikan sudah memilih mhs
        if ( $request->filled('email') )  {

            $emails = explode(',', $request->email);

            foreach ( $emails AS $isi ) {

               
                $url = config('app.base_url') . 'API/get_mahasiswa.php?email='.$isi;
                $permintaan = file_get_contents($url);

                $decoding = json_decode( $permintaan );

                if ( $decoding->status == 200 ) {

                    $user = $decoding->result[0];
                    array_push( $ids, $user->id_user );
                }
            }
        }

        // ambil kelas 
        if ( $request->filled('kelas') ) {

            $kelas = explode(',', $request->kelas);
        }

        // ambil variabel 
        if ( $request->filled('v') ) {

            $variabel = explode(',', $request->v);
        }

        // change pre, post, or delay to nilai (general)
        $jenisNilai = "";
        foreach ( $variabel AS $index => $variab ) {

            if ( $variab == "pre" || $variab == "post" || $variab == "delay" ) {
                $jenisNilai = $variab;
                $variabel[$index] = "nilai";
                break;
            }
        }


        if ( count( $ids ) > 0 && count($kelas) > 0 && count($variabel) > 0 ) {

            $this->hitung( $variabel, $ids, $kelas, $request->id_lesson, $jenisNilai );
            return redirect('hasil-kmeans');
            
        } else {

            echo "tidak dapat memproses, harap periksa form parameter anda";
        }

        DB::table("variabel_pilihan")->insert( $variabel );
    }



    function hitung( $dt_variabel_pilihan, $dt_ids, $memilih_kelas, $id_lesson, $jenisNilai ) { 

        // menyiapkan variabel 
        $dt_variabel = array(
            'time', 'salah_gnd', 'salah_wr', 'jumlah_gnd_wr', 'nilai'
        );



        // init awal
        $datasets = $this->dataset($id_lesson, $jenisNilai);
        $iterasi = 0;
        $arr_hasil_iterasi_keseluruhan = array();

        

        // filter mahasiswa berdasarkan kelas 
        $dataset_filtered = array();
        $dt_centroid = array();
        foreach ( $datasets AS $isi ) {

            // echo "<h4>".$isi['id']."</h4>";
            // ambil centroid 
            foreach ( $dt_ids AS $id ) {

                // echo $id.' '.$isi['id'].'<br>';
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
            // echo "<h2>Hasil index ke - $index</h2>";
            foreach ( $dt_variabel_pilihan AS $pilihan ) {

                $hasil = 0;

                try {

                    $hasil = $data_centroid_baru[$index][$pilihan] / $isi['count'];

                } catch ( Exception $e ) {

                    // zero divide 
                }

                // echo "<h2>Untuk index ke-$index : $hasil</h2>";

                // array_push( $dt_centroid_terkini, $hasil );
                // echo $hasil.'<br>';
                $dt_centroid_terkini[$index][$pilihan] = $hasil;
            }
        }



        // header('Content-Type: application/json');
        ksort($dt_centroid_terkini);
        
        
        // increment 
        $hasil_iterasi = array(

            'data'              => $dataset_filtered,
            'centroid_awal'     => $dt_centroid,
            'jarak'             => $hasil_jarak,
            'hasil_klusterisasi'=> $hasil_cluster,
            'tabel_klusterisasi'=> $data_centroid_baru,
            'centroid_baru'     => $dt_centroid_terkini
        );
        $iterasi++;


        array_push( $arr_hasil_iterasi_keseluruhan, $hasil_iterasi );

        // echo json_encode($hasil_iterasi);
        // echo "<hr>";


        // proses perhitungan

        $jumlah_iterasi = 1;

        do {

            $urutan = 1;
            // ------------- perhitungan iterasi -------------

            // proses perhitungan 
            $iter_hasil_cluster = [];
            $iter_hasil_jarak = [];
            $iter_data_centroid_baru = [];
            foreach ( $hasil_iterasi['data'] AS $index_ds => $isi_ds ) {

                // jarak antara value per mhs dengan centroid
                $iter_dt_hasil_jarak = array();
                // echo $isi_ds['nama'].'<br>';

                foreach ( $hasil_iterasi['centroid_baru'] AS $index => $c ) {
                    
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

                    $iter_dt_hasil_jarak[$index] = sqrt( $total );
                }   

                $minimum = min( $iter_dt_hasil_jarak );
                // print_r( $dt_hasil_jarak );
                // echo "<br>";
                // echo $minimum;

                $kluster = array_search($minimum, $iter_dt_hasil_jarak);

                array_push( $iter_hasil_jarak, $iter_dt_hasil_jarak );
                array_push( $iter_hasil_cluster, $kluster );

                // echo "<br>";
                // echo "centroid terletak pada $index";
                // echo "<hr>";

                // penentuan cluster baru 
                if ( array_key_exists( $kluster, $iter_data_centroid_baru ) ) {
                    // echo "untuk looping ke $index_ds ke $kluster ditemukan<br>";
                    foreach ( $dt_variabel_pilihan AS $pilihan ) {

                        $iter_data_centroid_baru[$kluster][$pilihan] += $isi_ds[$pilihan];
                        // echo "&emsp; untuk $kluster dan $pilihan = ". $data_centroid_baru[$kluster][$pilihan] . " + ". $isi_ds[$kluster][$pilihan].'<br>';
                    }
                    $iter_data_centroid_baru[$kluster]["count"]++;

                } else {
        
                    $iter_data_centroid_baru[$kluster] = $isi_ds;
                    $iter_data_centroid_baru[$kluster]["count"] = 1;
                    // echo "untuk looping ke $index_ds ke $kluster tidak ditemukan<br>";
                    // echo "&emsp; berarti time bernilai". $data_centroid_baru[$kluster]['time']." wr ". $data_centroid_baru[$kluster]['salah_wr'];
                }

                
            }


            // jumlahkan keseluruhan centroid baru
            $iter_dt_centroid_terkini = [];
            foreach ( $iter_data_centroid_baru AS $index => $isi ) {

                // print_r( $isi );
                // echo "<h2>Hasil index ke - $index</h2>";
                foreach ( $dt_variabel_pilihan AS $pilihan ) {

                    $hasil = 0;

                    try {

                        $hasil = $iter_data_centroid_baru[$index][$pilihan] / $isi['count'];

                    } catch ( Exception $e ) {

                        // zero divide 
                    }
                    $iter_dt_centroid_terkini[$index][$pilihan] = $hasil;
                }
            }

            ksort($iter_dt_centroid_terkini);
            
            // cek galat 
            $status_galat = false;
            foreach ( $iter_hasil_cluster AS $index => $isi ) {

                if ( $isi != $hasil_iterasi['hasil_klusterisasi'][$index]) {

                    $status_galat = true;
                    break;
                }
            }


            // cek galat
            if ( $status_galat == false ) {
                
                $iterasi = 0; // break iterasi
            } 


            $jumlah_iterasi++;
            $urutan++;

            // echo $urutan.'<br>';

            $hasil_iterasi = array(

                'data'              => $dataset_filtered,
                'centroid_awal'     => $dt_centroid,
                'jarak'             => $iter_hasil_jarak,
                'hasil_klusterisasi'=> $iter_hasil_cluster,
                'tabel_klusterisasi'=> $iter_data_centroid_baru,
                'centroid_baru'     => $iter_dt_centroid_terkini
            );

            array_push( $arr_hasil_iterasi_keseluruhan, $hasil_iterasi );
            
            // $iterasi = 0;
        } while ( $iterasi != 0 );


        // foreach ( $arr_hasil_iterasi_keseluruhan AS $index => $isi ){

        //     echo "<h2>$index</h2>";
        //     echo json_encode( $isi );

        //     echo "<hr>";
        // }

        
        $parameter = array(

            'pilihan'   => $dt_variabel_pilihan,
            'ids'       => $dt_ids,
            'kelas'     => $memilih_kelas,
            'id_lesson' => $id_lesson
        );
        $final = array(

            'dt_dataset'    => json_encode( $dataset_filtered ),
            'dt_parameter'  => json_encode( $parameter ),
            'dt_perhitungan'=> json_encode( $arr_hasil_iterasi_keseluruhan ),
            'iterasi'   => $jumlah_iterasi
        );
        // echo "<pre>";
        // echo print_r($final);
        // echo "</pre>";

        $klusterisasi_id = DB::table("klusterisasi")->insertGetId( $final );
        $dataset_insert_db = array();

        foreach ( $dataset_filtered AS $isi ) {

            array_push( $dataset_insert_db,  [

                'klusterisasi_id'   => $klusterisasi_id,
                'nama'  => $isi['nama'],
                'kelas' => $isi['kelas'],
                'time'  => $isi['time'],
                'salah_wr'      => $isi['salah_wr'],
                'salah_gnd'     => $isi['salah_gnd'],
                'jumlah_gnd_wr' => $isi['jumlah_gnd_wr'],
                'nilai'         => $isi['nilai'],
                'tipe_nilai'    => $isi['tipe_nilai'],
            ]);
        }


        DB::table("dataset")->insert( $dataset_insert_db );
    }



    // dataset 
    function dataset( $id_lesson, $jenisNilai ) {


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
                foreach ( $isi->result AS $mhs ) {

                    $w_jawaban_2 += $mhs->W_Jawaban2;
                    $w_jawaban_3 += $mhs->W_Jawaban3;
                    $g_jawaban_2 += $mhs->G_Jawaban2;
                    $g_jawaban_3 += $mhs->G_Jawaban2;

                    $name = $mhs->nama;
                    $kelas = $mhs->level;
                    $id = $mhs->id_user;
                }

                // tambah
                $salah_wr  = $w_jawaban_2 + $w_jawaban_3;
                $salah_gnd = $g_jawaban_2 + $g_jawaban_3;
                $jumlah_gnd_wr = $salah_wr + $salah_gnd;
                
                // cari data nilai berdasarkan nama mahasiswa
                $cek_nilai = DB::table("nilai")->where("nama", $name)->get();
                $nilai = 0;
                if ( $cek_nilai->count() > 0 && $jenisNilai != "" ) {

                    if ( $jenisNilai == "pre" ) {

                        $nilai = $cek_nilai[0]->pre_test; // menggunakan post test    

                    } else if ( $jenisNilai == "post" ) {

                        $nilai = $cek_nilai[0]->post_test; // menggunakan post test    
                    
                    }  else if ( $jenisNilai == "delay" ) {

                        $nilai = $cek_nilai[0]->delay_test; // menggunakan post test    
                    }
                    
                }


                $time = $isi->waktu;

                array_push( $dataset_cleaning, [

                    'id'    => $id,
                    'nama'  => $name,
                    'kelas' => $kelas,
                    'time'  => $time,
                    'salah_wr'   => $salah_wr,
                    'salah_gnd'     => $salah_gnd,
                    'jumlah_gnd_wr' => $jumlah_gnd_wr,
                    'nilai'       => $nilai,
                    'tipe_nilai'  => $jenisNilai
                ]);
            }
        }



        return $dataset_cleaning;
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
