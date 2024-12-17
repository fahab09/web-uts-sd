<?php
// Koneksi ke database
$host = "localhost";
$user = "root"; // Ganti sesuai dengan username database Anda
$password = ""; // Ganti sesuai dengan password database Anda
$database = "sd-db"; // Ganti dengan nama database Anda

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memproses data dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_wisata = $_POST['nama_wisata'];
    $deskripsi = $_POST['deskripsi'];
    $foto = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $target_dir = "uploads/";
    
    // Upload file ke folder "uploads"
    if (move_uploaded_file($foto_tmp, $target_dir . $foto)) {
        $sql = "INSERT INTO wisata (nama_wisata, deskripsi, foto, tanggal_update) 
                VALUES ('$nama_wisata', '$deskripsi', '$foto', CURRENT_TIMESTAMP)";
        
        if ($conn->query($sql) === TRUE) {
            echo "Data berhasil diupload. <a href='produk_wisata.php'>Kembali ke form</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Gagal mengupload file.";
    }
}

$conn->close();
?>
