<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "sd-db";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data produk berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM data_wisata WHERE id = $id";
    $result = $conn->query($query);
    $data = $result->fetch_assoc();

    if (!$data) {
        die("Data tidak ditemukan.");
    }
}

// Update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_wisata = $_POST['nama_wisata'];
    $deskripsi = $_POST['deskripsi'];
    $foto_lama = $data['foto'];

    // Proses file baru jika di-upload
    if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] !== "") {
        $foto_baru = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $target_dir = "uploads";

        // Hapus foto lama jika ada file baru
        if (file_exists($target_dir . $foto_lama)) {
            unlink($target_dir . $foto_lama);
        }

        // Pindahkan file baru ke folder tujuan
        move_uploaded_file($foto_tmp, $target_dir . $foto_baru);
    } else {
        // Jika tidak ada file baru, gunakan file lama
        $foto_baru = $foto_lama;
    }

    // Query update
    $query = "UPDATE data_wisata SET 
              nama_wisata = '$nama_wisata', 
              deskripsi = '$deskripsi', 
              foto = '$foto_baru', 
              tanggal_update = CURRENT_TIMESTAMP 
              WHERE id = $id";

    if ($conn->query($query) === TRUE) {
        echo "Data berhasil diperbarui. <a href='list_wisata.php'>Kembali ke daftar wisata</a>";
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
    <h1>Update Produk Wisata</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="nama_wisata">Nama Wisata:</label><br>
        <input type="text" name="nama_wisata" id="nama_wisata" value="<?= htmlspecialchars($data['nama_wisata']); ?>" required><br><br>

        <label for="deskripsi">Deskripsi:</label><br>
        <textarea name="deskripsi" id="deskripsi" required><?= htmlspecialchars($data['deskripsi']); ?></textarea><br><br>

        <label for="foto">Ganti Foto:</label><br>
        <img src="uploads/<?= htmlspecialchars($data['foto']); ?>" alt="<?= htmlspecialchars($data['nama_wisata']); ?>" style="max-width: 100px;"><br>
        <input type="file" name="foto" id="foto" accept="image/*"><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
<?php $conn->close(); ?>
