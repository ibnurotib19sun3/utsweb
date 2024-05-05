<?php

// koneksi ke database
$connect = mysqli_connect("localhost","root","","utsweb");

function query($query) {
    global $connect;
    $result = mysqli_query($connect, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $connect;
    // ambil data dari tiap elemen
    $nis = htmlspecialchars($data["nis"]);
    $nama_santri = htmlspecialchars($data["nama_santri"]);
    $nama_kelas = htmlspecialchars($data["nama_kelas"]);
    $nama_kamar = htmlspecialchars($data["nama_kamar"]);
    $alamat= htmlspecialchars($data["alamat"]);

    // query insert data
    $query = "INSERT INTO santri VALUES ('$nis','$nama_santri','$nama_kamar','$nama_kelas','$alamat')";    
    mysqli_query($connect,$query);

    return mysqli_affected_rows($connect);
}

function hapus($nis) {
    global $connect;
    mysqli_query($connect, "DELETE FROM santri WHERE nis=$nis");
    return mysqli_affected_rows($connect);
}

function hapusKelas($id_kelas) {
    global $connect;
    mysqli_query($connect, "DELETE FROM kelas WHERE id_kelas=$id_kelas");
    return mysqli_affected_rows($connect);
}

function hapusKamar($id_kamar) {
    global $connect;
    mysqli_query($connect, "DELETE FROM kamar WHERE id_kamar=$id_kamar");
    return mysqli_affected_rows($connect);
}

function ubah($data) {
    global $connect;
    // ambil data dari tiap elemen
    $nis = htmlspecialchars($data["nis"]);
    $nama_santri = htmlspecialchars($data["nama_santri"]);
    $kelas = htmlspecialchars($data["kelas"]);
    $kamar = htmlspecialchars($data["kamar"]);
    $alamat = htmlspecialchars($data["alamat"]);

    // query insert data
    $query = "UPDATE santri SET
                nis = '$nis',
                nama_santri = '$nama_santri',
                id_kelas = '$kelas',
                id_kamar = '$kamar',
                alamat = '$alamat',
                WHERE nis = $nis
                ";
    
    mysqli_query($connect,$query);

    return mysqli_affected_rows($connect);
}

function registrasiUser($data) {
    global $connect;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($connect,$data["password"]);
    $password2 = mysqli_real_escape_string($connect,$data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($connect,"SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar!')
            </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($connect, "INSERT INTO users VALUES('','$username','$password')");

    return mysqli_affected_rows($connect);
}

?>