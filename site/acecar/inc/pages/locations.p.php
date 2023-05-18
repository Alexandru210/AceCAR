<div class="text-dark text-center fs-2 font-bold pt-4">Locatiile unde ne puteti gasi:</div>
<div class="row position-products pt-4">
    <?php
        try {
            $qq = Config::$g_con->prepare('SELECT * FROM `filiale` ORDER BY `Oras` ASC');
            $qq->execute();
            while ($q = $qq->fetch(PDO::FETCH_OBJ)) {
                echo '<div class="col-lg-3 pb-4">
                        <div class="card" style="border: none;">
                            <img src="images/filiale/'.$q->Imagine.'" class="card-img-top" height="200px" style="object-fit: cover" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">'.$q->Oras.'</h5>
                                <p class="card-text">Adresa: '.$q->Adresa.'<br>Telefon: '.$q->Telefon.'</p>
                                <p class="card-text">'.$q->Descriere.'</p>
                                <a href="'.Config::$_PAGE_URL.'offerlist" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Masini disponibile</a>
                            </div>
                        </div>
                    </div>';
                    }
            
        } catch (throwable $eroare) {
            print($eroare);
        }
    ?>
