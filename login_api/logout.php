<?php

    session_start();

    //hapus semua session variabel
    session_unset();

    //destroy untuk session
    session_destroy();
    // header('Location: ../public/index.php')
    header('Location: login.php');
?>