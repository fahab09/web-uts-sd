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

// Hapus data jika tombol delete ditekan
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM wisata WHERE id = $id";
    if ($conn->query($query) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data dari tabel wisata
$query = "SELECT * FROM data_wisata";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Produk Wisata</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>List Produk Wisata</h1>
    <a href="form_upload.php">Tambah Produk Wisata</a><br><br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Wisata</th>
                <th>Deskripsi</th>
                <th>Foto</th>
                <th>Tanggal Update</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= htmlspecialchars($row['nama_wisata']); ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                        <td><img src="uploads/<?= htmlspecialchars($row['foto']); ?>" alt="<?= htmlspecialchars($row['nama_wisata']); ?>"></td>
                        <td><?= $row['tanggal_update']; ?></td>
                        <td>
                            <a href="update_wisata.php?id=<?= $row['id']; ?>">Update</a> |
                            <a href="list_wisata.php?delete=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<?php $conn->close(); ?>
