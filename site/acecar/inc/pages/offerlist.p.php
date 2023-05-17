<?php

    if(isset($_GET['save'])){
        $qeury="select * from `vehicule` where `";
        if(isset($_GET['tip'])){
            $tips = $_GET['tip'];
            foreach($tips as $key => $value){
                echo "<br>".$value;
            }
        }
        
        
    }
?>

<div class="row position-products pt-5">
            <div class="col-lg-3 py-2">
                <div class="card">
                    <div class="card-body">
                        <form method="GET">
                            <div class="orange text-end font-bold2">
                                Reset filtre
                            </div>
                            <h5 class="card-title pt-2">Tip vehicul</h5>
                            <?php
                                try {
                                    $qq = Config::$g_con->prepare('SELECT * FROM `categorie_vehicule` ORDER BY `ID` ASC');
                                    $qq->execute();
                                    while ($q = $qq->fetch(PDO::FETCH_OBJ)) {
                                        echo '<div class="form-check">
                                                <div class="ps-2">
                                                    <input class="form-check-input" type="checkbox" name="tip[]" value="'.$q->Nume.'" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">'.$q->Nume.'</label>s
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
                                <input name="automata" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            </div>
                            <hr>

                            <h5 class="card-title pt-2">Numar pasageri</h5>
                            <input type="range" name="pasageri" class="form-range" min="2" max="8" step="1" id="customRange3" oninput="num.value = this.value" value="5">
                            <div class="text-center">
                                <output id="num">5</output>
                                pasageri
                            </div>
                            <hr>
                            
                            <h5 class="card-title pt-2">Numar bagaje</h5>
                            <input type="range" name="bagaje" class="form-range" min="1" max="4" step="1" id="customRange3" oninput="bags.value = this.value" value="2">
                            <div class="text-center">
                                <output id="bags">2</output>
                                bagaje
                            </div>
                            <div class="d-grid gap-2 pt-4">
                                <button class="btn btn-success" name="save" type="submit">Aplica filtre</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <?php
                        try {
                            $qq = Config::$g_con->prepare('SELECT * FROM `vehicule` ORDER BY `ID` ASC');
                            $qq->execute();
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
                                        <h5 class="orange font-bold">Lei '.$q->Pret.' / zi</h5>
                                        <h6 >$170 / total</h6>
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