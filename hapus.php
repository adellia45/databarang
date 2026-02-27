<?php
// Sertakan file koneksi database
include 'database.php';

// --- PERBAIKAN: Tambahkan pemeriksaan ID ---
if (isset($_GET['id'])) {
    // Ambil ID dari URL
    $id = $_GET['id'];

    // Buat query untuk menghapus data berdasarkan ID
    // Gunakan prepared statement untuk keamanan (mencegah SQL Injection)
    $stmt = $db->prepare("DELETE FROM barang WHERE id_barang = ?");
    $stmt->bind_param("i", $id); // "i" berarti parameter adalah integer

    // Eksekusi query
    if ($stmt->execute()) {
        // Jika berhasil, alihkan ke halaman databarang.php
        header("Location: databarang.php");
        exit();
    } else {
        // Jika gagal, tampilkan pesan error (untuk debugging, bisa dihapus nanti)
        echo "Error deleting record: " . $db->error;
    }

    // Tutup statement
    $stmt->close();

} else {
    // Jika tidak ada ID, kembali ke halaman utama
    header("Location: databarang.php");
    exit();
}

// Tutup koneksi
 $db->close();
?>