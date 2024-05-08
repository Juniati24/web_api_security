<?php
session_start();

if(isset($_SESSION['id_user'])){
    header('Location: ../public/index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LaslesAPI | Sign in</title>


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


    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>
    <div class="container-fluid ">
        <div class="container ">
            <div class="row cdvfdfd">
                <div class="col-lg-10 col-md-12 login-box">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 log-det">
                            <div class="small-logo">
                                <img src="../public/assets/img/icons/logo.png" alt="" class="mr-2" width="30" /><span>LaslesAPI</span>
                            </div>
                            <p class="dfmn">Sign in </p>
                             <div class="text-box-cont">

                               <form action="login_aksi.php" method="post">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="nama">
                                </div>
                                <div class="input-group center">
                                <button type="submit" class="btn btn-danger btn-round">SIGN IN</button>
                                </div>
                                </form>

                                <div class="row">
                                    <p class="forget-p">Don't have an account? <span>Sign Up Now</span></p>
                                </div>
                                 <div class="row">
                                    <p class="small-info">Connect With Social Media</p>
                               </div>   
                            </div>

                            <div class="row">
                                <ul>
                                    <li><i class="fab fa-facebook-f"></i></li>
                                    <li><i class="fab fa-twitter"></i></li>
                                    <li><i class="fab fa-linkedin-in"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 box-de">
                           <div class="inn-cover">
                               <div class="ditk-inf">
                                    <h2 class="w-100">Din't Have an Account </h2>
                                    <a href="register.php">
                                    <button type="button" class="btn btn-outline-light">SIGN UP</button>
                                    </a>
                                </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/script.js"></script>


</html>

