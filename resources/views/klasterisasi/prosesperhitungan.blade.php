@extends('layouts/template')

@section('content')
<div class="pagetitle">
  <h1>Hasil Klusterisasi</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item active">Proses Perhitungan</li>
    </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-body">

        <div class="row">
          <div class="col-md-4 text-center" style="border-right: 2px solid #e0e0e0">
            <small>Pilihan Variabel Klustering</small>
            <h3>{{ implode(', ', $detail['pilihan']) }}</h3>
          </div>
          <div class="col-md-4 text-center" style="border-right: 2px solid #e0e0e0">
            <small>Kelas</small>
            <h3>{{ implode(', ', $detail['kelas']) }}</h3>
          </div>
        </div>
      </div>
    </div>
  </div>

  @php 

    $scatter_data_cluster_iter = array();
    


    $piechart = array();
    $scatter_data = array(); // last iter only

    foreach ( $detail['perhitungan'][0]->centroid_awal AS $index => $ca ) {

      $piechart[$index ] = 0;
    }

  @endphp
  @foreach ( $detail['perhitungan'] AS $index => $isi )


  @php 

    $scatter_centroid = array();

    foreach ( $isi->centroid_awal AS $index_c => $isi_c ){
      $scatter_centroid[ $index_c ] = 0;
    }
  @endphp

  <h2>Iterasi - {{ $index + 1 }}</h2>
  <div class="row">
    <div class="col-md-12">
      
      <div class="row">
        <div class="col-md-12">
          <h4>Dataset</h4>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Waktu</th>
                <th>Ground False</th>
                <th>Warrant False</th>
                <th>Kesalahan Keduanya</th>
                <th>Nilai {{ $detail['perhitungan'][0]->data[0]->tipe_nilai }}</th>
              </tr>
            </thead>  
            <tbody>
              @foreach ( $isi->data AS $index_mhs => $isi_mhs )

              <tr>
                <td>{{ $index_mhs + 1 }}</td>
                <td>{{ $isi_mhs->nama }}</td>
                <td>{{ $isi_mhs->time }}</td>
                <td>{{ $isi_mhs->salah_gnd }}</td>
                <td>{{ $isi_mhs->salah_wr }}</td>
                <td>{{ $isi_mhs->jumlah_gnd_wr }}</td>
                <td>{{ $isi_mhs->nilai }}</td>
              </tr>
              @endforeach 
            </tbody>
          </table>
        </div>
      </div>



      <div class="row">
        <div class="col-md-12">
          <h4>Centroid</h4>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Waktu</th>
                <th>Ground False</th>
                <th>Warrant False</th>
                <th>Kesalahan Keduanya</th>
                <th>Nilai {{ $detail['perhitungan'][0]->data[0]->tipe_nilai }}</th>
              </tr>
            </thead>  
            <tbody>
              @foreach ( $isi->centroid_awal AS $index_mhs => $isi_mhs )

              <tr>
                <td>{{ $index_mhs + 1 }}</td>
                <td>{{ $isi_mhs->nama }}</td>
                <td>{{ $isi_mhs->time }}</td>
                <td>{{ $isi_mhs->salah_gnd }}</td>
                <td>{{ $isi_mhs->salah_wr }}</td>
                <td>{{ $isi_mhs->jumlah_gnd_wr }}</td>
                <td>{{ $isi_mhs->nilai }}</td>
              </tr>
              @endforeach 
            </tbody>
          </table>
        </div>
      </div>


      <?php

          // kebutuhan untuk piechart
          $total_iter = count($detail['perhitungan']);
          $last_index = $total_iter - 1;
      ?>

      <div class="row">
        <div class="col-md-12">
          <h4>Perhitungan Jarak</h4>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                @foreach ( $isi->centroid_awal AS $index_c => $isi_c )
                <th>C{{ $index_c }}</th>
                @endforeach 
                <th>Kluster</th>
              </tr>
            </thead>  
            <tbody>
              @foreach ( $isi->data AS $index_mhs => $isi_mhs )

              <tr>
                <td>{{ $index_mhs + 1 }}</td>
                <td>{{ $isi_mhs->nama }}</td>


                @foreach ( $isi->jarak[$index_mhs] AS $isi_jarak )
                <td>{{ $isi_jarak }}</td>
                @endforeach 

                <?php

                  if ( $last_index == $index ){

                    $kluster_hsl = $isi->hasil_klusterisasi[$index_mhs];
                    $piechart[ $kluster_hsl ]++;

                    $scatter_data = $isi;
                  }

                ?>
                <td>C{{ $isi->hasil_klusterisasi[$index_mhs] }}</td>
              </tr>


              @php 
                $index = $isi->hasil_klusterisasi[$index_mhs];
                $scatter_centroid[ $index ]++;
              @endphp 



              @endforeach 
            </tbody>
          </table>
        </div>
      </div>

      @php 

        array_push( $scatter_data_cluster_iter, $scatter_centroid );
      @endphp



      <div class="row">
        <div class="col-md-12">
          <h4>Centroid Baru</h4>

          @foreach ( $isi->tabel_klusterisasi AS $index => $isi_tk )
          <small>Bagian Centroid {{ $index }}</small>
          <h5>{{ $isi_tk->nama }}</h5>
          <table class="table">
            <thead>
              <tr>
                <th></th>
                @foreach ( $detail['pilihan'] AS $pil )
                <th>{{ $pil }}</th>
                @endforeach
              </tr>
            </thead>  
            <tbody>
              <tr>  
                <td></td>
                @foreach ( $detail['pilihan'] AS $pil ) 
                <td>{{ $isi_tk->$pil }}</td>
                @endforeach
              </tr>
              <tr style="background-color: yellow">
                <td><b>TOTAL ({{ $isi_tk->count }})</b></td>
                @foreach ( $detail['pilihan'] AS $pil ) 
                <td>{{ $isi->centroid_baru[$index]->$pil }}</td>
                @endforeach
              </tr>
            </tbody>
          </table>
          @endforeach
        </div>
      </div>



    </div>
  </div>
  @endforeach 

  <div class="row">
    <div class="col-md-6">
      <div class="card card-body">
        <canvas id="pieChart" style="max-height: 400px;"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-body">
        <?php

          // echo json_encode($scatter_data);

          $var_time = [];
          $var_gf = [];
          $var_wf = [];
          $var_all_f = [];
          $var_nilai = [];

          $scatter_chart_data = array();



          if ( Request::has('x') ) {

            $require = [Request::input('x'), Request::input('y')];
            foreach ( $scatter_data->data AS $index => $isi ) {


              foreach ( $require AS $posisi => $r ) {

                if ( $r == "time" ) {

                  $scatter_chart_data[$index][$posisi] = $isi->time;
                } else if ( $r == "gf" ) {

                  $scatter_chart_data[$index][$posisi] = $isi->salah_gnd;
                } else if ( $r == "wf" ){

                  $scatter_chart_data[$index][$posisi] = $isi->salah_wr;
                } else if ( $r == "all" ){

                  $scatter_chart_data[$index][$posisi] = $isi->jumlah_gnd_wr;
                } else if ( $r == "nilai" ){

                  $scatter_chart_data[$index][$posisi] = $isi->nilai;
                }
              }
              
            }
          }

          // print_r( $scatter_chart_data );

        ?>

        <form action="" method="GET">
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <select class="form-control" name="x">
                  <option value="time" <?php if ( Request::input('x') == 'time' ) echo 'selected="selected"'; ?>>Time</option>
                  <option value="gf" <?php if ( Request::input('x') == 'gf' ) echo 'selected="selected"'; ?>>Ground False</option>
                  <option value="wf" <?php if ( Request::input('x') == 'wf' ) echo 'selected="selected"'; ?>>Warrant False</option>
                  <option value="all" <?php if ( Request::input('x') == 'all' ) echo 'selected="selected"'; ?>>Kesalahan Keduanya</option>
                  <option value="nilai" <?php if ( Request::input('x') == 'nilai' ) echo 'selected="selected"'; ?>>Nilai {{ $detail['perhitungan'][0]->data[0]->tipe_nilai }}</option>
                </select>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <select class="form-control" name="y">
                  <option value="time" <?php if ( Request::input('y') == 'time' ) echo 'selected="selected"'; ?>>Time</option>
                  <option value="gf" <?php if ( Request::input('y') == 'gf' ) echo 'selected="selected"'; ?>>Ground False</option>
                  <option value="wf" <?php if ( Request::input('y') == 'wf' ) echo 'selected="selected"'; ?>>Warrant False</option>
                  <option value="all" <?php if ( Request::input('y') == 'all' ) echo 'selected="selected"'; ?>>Kesalahan Keduanya</option>
                  <option value="nilai" <?php if ( Request::input('y') == 'nilai' ) echo 'selected="selected"'; ?>>Nilai {{ $detail['perhitungan'][0]->data[0]->tipe_nilai }}</option>
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <button class="btn btn-primary">Display</button>
              </div>
            </div>
          </div>
        </form>

        <canvas id="graph" aria - label="chart" height="350" style="width: 100%"></canvas>
      </div>
    </div>
  </div> 
</section>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"></script>

<script>

  var chrt = document.getElementById("graph");

  <?php
  
    $labelScatter = [];
    $warna = ['yellow', 'aqua', 'pink', 'lightgreen', 'gold', 'lightblue'];
  ?>
  var dataScatter = [
                  <?php foreach ( $scatter_chart_data AS $isi ) :?>
                      {x:<?php echo $isi[0] ?>, y:<?php echo $isi[1] ?>},
                  <?php endforeach; ?>
               ];

  var chartId = new Chart(chrt, {
         type: 'scatter',
         data: {
            labels: [

              <?php foreach ( $piechart AS $index => $isi ) {

                echo '"C'.$index.'",';
              } ?>
            ],
            datasets: [{
               label: "Hasil Kluster",
               data: dataScatter,
               backgroundColor: [

                <?php foreach ( $piechart AS $index => $isi ) :

                  $randomIndex = rand(0, count( $warna ) - 1);
                ?>
                '<?php echo $warna[$randomIndex] ?>',
                <?php endforeach; ?>
               ],
              //  borderColor: ['black'],
               radius: 8,
            }],
         },
         options: {
            responsive: false,
            scales: {
               x: {
                  type: 'linear',
                  position: 'bottom,'
               }
            }
         },
      });
</script>


<script>
  <?php 

    $color = ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)'];
  ?>
  document.addEventListener("DOMContentLoaded", () => {
  new Chart(document.querySelector('#pieChart'), {
    type: 'pie',
    data: {
      labels: [
        <?php foreach ( $piechart AS $index => $isi ) : ?>
          'C<?php echo $index ?>',
        <?php endforeach; ?>
      ],
      datasets: [{
        label: 'Total Centroid',
        data: [<?php echo implode(',', $piechart) ?>],
        backgroundColor: [
          <?php foreach ( $piechart AS $index => $isi ) :

            $randomIndex = rand(0, count( $color ) - 1);
          ?>
          '<?php echo $color[$randomIndex] ?>',
          <?php endforeach; ?>
        ],
        hoverOffset: 4
      }]
    }
  });
});
</script>
<!-- End Pie CHart -->
@endsection