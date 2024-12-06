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

$id = intval($_GET['id']);
$sql = "SELECT * FROM produk_wisata WHERE id = $id";
$result = $conn->query($sql);
$produk = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_wisata = $conn->real_escape_string($_POST['nama_wisata']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $id = intval($_POST['id']);
    $foto_nama = $produk['foto']; // Default ke foto lama

    // Periksa jika ada file baru yang diunggah
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = $_FILES['foto'];
        $target_dir = "uploads/";
        $foto_nama = time() . "_" . basename($foto['name']);
        $target_file = $target_dir . $foto_nama;

        // Pindahkan file baru ke folder uploads
        if (move_uploaded_file($foto['tmp_name'], $target_file)) {
            // Hapus file lama jika ada
            if (file_exists($produk['foto'])) {
                unlink($produk['foto']);
            }
            $foto_nama = $target_file;
        }
    }

    $sql_update = "UPDATE produk_wisata 
                   SET nama_wisata='$nama_wisata', deskripsi='$deskripsi', foto='$foto_nama', tanggal_update=CURRENT_TIMESTAMP 
                   WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Produk berhasil diupdate.";
        header("Location: list_produk.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Produk Wisata</title>
</head>
<body>
    <h2>Update Produk Wisata</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $produk['id'] ?>">

        <label for="nama_wisata">Nama Wisata:</label><br>
        <input type="text" name="nama_wisata" value="<?= htmlspecialchars($produk['nama_wisata']) ?>" required><br><br>

        <label for="deskripsi">Deskripsi:</label><br>
        <textarea name="deskripsi" rows="5" required><?= htmlspecialchars($produk['deskripsi']) ?></textarea><br><br>

        <label for="foto">Gambar Wisata (Biarkan kosong jika tidak ingin mengganti):</label><br>
        <input type="file" name="foto" accept="image/*"><br>
        <img src="<?= htmlspecialchars($produk['foto']) ?>" alt="Foto Wisata" width="100"><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php $conn->close(); ?>
