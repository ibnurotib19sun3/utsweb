<?php
// session_start();

// if(!isset($_SESSION["login"])) {
//     header("Location: login.php");
//     exit;
// }

include 'koneksi.php';
require 'functions.php';

$nis = $_GET["nis"];

$sun3 = query("SELECT * FROM santri WHERE nis = $nis") [0];

// Query nama kamar dari id kamar
$query = "SELECT s.nis, s.nama_santri, k.nama_kamar
          FROM santri s
          JOIN kamar k ON s.id_kamar = k.id_kamar
          WHERE s.nis = $nis";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $nama_santri_value = $row['nama_santri'];
    $nama_kamar_value = $row['nama_kamar'];
} else {
    $nama_santri_value = "";
    $nama_kamar_value = "";
}

// Query nama kelas dari id kelas
$query = "SELECT s.nis, s.nama_santri, k.nama_kelas
          FROM santri s
          JOIN kelas k ON s.id_kelas = k.id_kelas
          WHERE s.nis = $nis";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $nama_santri_value = $row['nama_santri'];
    $nama_kelas_value = $row['nama_kelas'];
} else {
    $nama_santri_value = "";
    $nama_kelas_value = "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Edit Santri
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <!-- Side Bar -->
  <?php require 'sidebar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <?php require 'navbar.php' ?>
    <!-- End Navbar -->

    <!-- Tabel -->
    <div class="container-fluid py-4">
      <div class="container-fluid py-6">
        <form action="" method="POST">
          <div class="row">
          <div class="col-md-15">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">Edit Santri</p>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nis" class="form-control-label" required>NIS</label>
                      <input name="nis" class="form-control" type="text" value="<?= $sun3["nis"]; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nama_santri" class="form-control-label">Nama Santri</label>
                      <input name="nama_santri" class="form-control" type="text" value="<?= $sun3["nama_santri"]; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nama_kelas" class="form-control-label">Kelas</label>
                      <select name="nama_kelas" id="id_kamar" class="form-control">
                          <option value=""><?= $nama_kelas_value; ?></option>
                          <?php 
                            $query = mysqli_query($conn, "SELECT * FROM kelas ORDER BY id_kelas ASC");
                            while($santri = mysqli_fetch_array($query))
                            {
                              echo '<option value="' . $santri['id_kelas'] . '">' . $santri['nama_kelas'] . '</option>';

                            }
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nama_kamar" class="form-control-label">kamar</label>
                      <select name="nama_kamar" id="id_kamar" class="form-control">
                          <option value=""><?= $nama_kamar_value; ?></option>
                          <?php 
                            $query = mysqli_query($conn, "SELECT * FROM kamar ORDER BY id_kamar ASC");
                            while($santri = mysqli_fetch_array($query))
                            {
                              echo '<option value="' . $santri['id_kamar'] . '">' . $santri['nama_kamar'] . '</option>';

                            }
                          ?>
                      </select>
                    </div>
                  </div>
                </div>
                <hr class="horizontal dark">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="alamat" class="form-control-label">Alamat</label>
                      <input name="alamat" class="form-control" type="text" value="<?= $sun3["alamat"]; ?>">
                    </div>
                  </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-sm ms-auto">Update Santri</button>
                <br>
                <?php
                  if (isset($_POST['submit'])) {
                    $update = mysqli_query($conn, "UPDATE santri SET 
                    nama_santri = '$_POST[nama_santri]',
                    id_kelas = '$_POST[nama_kelas]',
                    id_kamar = '$_POST[nama_kamar]',
                    alamat = '$_POST[alamat]'
                    WHERE nis = '$_GET[nis]'");

                    if ($update) {
                      echo "                      
                      <script>
                        alert('Data berhasil diubah!');
                        document.location.href = 'santri.php';
                      </script>";
                    } else {
                      echo 'Gagal: ' . mysqli_error($conn);
                    }
                  }
                ?>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php require 'footer.php' ?>
  </main>
  <?php require 'plugins.php' ?>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>