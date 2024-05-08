<?php
// Header harus JSON
header("Content-Type: application/json");

// Tangkap header permintaan
$header = apache_request_headers();
$key = $header['key'];
$mahasiswa_id = $header['mahasiswa_id'];

// Tangkap metode permintaan
$method = $_SERVER['REQUEST_METHOD'];

// Inisialisasi hasil
$result = array();

// Pengecekan metode permintaan
if ($method == 'GET') {
    // Jika GET
    $result['status']['code'] = 200;
    $result['status']['description'] = 'Request Valid';

    // Koneksi ke database
    $servername = "localhost";
    $username = "root";
    $password = "123456";
    $dbname = "kemahasiswaan";

    // Buat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Periksa kevalidan key
    $query_key = "SELECT * FROM admin WHERE key_token='$key'";
    $result_key = $conn->query($query_key);
    $cek_key = $result_key->fetch_all(MYSQLI_ASSOC);
    if (count($cek_key) > 0) {
        // Jika key valid
        if (!empty($mahasiswa_id)) {
            // Filter data berdasarkan mahasiswa_id jika disertakan dalam header
            $sql = "SELECT * FROM mahasiswa WHERE id_mhs='$mahasiswa_id'";
        } else {
            // Tampilkan semua data mahasiswa jika mahasiswa_id tidak disertakan dalam header
            $sql = "SELECT * FROM mahasiswa";
        }
        // Eksekusi query
        $result_query = $conn->query($sql);
        if ($result_query->num_rows > 0) {
            // Data ditemukan, kirim sebagai respons
            $result['results'] = $result_query->fetch_all(MYSQLI_ASSOC);
        } else {
            // Data tidak ditemukan
            $result['status']['code'] = 404;
            $result['status']['description'] = 'Data tidak ditemukan';
        }
    } else {
        // Key tidak valid
        $result['status']['code'] = 401;
        $result['status']['description'] = 'Key tidak valid';
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika bukan metode GET
    $result['status']['code'] = 400;
    $result['status']['description'] = 'Bad Request';
}

// Encode hasil ke format JSON dan kirimkan sebagai respons
echo json_encode($result);
?>
