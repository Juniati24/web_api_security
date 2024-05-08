<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "kemahasiswaan";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);
// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil key_token dari database berdasarkan nama pengguna yang sedang masuk
$nama_pengguna = $_SESSION['nama']; 
$sql = "SELECT key_token FROM admin WHERE nama = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nama_pengguna);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Setel nilai key_token ke dalam session
    $_SESSION['key_token'] = $row['key_token'];
} else {
    echo "Key token tidak ditemukan."; 
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Panel LaslesAPI</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
     <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../public/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../public/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../public/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="../public/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="../public/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="../public/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <!-----navbar------------------->
		<nav class="navbar navbar-expand-lg navbar-light py-2">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../public/assets/img/icons/logo.png" alt="" width="30" />
            <span class="text-1000 fs-1 ms-2 fw-medium">Lasles<span class="font-weight-bold">API</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto pt-2 pt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="../public/index.php">Home</a>
                </li>
                <li class="nav-item dropdown mx-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Integration
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="doc.php"><i class="fas fa-book"></i> Documentation API</a>
                    </div>
                </li>
                <li class="nav-item dropdown mx-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Download
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#"><i class="fab fa-android"></i> Android Application</a>
                    </div>
                </li>
                <li class="nav-item dropdown mx-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Help
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#"><i class="fas fa-question-circle"></i> FAQ</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-envelope"></i> Contact Us</a>
                    </div>
                </li>
            </ul>
           <ul class="navbar-nav ml-auto">
    <?php if(isset($_SESSION['nama'])): ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false""><i class="fas fa-user"></i>
              <?=$_SESSION['nama']?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="../sidebar/api_side.php"><i class="fas fa-tachometer-alt"></i> Panel</a>
              <a class="dropdown-item" href="../login_api/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </li>
    <?php else: ?>
        <li class="nav-item">
            <a href="../login_api/login.php">
                <button class="btn btn-outline-danger rounded-pill order-0" type="submit">Sign in</button>
            </a>
        </li>
    <?php endif; ?>
</ul>

        </div>
    </div>
</nav>
<!-----navbar end------------------>

		<div class="container d-md-flex align-items-stretch">
      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
    <h2 class="mb-4">API Key</h2>
    <p>Use this API Key to utilize LaslesAPI. For more information on how to use LaslesAPI, please read the <a href="doc.php">documentation.</a></p><br>
    <div class="container bg-light border rounded text-center py-4 px-3">
        <p class="text-danger display-6">
            <?php echo $_SESSION['key_token']; ?>
        </p>
    </div>
     <p class="text-warning text-center">Warning: Your API key functions like a username and password. Keep your API key safe!</p>
     <h5 class="mb-2">Tips:</h5>
     <p>If you believe your API Key has been compromised, please change your API Key using the button below</p>
     <button class="btn btn-danger">Change API Key</button>
</div>

      <nav id="sidebar">
				<div class="p-4 pt-5">
	        <ul class="list-unstyled components mb-5">
	          <li>
	            <a href="#" data-toggle="collapse" aria-expanded="false" class="display-7">Profil</a>
	          <li>
	            <a href="#" data-toggle="collapse" aria-expanded="false" class="display-7 active-link text-danger">API Key</a>
	          </li>
	          <li>
	            <a href="#" data-toggle="collapse" aria-expanded="false" class="display-7">Change API Key</a>
	          </li>
	          <li>
	            <a href="#" data-toggle="collapse" aria-expanded="false" class="display-7">Delete Account</a>
	          </li>
	        </ul>

			<div class="mb-5">
            <div class="tagcloud">
              <a href="#" class="tag-cloud-link">API</a>
              <a href="#" class="tag-cloud-link">Task</a>
              <a href="#" class="tag-cloud-link">Standardization</a>
              <a href="#" class="tag-cloud-link">Abstraction</a>
              <a href="#" class="tag-cloud-link">Service</a>
              <a href="#" class="tag-cloud-link">Availability</a>
              <a href="#" class="tag-cloud-link">Division</a>
              <a href="#" class="tag-cloud-link">Communication</a>
            </div>
					</div>
					<div class="mb-5">
	        	<h5>Newsletter</h5>
						<form action="#" class="subscribe-form">
	            <div class="form-group d-flex">
	            	<div class="icon"><span class="icon-paper-plane"></span></div>
	              <input type="text" class="form-control" placeholder="Enter Email Address">
	            </div>
	          </form>
					</div>
	      </div>
    	</nav>
		</div>

    <section class="bg-light py-5">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <img src="../public/assets/img/icons/logo.png" alt="" width="30" class="d-inline-block align-middle">
                    <span class="d-inline-block text-1000 fs-1 ms-2 fw-medium lh-base mx-2">Lasles<span class="fw-bold">API</span></span>
                </a>
                <p class="my-3"> <span class="fw-medium">LaslesAPI </span>is a private virtual network that<br />has unique features and has high security. </p>
                <ul class="list-unstyled list-inline">
                    <li class="list-inline-item"><a href="#" class="text-decoration-none">
                        <svg class="bi bi-facebook" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F53838" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                        </svg></a>
                    </li>
                    <li class="list-inline-item"><a href="#">
                        <svg class="bi bi-twitter" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F53838" viewBox="0 0 16 16">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
                        </svg></a>
                    </li>
                    <li class="list-inline-item"><a href="#">
                        <svg class="bi bi-instagram" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F53838" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"> </path>
                        </svg></a>
                    </li>
                </ul>
                <p class="text-muted my-3">&copy; 2024 LaslesAPI</p>
            </div>
            <div class="col-6 col-sm-4 col-lg-3 mb-3">
                <h5 class="lh-lg">Product</h5>
                <ul class="list-unstyled mb-md-4 mb-lg-0">
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">Download</a></li>
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">Pricing</a></li>
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">Locations</a></li>
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">Server</a></li>
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">Countries</a></li>
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">Blog</a></li>
                </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-3 mb-3">
                <h5 class="lh-lg">Engage</h5>
                <ul class="list-unstyled mb-md-4 mb-lg-0">
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">LaslesAPI ?</a></li>
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">FAQ</a></li>
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">Tutorials</a></li>
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">About Us</a></li>
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">Privacy Policy </a></li>
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">Terms of Service</a></li>
                </ul>
            </div>
            <div class="col-12 col-sm-4 col-lg-2 mb-3 ps-xxl-7 ps-xl-5">
                <h5 class="lh-lg">Earn Money</h5>
                <ul class="list-unstyled mb-md-4 mb-lg-0">
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">Affiliate</a></li>
                    <li class="lh-lg"><a href="#" class="text-dark text-decoration-none">Become Partner</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end of .container-->

</section>


    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>