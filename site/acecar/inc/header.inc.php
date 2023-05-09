<?php
    ob_start();

    if(!defined('acecar'))
        die('Nope.');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/style.css" rel="stylesheet">
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="https://kit.fontawesome.com/c48292ea05.js" crossorigin="anonymous"></script>
        <title>AceCAR - Inchirieri masini</title>
        <!-- <link rel="icon" type="image/x-icon" href="images/icon-acemag.ico"> -->
    </head>
    <body>
        
        <!-- navbar / top bar -->
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid px-5">
                <a class="navbar-brand" href="#">AceCAR</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-dark fs-5" href="rent.html">Inchiriaza</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark fs-5" href="share.html">Locatii</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark fs-5" href="subscription.html">AceCAR+ <font class="font-normal fs-6">Subscriptie</font></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-dark px-2" href="rent.html" ><i class="fa fa-car text-dark" width="20px"></i> Rezervari</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark px-2" href="<?php echo Config::$_PAGE_URL; ?>login"><i class="fa fa-right-to-bracket text-dark" width="20px"></i> Autentificare | Inregistrare</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>