<?php
// session_start();

// if(!isset($_SESSION["login"])) {
//     header("Location: login.php");
//     exit;
// }

require 'functions.php';

$id_kamar = $_GET["id_kamar"];

if ( hapusKamar($id_kamar) > 0 ) {
    echo "
            <script>
                alert('Data berhasil dihapus');
                document.location.href = 'kamar.php';
            </script>
        ";
} else {
    echo "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'kamar.php';
            </script>
        ";
}

?>