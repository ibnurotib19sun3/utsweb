<?php 
session_start();

if(!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
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
    Data Kamar
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
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

      <?php 
        require 'koneksi.php';
      ?>

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <a href="tambah-kamar.php" class="btn btn-primary float-start">Tambah</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-4">ID Kamar</th>
                      <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2">Nama Kamar</th>
                      <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2">Kapasitas</th>
                      <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      
                      $query = mysqli_query($conn, "SELECT * FROM kamar");
                      while($kamar = mysqli_fetch_assoc($query))
                      {

                    ?>
                      <tr>
                        <td>
                          <div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <p class="text-xs font-weight-bold mb-0"><?= $kamar['id_kamar']; ?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex px-1 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?= $kamar['nama_kamar']; ?></h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex px-1 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <p class="text-xs font-weight-bold mb-0"><?= $kamar['kapasitas']; ?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex px-1 py-1">
                            <div class="flex-column float-start">
                              <a class="btn btn-link text-dark px-2 mb-0" href="edit-kamar.php?id_kamar=<?= $kamar["id_kamar"]; ?>"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                              <a class="btn btn-link text-danger text-gradient px-2 mb-0" href="hapus-kamar.php?id_kamar=<?= $kamar["id_kamar"]; ?>" onclick="return confirm('Yakin?');"><i class="far fa-trash-alt me-2"></i>Delete</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <?php 
                        } 
                      ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php require 'footer.php' ?>
    </div>
    <!-- End Tabel -->
  </main>
  <?php require 'plugins.php' ?>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
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