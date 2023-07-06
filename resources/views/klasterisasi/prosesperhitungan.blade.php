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
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
                <th>E</th>
              </tr>
            </thead>  
            <tbody>
              @foreach ( $isi->data AS $index_mhs => $isi_mhs )

              <tr>
                <td>{{ $index_mhs + 1 }}</td>
                <td>{{ $isi_mhs->nama }}</td>
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
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
                <th>E</th>
              </tr>
            </thead>  
            <tbody>
              @foreach ( $isi->centroid_awal AS $index_mhs => $isi_mhs )

              <tr>
                <td>{{ $index_mhs + 1 }}</td>
                <td>{{ $isi_mhs->nama }}</td>
              </tr>
              @endforeach 
            </tbody>
          </table>
        </div>
      </div>



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
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Centroid Awal</h4>
          <form>
            <!-- Table with stripped rows -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Var 1</th>
                  <th scope="col">Var 2</th>
                  <th scope="col">Var 3</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>1</th>
                  <th>Rheno</th>
                  <th>19</th>
                  <th>5</th>
                  <th>50</th>
                </tr>
                <tr>
                  <th>2</th>
                  <th>Versa</th>
                  <th>19</th>
                  <th>5</th>
                  <th>50</th>
                </tr>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Euclidean Distance</h4>
          <form>
            <!-- Table with stripped rows -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">dc1</th>
                  <th scope="col">dc2</th>
                  <th scope="col">dst</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>1</th>
                  <th>Rheno</th>
                  <th>20,998</th>
                  <th>0</th>
                </tr>
                <tr>
                  <th>2</th>
                  <th>Versa</th>
                  <th>13,998</th>
                  <th>0</th>
                </tr>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Hasil Cluster</h4>
          <form>
            <!-- Table with stripped rows -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">C1</th>
                  <th scope="col">C2</th>
                  <th scope="col">C3</th>
                  <th scope="col">dst</th>
                </tr>
              </thead>
              <tbody>
              <tr>
                  <th></th>
                  <th>Rheno</th>
                  <th>Sai</th>
                  <th>Mei</th>
                </tr>
                <tr>
                  <th></th>
                  <th>Versa</th>
                  <th>Rey</th>
                  <th>Nita</th>
                </tr>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Centroid Baru(Rata-Rata cluster)</h4>
          <form>
            <!-- Table with stripped rows -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">C1</th>
                  <th scope="col">C2</th>
                  <th scope="col">C3</th>
                  <th scope="col">dst</th>
                </tr>
              </thead>
              <tbody>
              <tr>
                  <th>1</th>
                  <th>15</th>
                  <th>5</th>
                  <th>0</th>
                </tr>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="card card-body">
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
  ?>
  var dataScatter = [
                  <?php foreach ( $scatter_data_cluster_iter AS $isi ) :?>
                    <?php foreach ( $isi AS $index => $row ): 
                      
                        $labelScatter[$index] = "";
                      ?>
                      {x:<?php echo $index + 1 ?>, y:<?php echo $row ?>},
                    <?php endforeach; ?>
                  <?php endforeach; ?>
               ];

  var chartId = new Chart(chrt, {
         type: 'scatter',
         data: {
            labels: [

              <?php foreach ( $labelScatter AS $index => $isi ) {

                echo '"C'.$index.'",';
              } ?>
            ],
            datasets: [{
               label: "Hasil Kluster",
               data: dataScatter,
               backgroundColor: ['yellow', 'aqua', 'pink', 'lightgreen', 'gold', 'lightblue'],
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
@endsection