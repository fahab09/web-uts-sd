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

// Ambil data produk dari database
$sql = "SELECT * FROM produk_wisata ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk Wisata</title>
</head>
<body>
    <h2>Daftar Produk Wisata</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama Wisata</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Tanggal Update</th>
            <th>Aksi</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['nama_wisata']) ?></td>
                    <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                    <td><img src="<?= htmlspecialchars($row['foto']) ?>" alt="Foto Wisata" width="100"></td>
                    <td><?= $row['tanggal_update'] ?></td>
                    <td>
                        <a href="update_produk.php?id=<?= $row['id'] ?>">Update</a> |
                        <a href="delete_produk.php?id=<?= $row['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Belum ada data produk wisata.</td>
            </tr>
        <?php endif; ?>

    </table>
</body>
</html>

<?php $conn->close(); ?>
