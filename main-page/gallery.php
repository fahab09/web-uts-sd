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

// Ambil data dari tabel wisata
$query = "SELECT * FROM data_wisata";
$result = $conn->query($query);
?>

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-bold text-primary">Dokumentasi Kegiatan</p>
            <h1 class="display-5 mb-5" id="news">Berita dan Galeri</h1>
        </div>
        <div class="row wow fadeInUp" data-wow-delay="0.3s">
            <div class="col-12 text-center">
                <ul class="list-inline rounded mb-5" id="portfolio-flters">
                    <li class="mx-2 active" data-filter="*">Semua</li>
                    <li class="mx-2" data-filter=".first">Complete</li>
                    <li class="mx-2" data-filter=".second">Ongoing</li>
                </ul>
            </div>
        </div>
        <div class="row g-4 portfolio-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
                        <div class="portfolio-inner rounded">
                            
                            <img class="img-fluid" src="../admin/uploads/<?= htmlspecialchars($row['foto']); ?>" alt="<?= htmlspecialchars($row['nama_wisata']); ?>">
                            <div class="portfolio-text">
                                <h4 class="text-white mb-4"><?= htmlspecialchars($row['nama_wisata']); ?></h4>
                                <div class="d-flex">
                                    <a class="btn btn-lg-square rounded-circle mx-2" href="../admin/uploads/<?= htmlspecialchars($row['foto']); ?>" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-lg-square rounded-circle mx-2" href="#"><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Tidak ada data yang tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $conn->close(); ?>
