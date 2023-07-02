@extends('layouts.template')

@section('content')
<div class="pagetitle">
      <h1>History</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active">Visualisasi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

      <div class="card">
        <div class="card-body">
            <h5 class="card-title">History Perhitungan</h5>
            <!-- Bordered Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Klusterisasi</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Lesson</th>
                        <th scope="col">Kluster</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
            <!-- End Bordered Table -->
        </div>
    </div>


      </div>
    </section>
@endsection
