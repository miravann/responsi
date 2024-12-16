<?php
// Mendapatkan data dari request POST. Jika data tidak ada, nilainya akan diatur ke null.
$name = isset($_POST['name']) ? $_POST['name'] : null;
$age = isset($_POST['age']) ? $_POST['age'] : null;
$origin = isset($_POST['origin']) ? $_POST['origin'] : null;
$mountain = isset($_POST['mountain']) ? $_POST['mountain'] : null;
$basecamp = isset($_POST['basecamp']) ? $_POST['basecamp'] : null;
$groupSize = isset($_POST['groupSize']) ? $_POST['groupSize'] : null;
$leader = isset($_POST['leader']) ? $_POST['leader'] : null;

// Konfigurasi koneksi ke database
$servername = "localhost"; // Nama server database
$username = "root";        // Nama pengguna database
$password = "";            // Kata sandi pengguna
$dbname = "responsi_web";  // Nama database yang akan digunakan

// Membuat koneksi ke database dengan penanganan error
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Periksa koneksi, jika gagal maka lemparkan exception
    if ($conn->connect_error) {
        throw new Exception("Koneksi gagal: " . $conn->connect_error);
    }

    // Membuat query SQL untuk menyisipkan data ke tabel 'reservasi'
    $sql = "INSERT INTO nama_tabel (nama, umur, asal, gunung, basecamp, jumlah_rombongan, leader_rombongan) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Mempersiapkan pernyataan SQL dengan metode prepare untuk menghindari SQL injection
    $stmt = $conn->prepare($sql);

    // Mengikat parameter input ke pernyataan SQL
    $stmt->bind_param("sisssis", $name, $age, $origin, $mountain, $basecamp, $groupSize, $leader);
    
    // Menjalankan pernyataan SQL
    if ($stmt->execute()) {
        echo "Data reservasi berhasil disimpan."; // Pesan jika data berhasil ditambahkan
    } else {
        echo "Terjadi kesalahan: " . $stmt->error; // Menampilkan error jika terjadi kegagalan
    }

    // Menutup pernyataan dan koneksi database
    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    // Menangkap dan menampilkan pesan error jika ada exception
    echo "Error: " . $e->getMessage();
}
?>
