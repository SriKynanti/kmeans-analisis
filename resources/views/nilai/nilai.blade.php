@extends('layouts.template')
@section('content')
<div class="pagetitle">
    <h1>Nilai Mahasiswa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Nilai</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<form action="{{ url('nilai/download_excel') }}" method="post">
   @csrf

<div class="row">
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Pilih Lesson</label>
        <div class="col-sm-6">
            <select class="form-select" aria-label="Default select example">
                @foreach ( $dt_lessons AS $isi )
                <option selected value="{{ $isi->id_lesson }}">{{ $isi->nama_lesson }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <button type="submit" class="btn btn-block btn-sm btn-success">Unduh Excel</button>
        </div>
    </div>
</div>
</form>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Nilai Mahasiswa</h5>
        <!-- Bordered Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">Nilai Post Test</th>
                    <th scope="col">Nilai Pre Test</th>
                    <th scope="col">Nilai Delay Test</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td>28</td>
                    <td>2016-05-25</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Bridie Kessler</td>
                    <td>Developer</td>
                    <td>35</td>
                    <td>2014-12-05</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Ashleigh Langosh</td>
                    <td>Finance</td>
                    <td>45</td>
                    <td>2011-08-12</td>
                </tr>
            </tbody>
        </table>
        <!-- End Bordered Table -->
    </div>
</div>
</section>
@endsection