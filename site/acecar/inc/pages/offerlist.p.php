<?php

    //setam valori default la variabilele necesare
    $query = "";
    $counter = 0;
    
    if(!isset($_GET['automata'])) $automata = 0;
    if(!isset($_GET['bagaje'])) $bagaje = 2;
    if(!isset($_GET['pasageri'])) $pasageri = 5;
    if(!isset($_GET['ridicare'])) $ridicare = 0;
    else $ridicare = $_GET['ridicare'];
    if(!isset($_GET['returnare'])) $returnare = 0;
    else $returnare = $_GET['returnare'];
    if(!isset($_GET['start'])) $start = date("Y-m-d",time());
    else $start = $_GET['start'];
    if(!isset($_GET['end'])) $end = date("Y-m-d",time());
    else $end = $_GET['end'];
    $perioada = (int)(strtotime($end) - strtotime($start)) / 86400 + 1;
    
    //salvam filtrele
    if(isset($_GET['save'])){
        $query="select * from `vehicule` where";
        if(isset($_GET['tip'])){
            $query = $query."(";
            $tips = $_GET['tip'];
            
            foreach($tips as $key => $value){
                if($counter)
                    $query = $query." OR ";
                $query = $query."`ID_Categorie` = ".$value;
                $counter++;
            }
            $query = $query.")";
        }

        if(isset($_GET['automata'])){
            if($counter)
                $query = $query." AND ";
            $counter++;
            $automata = 1;
            $query = $query." `Tip_cutie` = 'Automata'";
        }
        
        if(isset($_GET['bagaje'])){
            if($counter)
                $query = $query." AND ";
            $counter++;
            $bagaje = Config::protect($_GET['bagaje']);
            $bagaje = (int)$bagaje;
            $query = $query." `Nr_bagaje` >= ".$bagaje;
        }

        if(isset($_GET['pasageri'])){
            if($counter)
                $query = $query." AND ";
            $counter++;
            $pasageri = Config::protect($_GET['pasageri']);
            $pasageri = (int)$pasageri;
            $query = $query." `Nr_pasageri` = ".$pasageri;
        }

        if(isset($_GET['ridicare'])){
            if($counter)
                $query = $query." AND ";
            $counter++;
            $ridicare = Config::protect($_GET['ridicare']);
            $ridicare = (int)$ridicare;
            $query = $query." `ID_Filiala` = ".$ridicare;
        }

        if(!(isset($_GET['ridicare']) && !empty($_GET['ridicare']) && 
        isset($_GET['returnare']) && !empty($_GET['returnare']) && 
        isset($_GET['start']) && !empty($_GET['start']) && 
        isset($_GET['end']) && !empty($_GET['end'])))
        {
            Config::createNotifAndRedirect(1,"Cautare", "Nu ai selectat locatia si/sau perioada","error","bg-danger","offerlist");
            return;
        }
        if(strtotime($start) > strtotime($end)){
            Config::createNotifAndRedirect(1,"Cautare", "Ai introdus o perioada invalida!","error","bg-danger","offerlist");
            return;
        }
        if(time() - strtotime($start) > 1209600){
            Config::createNotifAndRedirect(1,"Cautare", "Nu poti inchiria un vehicul cu mai mult de 14zile inainte!","error","bg-danger","offerlist");
            return;
        }
        if(strtotime($start) - strtotime($end) > 2592000){
            Config::createNotifAndRedirect(1,"Cautare", "Nu poti inchiria un vehicul mai mult de 30 de zile!","error","bg-danger","offerlist");
            return;
        }
    }

    //facem rezervarea
    if(isset($_POST['rezerva'])){
        if(!(isset($_GET['ridicare']) && !empty($_GET['ridicare']) && 
        isset($_GET['returnare']) && !empty($_GET['returnare']) && 
        isset($_GET['start']) && !empty($_GET['start']) && 
        isset($_GET['end']) && !empty($_GET['end'])))
        {
            Config::createNotifAndRedirect(1,"Cautare", "Nu ai selectat locatia si/sau perioada","error","bg-danger","offerlist");
            return;
        }
        if(Config::isConnected()){
            
        } else {
            $_SESSION['url'] = Config::getUrl();
            Config::createNotifAndRedirect(1,"Autentificare", "Pentru a continua rezervarea trebuie sa te autentifici!","error","bg-danger","login");
            return;
        }
        
    }
    echo Config::getUrl();
?>

<div class="row position-products pt-5">
            <div class="col-lg-3 py-2">
                <div class="card">
                    <div class="card-body">
                        <form method="GET">
                            <div class="orange text-end font-bold2">
                                <a href="<?php echo Config::$_PAGE_URL; ?>offerlist" class="orange">Reset filtre</a>
                            </div>
                            <h5 class="card-title pt-2">Perioada</h5>
                            <label for="exampleFormControlInput1" class="form-label">Ridicare</label>
                            <select class="form-select" name="ridicare" aria-label="Default select example">
                                <?php
                                if(!$ridicare)
                                    echo '<option disabled hidden selected>Alege o locatie</option>';
                                else
                                    echo '<option value="'.$ridicare.'" selected>'.Config::getData("filiale","ID",$ridicare,"Oras").'</option>';
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
                            <label for="exampleFormControlInput1" class="form-label">Returnare</label>
                            <select class="form-select" name="returnare" aria-label="Default select example">
                                <?php
                                if(!$returnare)
                                    echo '<option disabled hidden selected>Alege o locatie</option>';
                                else
                                    echo '<option value="'.$returnare.'" selected>'.Config::getData("filiale","ID",$returnare,"Oras").'</option>';
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
                            <label for="exampleFormControlInput1" class="form-label">De la data</label>
                            <input type="date" name="start" class="form-control" value="<?php echo date("Y-m-d",strtotime($start)); ?>" id="exampleFormControlInput1" placeholder="Locatie...">
                            <label for="exampleFormControlInput1" class="form-label">Pana la data</label>
                            <input type="date" name="end" class="form-control" value="<?php echo date("Y-m-d",strtotime($end)); ?>" id="exampleFormControlInput1" placeholder="Locatie...">
                            <h5 class="card-title pt-2">Tip vehicul</h5>
                            <?php
                                try {
                                    $qq = Config::$g_con->prepare('SELECT * FROM `categorie_vehicule` ORDER BY `ID` ASC');
                                    $qq->execute();
                                    while ($q = $qq->fetch(PDO::FETCH_OBJ)) {
                                        $checked = "";
                                        if(isset($_GET['tip'])){
                                           $tips = $_GET['tip'];
                                            foreach($tips as $key => $value){
                                                if($value == $q->ID){
                                                    $checked = "checked";
                                                    break;
                                                }
                                            } 
                                        }
                                        
                                        echo '<div class="form-check">
                                                <div class="ps-2">
                                                    <input class="form-check-input" type="checkbox" name="tip[]" value="'.$q->ID.'" id="flexCheckDefault" '.$checked.'>
                                                    <label class="form-check-label" for="flexCheckDefault">'.$q->Nume.'</label>
                                                </div>
                                            </div>';
                                            }
                                } catch (throwable $eroare) {
                                    print($eroare);
                                }
                            ?>
                            <hr>
                            <h5 class="card-title pt-2">Doar automata</h5>
                            <div class="form-check form-switch">
                                <input name="automata" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" <?php if($automata) echo "checked"; ?>>
                            </div>
                            <hr>

                            <h5 class="card-title pt-2">Numar pasageri</h5>
                            <input type="range" name="pasageri" class="form-range" min="2" max="8" step="1" id="customRange3" oninput="num.value = this.value" value="<?php echo $pasageri; ?>">
                            <div class="text-center">
                                <output id="num"><?php echo $pasageri; ?></output>
                                pasageri
                            </div>
                            <hr>
                            
                            <h5 class="card-title pt-2">Numar bagaje</h5>
                            <input type="range" name="bagaje" class="form-range" min="1" max="4" step="1" id="customRange3" oninput="bags.value = this.value" value="<?php echo $bagaje; ?>">
                            <div class="text-center">
                                <output id="bags"><?php echo $bagaje; ?></output>
                                bagaje
                            </div>
                            <div class="d-grid gap-2 pt-4">
                                <button class="btn btn-success" name="save" type="submit" value="yes">Aplica filtre</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <?php
                        try {
                            if(!$query)
                                $qq = Config::$g_con->prepare('SELECT * FROM `vehicule` ORDER BY `ID` ASC');
                            else
                                $qq = Config::$g_con->prepare($query);
                            $qq->execute();
                            if(!$qq->rowCOunt()){
                                echo '<div class="alert alert-danger" role="alert">
                                        Nu s-a gasit niciun vehicul disponibil sau dupa criteriile selectate!
                                        <div class="font-bold2">
                                            <a href="'.Config::$_PAGE_URL.'offerlist" class="orange">Reset filtre</a>
                                        </div>
                                    </div>';
                            }
                            while ($q = $qq->fetch(PDO::FETCH_OBJ)) {
                                echo '<div class="col-lg-4 py-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title pt-2">'.$q->Marca.' '.$q->Model.'</h5>
                                        <div class="text-muted">or similar | Sedan</div>
                                        <img class="" src="images/cars/'.$q->Imagine.'" width="100%">
                                        
                                        <div class="row text-center text-muted">
                                            <div class="col-lg-3">
                                                <i class="fa-solid fa-users" width="20px"></i><br> '.$q->Nr_usi.'locuri
                                            </div>
                                            <div class="col-lg-3">
                                                <i class="fa-solid fa-gear" width="20px"></i><br> '.$q->Tip_cutie.'
                                            </div>
                                            <div class="col-lg-3">
                                                <i class="fa-solid fa-gauge" width="20px"></i><br> '.$q->Km.'km
                                            </div>
                                            <div class="col-lg-3 cursor-pointer">
                                                <a data-bs-toggle="modal" data-bs-target="#Modal'.$q->ID.'"><i class="fa-solid fa-ellipsis" width="20px"></i><br>detalii</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5 class="orange font-bold">Lei '.$q->Pret.' / zi</h5>
                                                <h6 >Lei '.$perioada * $q->Pret.' / total</h6>
                                            </div>
                                            <div class="col-lg-6">
                                                <form method="POST">
                                                     <button type="submit" name="rezerva" value="'.$q->ID.'" style="float: right" class="btn btn-primary"><i class="fa fa-cart-shopping"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                       
                                        
                                    </div>
                                </div>
                                <div class="modal fade" id="Modal'.$q->ID.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel">Informatii - Opel Corsa</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="font-bold">Detalii vehicul:</div>
                                            <div class="ps-2">
                                                <div class="display-inline font-bold2">Motorizare:</div> '.$q->Motorizare.'
                                                <br>
                                                <div class="display-inline font-bold2">Numar pasageri:</div> '.$q->Nr_pasageri.'
                                                <br>
                                                <div class="display-inline font-bold2">Numar bagaje:</div> '.$q->Nr_bagaje.'
                                                <br>
                                                <div class="display-inline font-bold2">Combustibil:</div> '.$q->Carburant.'
                                                <br>
                                                <div class="display-inline font-bold2">Numar km fara plata:</div> '.$q->Km.'
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Inchide</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>';
                                    }
                            
                        } catch (throwable $eroare) {
                            print($eroare);
                        }
                    ?>
                </div>
            </div>