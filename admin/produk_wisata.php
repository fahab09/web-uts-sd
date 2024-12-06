<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Form Upload Produk Wisata</h2>
    <form action="proses_upload.php" method="POST" enctype="multipart/form-data">
        <label for="nama_wisata">Nama Wisata:</label><br>
        <input type="text" name="nama_wisata" required><br><br>

        <label for="deskripsi">Deskripsi:</label><br>
        <textarea name="deskripsi" rows="5" required></textarea><br><br>

        <label for="foto">Foto:</label><br>
        <input type="file" name="foto" accept="image/*" required><br><br>

        <input type="submit" value="Upload">
    </form>
</body>
</html>
    