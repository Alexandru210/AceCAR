<?php
    if(isset($_GET['search'])){
        if(isset($_GET['ridicare']) && !empty($_GET['ridicare']) && 
        isset($_GET['returnare']) && !empty($_GET['returnare']) && 
        isset($_GET['start']) && !empty($_GET['start']) && 
        isset($_GET['end']) && !empty($_GET['end']))
        {
            $ridicare = Config::protect($_GET['ridicare']);
            $returnare = Config::protect($_GET['returnare']);
            $start = $_GET['start'];
            $end = $_GET['end'];
            echo $end;
            if(strtotime($start) > strtotime($end)){
                Config::createNotifAndRedirect(1,"Cautare", "Ai introdus o perioada invalida!","error","bg-danger","");
                return;
            }
            if(time() - strtotime($start) > 1209600){
                Config::createNotifAndRedirect(1,"Cautare", "Nu poti inchiria un vehicul cu mai mult de 14zile inainte!","error","bg-danger","");
                return;
            }
            if(strtotime($start) - strtotime($end) > 2592000){
                Config::createNotifAndRedirect(1,"Cautare", "Nu poti inchiria un vehicul mai mult de 30 de zile!","error","bg-danger","");
                return;
            }
            Config::createNotifAndRedirect(0,"", "","","","offerlist?ridicare=".$ridicare."&returnare=".$returnare."&start=".$start."&end=".$end);
            return;
            
        } else {
            Config::createNotifAndRedirect(1,"Cautare", "Ai lasat campuri libere","error","bg-danger","");
            return;
        }
    }
?>
<!-- cover / image info -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/background.webp" class="d-block w-100" height="600px" style="object-fit: cover;" alt="...">
            <div class="carousel-caption position-top">
                <div class="card col-lg-12 text-start text-black pe-3">
                    <div class="card-body">
                        <h5 class="card-title px-3 font-bold">Inchiriaza o masina</h5>
                        <form method="GET">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="exampleFormControlInput1" class="form-label">Ridicare</label>
                                            <select class="form-select" name="ridicare" aria-label="Default select example">
                                                <option disabled hidden selected>Alege o locatie</option>
                                                <?php
                                                    try {
                                                        $qq = Config::$g_con->prepare('SELECT * FROM `filiale` ORDER BY `Oras` ASC');
                                                        $qq->execute();
                                                        while ($q = $qq->fetch(PDO::FETCH_OBJ)) {
                                                            echo '<option value="'.$q->ID.'">'.$q->Oras.'</option>';
                                                        }
                                                        
                                                    } catch (throwable $eroare) {
                                                        print($eroare);
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="exampleFormControlInput1" class="form-label">Returnare</label>
                                            <select class="form-select" name="returnare" aria-label="Default select example">
                                                <option disabled hidden selected>Alege o locatie</option>
                                                <?php
                                                    try {
                                                        $qq = Config::$g_con->prepare('SELECT * FROM `filiale` ORDER BY `Oras` ASC');
                                                        $qq->execute();
                                                        while ($q = $qq->fetch(PDO::FETCH_OBJ)) {
                                                            echo '<option value="'.$q->ID.'">'.$q->Oras.'</option>';
                                                        }
                                                        
                                                    } catch (throwable $eroare) {
                                                        print($eroare);
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <label for="exampleFormControlInput1" class="form-label">De la data</label>
                                    <input type="date" name="start" class="form-control" id="exampleFormControlInput1" placeholder="Locatie...">
                                </div>
                                <div class="col-lg-2">
                                    <label for="exampleFormControlInput1" class="form-label">Pana la data</label>
                                    <input type="date" name="end" class="form-control" id="exampleFormControlInput1" placeholder="Locatie...">
                                </div>
                                <div class="card col-lg-2" style="border: none;">
                                    <button type="submit" name="search" class="btn btn-primary btn-lg">Verifica!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="col-lg-12 text-white pe-3">
                    <div class="row">
                        <div class="col-lg-3">
                            <h5>10+ orase</h5>
                            <p>Peste 10 locatii de unde se pot inchiria</p>
                        </div>
                        <div class="col-lg-3">
                            <h5>Premium si Sport</h5>
                            <p>Detinem un numar mare de masini premium si sport.</p>
                        </div>
                        <div class="col-lg-3">
                            <h5>Masini noi</h5>
                            <p>Avem o gama variata de masini noi</p>
                        </div>
                        <div class="col-lg-3">
                            <h5>Totul digital</h5>
                            <p>Iti facem viata mai usoara prin digitalizare.</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!-- products -->
<div class="text-dark text-center fs-2 font-bold pt-4">
    SIXT car rental deals and products
</div>
<div class="row position-products pt-4">
    <div class="col-lg-4">
        <div class="card" style="border: none;">
            <img src="images/car1.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card" style="border: none;">
            <img src="images/car1.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card" style="border: none;">
            <img src="images/car1.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="text-dark text-center fs-2 font-bold py-4">
        Unde ne puteti gasi?
    </div>
    <div class="col-lg-12 text-center">
        <img src="images/locatii.png" alt="error" height="500">
    </div>
