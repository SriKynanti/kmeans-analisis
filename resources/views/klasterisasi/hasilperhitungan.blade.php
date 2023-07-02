@extends('layouts/template')

@section('content')
@php
use Carbon\Carbon;
@endphp
<div class="pagetitle">
  <h1>Hasil Klusterisasi</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item active">Hasil Klusterisasi</li>
    </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Hasil Klusterisasi</h4>
          <form>
            <!-- Table with stripped rows -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Variabel Pilihan</th>
                  <th scope="col">Kelas</th>
                  <th scope="col">Iterasi</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Opsi</th>
                </tr>
              </thead>
              <tbody>

                @foreach ( $perhitungan AS $index => $isi )

                @php

                $variabel_pilihan = json_decode( $isi->dt_parameter );
                @endphp
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ implode(', ', $variabel_pilihan->pilihan) }}</td>
                  <td>{{ implode(', ', $variabel_pilihan->kelas) }}</td>
                  <td>{{ $isi->iterasi }}</td>
                  <td>{{ \Carbon\Carbon::parse($isi->created_at)->format('d-m-Y') }}</td>
                  <td>
                    <a class="btn btn-primary" href="{{ url('hasil-kmeans/detail/'. $isi->id) }}">Lihat Proses Hitung</a>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
            <!-- End Table with stripped rows -->
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection