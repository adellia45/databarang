<?php
// Sertakan file koneksi database
include 'database.php';

// Ambil ID dari URL
 $id = $_GET['id'];

// Ambil data barang berdasarkan ID
 $query = "SELECT * FROM barang WHERE id_barang = $id";
 $result = mysqli_query($db, $query);
 $barang = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan, redirect ke halaman utama
if (!$barang) {
    header("Location: databarang.php");
    exit();
}

// Proses update data jika form disubmit
if (isset($_POST['update'])) {
    // Ambil data dari form
    $id = $_POST['id'];
    $nama = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    // datetime-local mengirimkan format "YYYY-MM-DDTHH:MM:SS", kita ganti T dengan spasi
    $tanggal = str_replace('T', ' ', $_POST['tanggal']);

    // Query untuk mengupdate data
    $query = "UPDATE barang SET 
                nama = '$nama', 
                jumlah = '$jumlah', 
                harga = '$harga', 
                tanggal = '$tanggal' 
              WHERE id_barang = $id";

    // Eksekusi query
    if (mysqli_query($db, $query)) {
        // Redirect ke halaman databarang.php jika berhasil
        header("Location: databarang.php");
        exit();
    } else {
        // Tampilkan pesan error jika gagal
        $error = "Error: " . $query . "<br>" . mysqli_error($db);
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Edit Barang</title>
  </head>
  <body>
    <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">CRUD PHP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="databarang.php">Barang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Mahasiswa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Modal</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>
<div class="container mt-5">
    <h1>Edit Barang</h1>
    <hr>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form action="" method="post">
        <!-- Hidden input untuk menyimpan ID yang akan diupdate -->
        <input type="hidden" name="id" value="<?= $barang['id_barang']; ?>">

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <!-- value diisi dengan data dari database -->
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $barang['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $barang['jumlah']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?= $barang['harga']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal dan Waktu</label>
            <!-- Format tanggal untuk datetime-local adalah Y-m-d\TH:i:s -->
            <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d\TH:i:s', strtotime($barang['tanggal'])); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update</button>
        <a href="databarang.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
  </body>
</html>