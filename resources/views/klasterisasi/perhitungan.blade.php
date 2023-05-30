@extends('layouts.template')

@section('content')
<div class="pagetitle">
  <h1>Perhitungan Klusterisasi</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item active">Klasterisasi</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="row">
  <div class="col-lg-4">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">General Form Elements</h5>

        <!-- General Form Elements -->
        <form class="row g-3">
          <div class="row mb-3">
            <legend class="col-form-label">Pilih Variabel: </legend>
            <div class="col-sm-10">

              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck1">
                <label class="form-check-label" for="gridCheck1">
                  Waktu
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck2">
                <label class="form-check-label" for="gridCheck2">
                  Ground False
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck2">
                <label class="form-check-label" for="gridCheck2">
                  Warrant False
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck2">
                <label class="form-check-label" for="gridCheck2">
                  Kesalahan Keduanya
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck2">
                <label class="form-check-label" for="gridCheck2">
                  Nilai
                </label>
              </div>

            </div>
          </div>
          <div class="col-md-12">
            <legend class="col-form-label">Pilih Kelas:</legend>
            <select id="mySelect" multiple="multiple">
              <option value="Option one">2G</option>
              <option value="Option two">2H</option>
              <option value="Option three">2I</option>
            </select>
            </select>
          </div>
          <div></div>
          <div class="row mb-4">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>

        </form><!-- End General Form Elements -->

      </div>
    </div>

  </div>

  <div class="col-xl-8">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Data Set</h5>
        <!-- Table with stripped rows -->
        <table class="table datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Kelas</th>
              <th scope="col">Waktu</th>
              <th scope="col">Nilai</th>
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
            <tr>
              <th scope="row">4</th>
              <td>Angus Grady</td>
              <td>HR</td>
              <td>34</td>
              <td>2012-06-11</td>
            </tr>
            <tr>
              <th scope="row">5</th>
              <td>Raheem Lehner</td>
              <td>Dynamic Division Officer</td>
              <td>47</td>
              <td>2011-04-19</td>
            </tr>
          </tbody>
        </table>
        <!-- End Table with stripped rows -->

      </div>
    </div>

  </div>
</div>
</section>
@endsection