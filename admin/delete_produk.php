<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'db-web';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hapus data dari database
    $sql = "DELETE FROM produk_wisata WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Produk berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
header("Location: list_produk.php");
exit;
?>
