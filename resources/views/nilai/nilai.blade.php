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
                    <select class="form-control" name="id_lesson" aria-label="Default select example">
                        @foreach ($dt_lessons as $isi)
                            <option value="{{ $isi->id_lesson }}">{{ $isi->nama_lesson }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-sm btn-success">Unduh Excel</button>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#basicModal">Upload</button>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Basic Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/nilai/import_excel') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <img src="" alt="" srcset="">

                        <div class="form-group">
                            <label for="">File Excel</label>
                            <input type="file" name="userfile" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Basic Modal-->

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
                    @foreach ($data as $key => $isi)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $isi->nama }}</td>
                            <td>{{ $isi->pre_test }}</td>
                            <td>{{ $isi->post_test }}</td>
                            <td>{{ $isi->delay_test }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Bordered Table -->
        </div>
    </div>

    
@endsection
