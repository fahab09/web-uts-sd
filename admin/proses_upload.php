<?php
// Koneksi ke database
$host = 'localhost'; // Sesuaikan dengan host Anda
$user = 'root'; // Sesuaikan dengan username database Anda
$password = ''; // Sesuaikan dengan password database Anda
$database = 'db-web'; // Sesuaikan dengan nama database Anda

$conn = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_wisata = $conn->real_escape_string($_POST['nama_wisata']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);

    // Upload foto
    $foto = $_FILES['foto'];
    $foto_nama = basename($foto['name']);
    $target_dir = "uploads/";
    $target_file = $target_dir . time() . "_" . $foto_nama;

    if (move_uploaded_file($foto['tmp_name'], $target_file)) {
        // Simpan ke database
        $sql = "INSERT INTO produk_wisata (nama_wisata, deskripsi, foto, tanggal_update) 
                VALUES ('$nama_wisata', '$deskripsi', '$target_file', CURRENT_TIMESTAMP)";

        if ($conn->query($sql) === TRUE) {
            echo "Produk berhasil diupload!";
            echo "<a href='list_produk.php'>Lihat Data Wisata</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Terjadi kesalahan saat mengupload file.";
    }
}

$conn->close();
?>
