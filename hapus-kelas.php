<?php
// session_start();

// if(!isset($_SESSION["login"])) {
//     header("Location: login.php");
//     exit;
// }

require 'functions.php';

$id_kelas = $_GET["id_kelas"];

if ( hapusKelas($id_kelas) > 0 ) {
    echo "
            <script>
                alert('Data berhasil dihapus');
                document.location.href = 'kelas.php';
            </script>
        ";
} else {
    echo "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'kelas.php';
            </script>
        ";
}

?>