@extends('layouts.template')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">
        <div class="col-xxl-2 col-md-12">
          <div class="card info-card sales-card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="ps-3 align-text-center">
                  <h4>SILA | SMART Integration Learning Analytics</h4>
                  <span class="font-italic small pt-2 ps-1">This system functions to perform Educational Data Mining and generate Learning Analytics by combining data from various connected applications.</span>
                  <div><span class="text-muted small pt-2 ps-1">Sistem ini berfungsi untuk melakukan Educational Data Mining dan menghasilkan Analisa Pembelajaran (Learning Analytics) dengan menggabungkan data dari berbagai aplikasi yang sudah terhubung.</span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Fuzzy K-Means -->
    <div class="col-xxl-4 col-md-6">
      <div class="card info-card revenue-card">

        <div class="card-body">
          <h5 class="card-title">Metode Fuzzy K-Means <span>| Muhammad Alif Ananda</span></h5>

          <div class="d-flex">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <img src="assets/img/clustering.png" alt="">
            </div>
            <div class="ps-3">
              <h4>Fuzzy K-Means</h4>
              <span class="font-italic small pt-2 ps-1">Fuzzy k-means is a variation of the traditional k-means clustering algorithm that allows for a degree of uncertainty or "fuzziness" in the assignment of data points to clusters. Each iteration in FKM clustering also starts with calculating the distance of each data sample for each centroid (Hot, E., & Popović-Bugarin, V. (2016))</span>
              <div><span class="text-muted small pt-2 ps-1">Fuzzy k-means adalah variasi dari algoritma pengelompokan k-means tradisional yang memungkinkan tingkat ketidakpastian atau "kekaburan" dalam penugasan poin data ke cluster. Setiap iterasi dalam FKM clustering juga diawali dengan menghitung jarak setiap sampel data untuk setiap centroid (Hot, E., & Popović-Bugarin, V. (2016))</span></div>
            </div>
          </div>
        </div>

      </div>
    </div><!-- End Fuzzy K-Means -->
    
    <!-- K Means -->
    <div class="col-xxl-4 col-md-6">
      <div class="card info-card sales-card">

        <div class="card-body">
          <h5 class="card-title">Metode K-Means <span>| Sri Kynanti</span></h5>

          <div class="d-flex">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <img src="assets/img/clustering.png" alt="">
            </div>
            <div class="ps-3">
              <h4>K-Means</h4>
              <span class="font-italic small pt-2 ps-1">K-means is an unsupervised grouping method that groups data into coherent groups (Abdallah Moubayed, 2020).The K-Means method divides the data into several groups (clusters) where later these data groups have the same characteristics into the same cluster and different data groups will be grouped into other clusters (Indah Purnama Sari, 2021).</span>
              <div><span class="text-muted small pt-2 ps-1">K-means merupakan salah satu metode pengelompokan unsupervised yang melakukan pengelompokan data ke dalam kelompok yang koheren(Abdallah Moubayed, 2020). 
                Metode K-Means membagi data menjadi beberapa kelompok-kelompok (cluster) dimana nanti kelompok data-data tersebut memiliki karakteristik yang sama ke dalam cluster yang sama dan kelompok data yang berbeda akan dikelompokkan pada cluster yang lain(Indah Purnama 
                Sari, 2021).</span></div>
            </div>
          </div>
        </div>

      </div>
    </div><!-- End K-Means -->

    <!-- K Fold -->
    <div class="col-xxl-4 col-md-12">
      <div class="card info-card sales-card">

        <div class="card-body">
          <h5 class="card-title">Metode K-Fold <span>| Daniel Bagus Christyanto</span></h5>

          <div class="d-flex">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <img src="assets/img/fold.png" alt="">
            </div>
            <div class="ps-3">
              <h4>K-Fold</h4>
              <span class="font-italic small pt-2 ps-1">K-Fold is one of the most commonly used cross-validation methods in statistical modeling and machine learning. It is used to test and validate model performance by dividing data into parts or "folds".</span>
              <div><span class="text-muted small pt-2 ps-1">K-Fold adalah salah satu metode validasi silang (cross-validation) yang umum digunakan dalam pemodelan statistik dan pembelajaran mesin. Ini digunakan untuk menguji dan memvalidasi kinerja model dengan membagi data menjadi beberapa bagian atau "lipatan" (folds).</span></div>
            </div>
          </div>
        </div>

      </div>
    </div><!-- End K-Fold -->

    <!-- Reports -->
    <div class="col-12">
      <div class="card">

        <div class="card-body">
          <h5 class="card-title">Reports <span>/Today</span></h5>

          <!-- Line Chart -->
          <div id="reportsChart"></div>

          <script>
            document.addEventListener("DOMContentLoaded", () => {
              new ApexCharts(document.querySelector("#reportsChart"), {
                series: [{
                  name: 'Sales',
                  data: [31, 40, 28, 51, 42, 82, 56],
                }, {
                  name: 'Revenue',
                  data: [11, 32, 45, 32, 34, 52, 41]
                }, {
                  name: 'Customers',
                  data: [15, 11, 32, 18, 9, 24, 11]
                }],
                chart: {
                  height: 350,
                  type: 'area',
                  toolbar: {
                    show: false
                  },
                },
                markers: {
                  size: 4
                },
                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                fill: {
                  type: "gradient",
                  gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.4,
                    stops: [0, 90, 100]
                  }
                },
                dataLabels: {
                  enabled: false
                },
                stroke: {
                  curve: 'smooth',
                  width: 2
                },
                xaxis: {
                  type: 'datetime',
                  categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                },
                tooltip: {
                  x: {
                    format: 'dd/MM/yy HH:mm'
                  },
                }
              }).render();
            });
          </script>
          <!-- End Line Chart -->

        </div>

      </div>
    </div><!-- End Reports -->

  </div>
  </div><!-- End Left side columns -->

</section>
@endsection