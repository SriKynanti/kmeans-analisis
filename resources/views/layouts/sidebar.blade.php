<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="/home">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-database"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="/dataset">
          <i class="bi bi-circle"></i><span>Data Set</span>
        </a>
      </li>
    </ul>
  </li><!-- End Master Data Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="/nilai">
      <i class="bi bi-file-earmark-binary"></i>
      <span>Nilai Mahasiswa</span>
    </a>
  </li><!-- End Data Set Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-bar-chart"></i><span>Perhitungan Klasterisasi</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="/perhitungan">
          <i class="bi bi-circle"></i><span>Klasterisasi</span>
        </a>
      </li>
      <li>
        <a href="{{ url('hasil-kmeans') }}">
          <i class="bi bi-circle"></i><span>History</span>
        </a>
      </li>
    </ul>
  </li><!-- End Perhitungan Klasterisasi Nav -->


  <li class="nav-heading">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="/profile">
      <i class="bi bi-person"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="/laporan">
      <i class="bi bi-file-earmark"></i>
      <span>Laporan</span>
    </a>
  </li><!-- End Laporan Page Nav -->

</ul>
</aside><!-- End Sidebar-->