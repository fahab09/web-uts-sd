<?php
include "header.php";
include "sidebar.php";
?>
<main class="app-main"> <!--begin::App Content Header-->
<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Profil</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Dashboard
                    </li>
                </ol>
            </div>
        </div> <!--end::Row-->
    </div> <!--end::Container-->
</div> <!--end::App Content Header--> <!--begin::App Content-->
<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row"> <!--begin::Col-->
    <h1>Form Upload Produk Wisata</h1>
    <form action="proses_upload.php" method="POST" enctype="multipart/form-data">
        <label for="nama_wisata">Nama Wisata:</label><br>
        <input type="text" name="nama_wisata" id="nama_wisata" required><br><br>
        
        <label for="deskripsi">Deskripsi:</label><br>
        <textarea name="deskripsi" id="deskripsi" required></textarea><br><br>
        
        <label for="foto">Foto:</label><br>
        <input type="file" name="foto" id="foto" accept="image/*" required><br><br>
        
        <button type="submit">Upload</button>
    </form>
    </div> <!--end::Row--> <!--begin::Row-->
    </div> <!--end::Container-->
</div> <!--end::App Content-->
</main> <!--end::App Main-->
<?php
include "footer.php";
?>
