@extends('layouts.template')

@section('content')
<div class="pagetitle">
  <h1>Perhitungan Klusterisasi</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item active">Hasil Klasterisasi</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="row">
  <div class="col-lg-3">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Form Opsi Dataset</h5>

        <!-- General Form Elements -->
        <form class="row g-3" method="GET">
          <div class="row mb-3">
            <legend class="col-form-label">Pilih Variabel: </legend>
            <div class="col-sm-10">

              <div class="form-check">
                @php 

                  $statusCheckbox = array(

                    'time'        => '',
                    'salah_gnd'   => '',
                    'salah_wr'    => '',
                    'jumlah_gnd_wr'=> '',
                    'nilai'        => ''
                  );
                  if ( $res->filled('v') ) {

                    foreach ( $res->v AS $variab ) {

                      $statusCheckbox[$variab] = 'checked';
                    }
                  }

                @endphp 
                <input class="form-check-input" type="checkbox" name="v[]" value="time" id="1" {{ $statusCheckbox['time'] }}>
                <label class="form-check-label" for="1">
                  Waktu
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="v[]" value="salah_gnd" id="2" {{ $statusCheckbox['salah_gnd'] }}>
                <label class="form-check-label" for="2">
                  Ground False
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="v[]" value="salah_wr" id="3" {{ $statusCheckbox['salah_wr'] }}>
                <label class="form-check-label" for="3">
                  Warrant False
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="v[]" value="jumlah_gnd_wr" id="4" {{ $statusCheckbox['jumlah_gnd_wr'] }}>
                <label class="form-check-label" for="4">
                  Kesalahan Keduanya
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="v[]" value="nilai" id="5" {{ $statusCheckbox['nilai'] }}>
                <label class="form-check-label" for="5">
                  Nilai Pre Test
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="v[]" value="nilai" id="6" {{ $statusCheckbox['nilai'] }}>
                <label class="form-check-label" for="5">
                  Nilai Post Test
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="v[]" value="nilai" id="7" {{ $statusCheckbox['nilai'] }}>
                <label class="form-check-label" for="5">
                  Nilai Deleyed Test
                </label>
              </div>

            </div>
          </div>
          <div class="col-md-11">
            <legend class="col-form-label">Pilih Kelas:</legend>
            <select multiple name="kelas[]" id="shapes" required="">
              @foreach ( $dt_kelas AS $isi ) 
                @php 
                  $status = "";
                  if ( $res->filled('kelas') ) {
                    foreach ( $res->kelas AS $isi_det ) {
                      if ( $isi->kelas == $isi_det ) {
                        $status = 'selected="selected"';
                        break;
                      }
                    }
                  }
                @endphp 
                @if ( !empty( $isi->kelas ) )
                <option value="{{ $isi->kelas }}" {{ $status }}>{{ $isi->kelas }}</option>
                @endif
              @endforeach 
            </select>
          </div>

          <div class="col-md-11">
            <div class="form-group">
              <label for="">Pilih Lessons:</label>
              <select name="id_lesson" class="form-control" id="">
                @foreach ( $dt_lessons AS $isi )
                <option value="{{ $isi->id_lesson }}">{{ $isi->nama_lesson }}</option>
                @endforeach 
              </select>
            </div>
          </div>
          
          <div class="row" style="margin-top: 20px">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-block btn-sm btn-primary">Proses Mahasiswa</button>
            </div>
          </div>

        </form><!-- End General Form Elements -->

      </div>
    </div>

  </div>

  <div class="col-xl-9">


    <form action="{{ url('kmeans/manual') }}" method="post">
    
    @csrf


    @php $url = ""; @endphp
    @if ( $res->filled('v') && $res->filled('kelas') )
    <input type="hidden" name="id_lesson" value="{{ $res->id_lesson }}">
    <input type="hidden" name="kelas" value="{{ implode(',', $res->kelas) }}">
    <input type="hidden" name="v" value="{{ implode(',', $res->v) }}">


    @php 

      $pil_kelas = implode(',', $res->kelas);
      $pil_v = implode(',', $res->v);


      // random value 
      $persen = 10;
      $jumlah = ceil(count($dt_mahasiswa) * ($persen / 100));

      // pemilihan random id dataset 
      $emails = [];

      for ( $i = 0; $i < $jumlah; $i++ ) {

        // random index
        $rand_index = rand(0, 18);
        array_push( $emails, $dt_mahasiswa[$rand_index]['email'] );
      }



      $url = "id_lesson=$res->id_lesson&kelas=$pil_kelas&v=$pil_v&email=". implode(",", $emails);

    @endphp

    @endif
    
    

    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <h5 class="card-title">Data Set</h5>
          </div>
          <div class="col-md-6 text-right">
            <div>
              <a href="{{ url('kmeans/random?'. $url ) }}" class="btn btn-info btn-sm">Centroid Random</a>
              <button type="submit" class="btn btn-warning btn-sm">Proses Hitung</button><br>
              <small>Klik untuk memproses perhitungan </small>
            </div>
          </div>
        </div>
        
        <!-- Table with stripped rows -->
        <table class="table datatable-bug">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Kelas</th>
              <th scope="col">Time</th>
              <th scope="col">Ground False</th>
              <th scope="col">Warrant False</th>
              <th scope="col">Kesalahan Keduanya</th>
              <th scope="col">Nilai</th>
            </tr>
          </thead>
          <tbody>
            @foreach ( $dt_mahasiswa AS $index => $isi )
            <tr>
              <td>
                <input type="checkbox" name="email[]" value="{{ $isi['email'] }}">
              </td>
              <td>{{ $isi['nama'] ?? 'NULL'}}</td>
              <td>{{ $isi['kelas'] ?? 'NULL'}}</td>
              <td>{{ $isi['time'] ?? 'NULL'}}</td>
              <td>{{ $isi['salah_gnd'] ?? 'NULL'}}</td>
              <td>{{ $isi['salah_wr'] ?? 'NULL'}}</td>
              <td>{{ $isi['jumlah_gnd_wr'] ?? 'NULL'}}</td>
              <td>{{ $isi['nilai'] ?? 'NULL'}}</td>
            </tr>
            @endforeach 
          </tbody>
        </table>
        <!-- End Table with stripped rows -->

      </div>
    </div>

    </form>

  </div>
</div>
</section>
@endsection