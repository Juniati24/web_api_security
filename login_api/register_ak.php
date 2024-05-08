<?php
if(isset($_POST['nama']) && isset($_POST['password'])) {
    if(empty($_POST['nama']) || empty($_POST['password'])) {
        echo '<script type="text/javascript">';
        echo 'alert("Nama dan password harus diisi.");';
        echo 'window.location.href = "register.php";'; 
        echo '</script>';
        exit;
    }

    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $key = md5($nama);

    // conf koneksi db
    $servername = "localhost";
    $username = "root";
    $dbpassword = "123456"; 
    $dbname = "kemahasiswaan";

    // Create connection
    $conn = new mysqli($servername, $username, $dbpassword, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query untuk memasukkan data 
    $sql = "INSERT INTO admin (nama, password, key_token) 
            VALUES ('$nama', '$password', '$key')";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        echo '<script type="text/javascript">';
        echo 'alert("Data berhasil dimasukkan.");';
        echo 'window.location.href = "register.php";'; 
        echo '</script>';
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
}
?>
