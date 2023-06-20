@extends('layouts/template')

@section('content')
<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Hasil Klusterisasi</h4>

              <!-- Table with stripped rows -->
              <h class="card-title">ITERASI 1</h5>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Nim</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Centroid 1</th>
                    <th scope="col">Centroid 2</th>
                    <th scope="col">Centroid 3</th>
                    <th scope="col">Kluster</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection