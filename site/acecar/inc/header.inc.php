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
        <script src="assets/notification.js"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="https://kit.fontawesome.com/c48292ea05.js" crossorigin="anonymous"></script>
        <title>AceCAR - Inchirieri masini</title>
        <!-- <link rel="icon" type="image/x-icon" href="images/icon-acemag.ico"> -->
        
    </head>
    <body>
        <!-- afisare notif -->
        <?php
            if(isset($_SESSION['notif_show']) && !empty($_SESSION['notif_show']) && $_SESSION['notif_show'] == 1){
                echo $_SESSION['notif_message'];
                echo '<script> showNotif() </script>';
                $_SESSION['notif_message'] = '';
                $_SESSION['notif_show'] = 0;
            }
        ?>
        <!-- navbar / top bar -->
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid px-5">
                <a class="navbar-brand" href="<?php echo Config::$_PAGE_URL; ?>">AceCAR</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-dark fs-5" href="<?php echo Config::$_PAGE_URL; ?>offerlist">Inchiriaza</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark fs-5" href="<?php echo Config::$_PAGE_URL; ?>locations">Locatii</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-dark px-2" href="rent.html" ><i class="fa fa-car text-dark" width="20px"></i> Rezervari</a>
                        </li>
                        <?php 
                            if(Config::isConnected()){
                        ?>                        
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo Config::formatName(); ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="<?php echo Config::$_PAGE_URL; ?>settings">Setari</a></li>
                                    <li><a class="dropdown-item" href="<?php echo Config::$_PAGE_URL; ?>logout">Deconectare</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link text-dark px-2" href="<?php echo Config::$_PAGE_URL; ?>login"><i class="fa fa-right-to-bracket text-dark" width="20px"></i> Autentificare | Inregistrare</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>