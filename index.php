<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Demografi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/argon-dashboard.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css"> <!-- Custom CSS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/kabupaten.js" defer></script>
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="javascript:void(0)">
                <span class="ms-1 font-weight-bold">Demografi Wilayah</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kabupaten</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" id="kecamatanLink">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-pin-3 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kecamatan</span>
                    </a>
                </li>
                <!-- Kelurahan link is not displayed on the index page -->
            </ul>
        </div>
    </aside>
    <main class="main-content position-relative border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                </nav>
            </div>
        </nav>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
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
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
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
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
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
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Kecamatan</p>
                                        <h5 class="font-weight-bolder" id="totalKecamatan">0</h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-building text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <!-- Dropdown Kabupaten -->
                                <div class="mb-4 px-4">
                                    <label for="kabupatenSelect" class="form-label">Pilih Kabupaten:</label>
                                    <select class="form-select" id="kabupatenSelect">
                                        <option value="" selected disabled>Pilih Kabupaten</option>
                                        <?php
                                        try {
                                            // Mengambil data API
                                            $response = file_get_contents("http://demografidesa.my.id/api/demografi/kabupaten");
                                            $kabupatenData = json_decode($response, true);

                                            if (is_array($kabupatenData)) {
                                                foreach ($kabupatenData as $kabupaten) {
                                                    // Escape output untuk keamanan
                                                    $kabupatenId = htmlspecialchars($kabupaten['kabupaten_id'], ENT_QUOTES, 'UTF-8');
                                                    $namaKabupaten = htmlspecialchars($kabupaten['nama_kabupaten'], ENT_QUOTES, 'UTF-8');
                                                    echo "<option value='{$kabupatenId}'>{$namaKabupaten}</option>";
                                                }
                                            } else {
                                                echo '<option disabled>Data kabupaten tidak tersedia.</option>';
                                            }
                                        } catch (Exception $e) {
                                            echo '<option disabled>Gagal memuat data kabupaten.</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Visualisasi Data -->
                                <div id="dataSection" style="display: none;">
                                    <h2 id="selectedKabupaten" class="text-center"></h2>

                                    <div class="row">
                                        <!-- Bar Chart: Distribusi Usia -->
                                        <div class="col-md-6 mb-5 px-4">
                                            <h4>Distribusi Usia</h4>
                                            <canvas id="ageDistributionChart"></canvas>
                                        </div>

                                        <!-- Tabel: Pekerjaan Teratas -->
                                        <div class="col-md-6 mb-5 px-4">
                                            <h4>Pekerjaan Teratas</h4>
                                            <div class="table-responsive">
                                                <table class="table align-items-center mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                Pekerjaan</th>
                                                            <th
                                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                Laki-Laki</th>
                                                            <th
                                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                Perempuan</th>
                                                            <th
                                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="jobTableBody"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function navigateToKecamatan() {
            const selectedKabupatenId = document.getElementById('kabupatenSelect').value;
            if (selectedKabupatenId) {
                window.location.href = `kecamatan.php?kabupaten_id=${selectedKabupatenId}`;
            }
        }

        // Sidebar functionality
        document.getElementById('iconSidenav').addEventListener('click', function () {
            document.getElementById('sidenav-main').classList.toggle('g-sidenav-hidden');
        });

        // Pass kabupaten ID to kecamatan page
        document.getElementById('kecamatanLink').addEventListener('click', function () {
            const selectedKabupatenId = document.getElementById('kabupatenSelect').value;
            if (selectedKabupatenId) {
                window.location.href = `kecamatan.php?kabupaten_id=${selectedKabupatenId}`;
            } else {
                alert('Pilih Kabupaten terlebih dahulu.');
            }
        });

        // Retain selected kabupaten ID when navigating back from kecamatan
        const urlParams = new URLSearchParams(window.location.search);
        const kabupatenId = urlParams.get('kabupaten_id');
        if (kabupatenId) {
            document.getElementById('kabupatenSelect').value = kabupatenId;
            document.getElementById('kabupatenSelect').dispatchEvent(new Event('change'));
        }
    </script>
</body>

</html>