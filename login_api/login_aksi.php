<?php
//untuk session
session_start();

//cek sudah login atau belum
if(!isset($_SESSION["id_user"])){
    header('Location: login.php');
}

$uname = $_POST['nama'];

// pengambilan data dari database
// conf koneksi db
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "kemahasiswaan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM admin WHERE nama ='$uname'";
$result = $conn->query($sql);

if ($result->num_rows > 0){
    $row = $result->fetch_assoc();

    $_SESSION["id_user"] = $row['id_user'];
    $_SESSION["nama"] = $row['nama'];

    header('Location: ../public/index.php');
} else {
    echo 'user tidak valid';
}
?>
