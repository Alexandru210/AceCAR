<?php

    if(!defined('acecar'))
        die('Nope');

    if(!Config::isConnected()){
        Config::createNotifAndRedirect(0,"", "","","","");
        return;
    }

    if(isset($_POST['save'])){
        //setari profil
        $nume = Config::protect($_POST['nume']);
        $prenume = Config::protect($_POST['prenume']);
        $cnp = Config::protect($_POST['cnp']);
        $username = Config::protect($_POST['username']);
        $email = Config::protect($_POST['email']);
        $telefon = Config::protect($_POST['telefon']);
        $nastere = Config::protect($_POST['nastere']);
        
        //setari adresa
        $tara = Config::protect($_POST['tara']);
        $judet = Config::protect($_POST['judet']);
        $localitate = Config::protect($_POST['localitate']);
        $strada = Config::protect($_POST['strada']);
        $numar = Config::protect($_POST['numar']);
        $bloc = Config::protect($_POST['bloc']);
        $scara = Config::protect($_POST['scara']);
        $apartament = Config::protect($_POST['apartament']);

        try {
            $qq = Config::$g_con->prepare('UPDATE `clienti` SET `Nume` = ?, `Prenume` = ?, `CNP` = ?, `Username` = ?, `Email` = ?, `Telefon` = ?, `Data_nasterii` = ? WHERE `ID` = ?');
            $qq->execute(array($nume, $prenume, $cnp, $username, $email, $telefon, $nastere, $_SESSION['isUserID']));

            $qq = Config::$g_con->prepare('UPDATE `adrese` SET `Tara` = ?, `Judet` = ?, `Localitate` = ?, `Strada` = ?, `Numar` = ?, `Bloc` = ?, `Scara` = ?, `Apartament` = ? WHERE `ID_Client` = ?');
            $qq->execute(array($tara, $judet, $localitate, $strada, $numar, $bloc, $scara, $apartament, $_SESSION['isUserID']));
            
        } catch (throwable $eroare) {
            print($eroare);

        } finally {
            Config::createNotifAndRedirect(1,"Felicitari!", "Ai actualizat cu succes setarile.","success","bg-success","settings");
            return;
        }

        Config::createNotifAndRedirect(1,"Oops.. Eroare!", "Ceva nu mers bine, te rugam sa incerci mai tarziu","error","bg-error","settings");
        return;
    }

?>
<div class="row position-products pt-5">
    <?php
        try {
            $qq = Config::$g_con->prepare('SELECT * FROM `clienti` WHERE `ID` = ?');
            $qq->execute(array($_SESSION['isUserID']));
            while ($q = $qq->fetch(PDO::FETCH_OBJ)) {
                $qq1 = Config::$g_con->prepare('SELECT * FROM `adrese` WHERE `ID_Client` = ?');
                $qq1->execute(array($_SESSION['isUserID']));
                $q1 = $qq1->fetch(PDO::FETCH_OBJ);
    ?>

                <div class="col-lg-3 py-2">
                    <div class="card">
                        <div class="card-body">
                            <img src="<?php echo $q->Imagine; ?>" width="125px" style="display: block; margin-left: auto; margin-right: auto; border-radius: 50%" alt="error img">
                            <h5 class="card-title pt-2 text-center"><?php echo $q->Username; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 py-2">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h5 class="card-title pt-2">Setari profil</h5>
                                        <hr>
                                        <label class="form-label pt-2">Nume</label>
                                        <input type="text" name="nume" class="form-control" value="<?php echo $q->Nume; ?>">
                                        <label class="form-label pt-2">Prenume</label>
                                        <input type="text" name="prenume" class="form-control" value="<?php echo $q->Prenume; ?>">
                                        <label class="form-label pt-2">CNP</label>
                                        <input type="text" name="cnp" class="form-control" value="<?php echo $q->CNP; ?>">
                                        <label class="form-label pt-2">Username</label>
                                        <input type="text" name="username" class="form-control" value="<?php echo $q->Username; ?>">
                                        <label class="form-label pt-2">Email</label>
                                        <input type="email" name="email" class="form-control" value="<?php echo $q->Email; ?>">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="form-label pt-2">Telefon</label>
                                                <input type="text" name="telefon" class="form-control" value="ShoKarON">
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="form-label pt-2">Data nasterii</label>
                                                <input type="date" name="nastere" class="form-control" value="2020-07-27">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5 class="card-title pt-2">Setari adresa</h5>
                                        <hr>
                                        <label class="form-label pt-2">Tara</label>
                                        <input type="text" name="tara" class="form-control" value="<?php echo $q1->Tara; ?>">
                                        <label class="form-label pt-2">Judet</label>
                                        <input type="text" name="judet" class="form-control" value="<?php echo $q1->Judet; ?>">
                                        <label class="form-label pt-2">Localitate</label>
                                        <input type="text" name="localitate" class="form-control" value="<?php echo $q1->Localitate; ?>">
                                        <label class="form-label pt-2">Strada</label>
                                        <input type="text" name="strada" class="form-control" value="<?php echo $q1->Strada; ?>">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="form-label pt-2">Numar</label>
                                                <input type="text" name="numar" class="form-control" value="<?php echo $q1->Numar; ?>">
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="form-label pt-2">Bloc</label>
                                                <input type="text" name="bloc" class="form-control" value="<?php echo $q1->Bloc; ?>">
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="form-label pt-2">Scara</label>
                                                <input type="text" name="scara" class="form-control" value="<?php echo $q1->Scara; ?>">
                                            </div>
                                        </div>
                                        <label class="form-label pt-2">Apartament</label>
                                        <input type="text" name="apartament" class="form-control" value="<?php echo $q1->Apartament; ?>">
                                    </div>
                                </div>
                                <div class="pt-2">
                                    <button type="submit" name="save" class="btn btn-success" style="float:right">Salveaza</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    <?php 
            }
            
        } catch (throwable $eroare) {
            print($eroare);
        }
    ?>