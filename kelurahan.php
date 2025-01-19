<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Demografi - Kelurahan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/argon-dashboard.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css"> <!-- Custom CSS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/kelurahan.js" defer></script>
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="javascript:void(0)">
                <span class="ms-1 font-weight-bold">Dashboard Demografi</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php" id="kabupatenLink">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kabupaten</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kecamatan.php" id="kecamatanLink">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-pin-3 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kecamatan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="kelurahan.php">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kelurahan</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main class="main-content position-relative border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h6 class="font-weight-bolder mb-0">Dashboard Demografi Kelurahan</h6>
                </nav>
            </div>
        </nav>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Penduduk</p>
                                        <h5 class="font-weight-bolder" id="totalPenduduk">0</h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Laki-Laki</p>
                                        <h5 class="font-weight-bolder" id="totalLakiLaki">0</h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Perempuan</p>
                                        <h5 class="font-weight-bolder" id="totalPerempuan">0</h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <button onclick="history.back()" class="btn btn-secondary mb-4">Kembali</button>
                <h1 class="text-center">Dashboard Demografi Kelurahan</h1>

                <!-- Dropdown Kelurahan -->
                <div class="mb-4">
                    <label for="kelurahanSelect" class="form-label">Pilih Kelurahan:</label>
                    <select class="form-select" id="kelurahanSelect">
                        <option value="" selected disabled>Pilih Kelurahan</option>
                    </select>
                </div>

                <!-- Visualisasi Data -->
                <div id="dataSection" style="display: none;">
                    <h2 id="selectedKelurahan" class="text-center"></h2>

                    <!-- Bar Chart: Distribusi Usia -->
                    <div class="mb-5">
                        <h4>Distribusi Usia</h4>
                        <canvas id="ageChart"></canvas>
                    </div>

                    <!-- Bar Chart: Distribusi Jenis Kelamin -->
                    <div class="mb-5">
                        <h4>Distribusi Jenis Kelamin</h4>
                        <canvas id="genderChart"></canvas>
                    </div>

                    <!-- Tabel: Pekerjaan Teratas -->
                    <div class="mb-5">
                        <h4>Pekerjaan Teratas</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Pekerjaan</th>
                                    <th>Laki-Laki</th>
                                    <th>Perempuan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="jobTableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>