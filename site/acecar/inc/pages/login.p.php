<?php
    if(!defined('acecar'))
        die('Nope');

    if(Config::isConnected()){
        Config::createNotifAndRedirect(0,"", "","","","");
        return;
    }

    // create Client Request to access Google API
    $client = new Google_Client();
    $client->setClientId(Config::$clientID);
    $client->setClientSecret(Config::$clientSecret);
    $client->setRedirectUri(Config::$redirectUri);
    $client->addScope("email");
    $client->addScope("profile");

    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);
    
        // get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $userinfo = [
        'email' => $google_account_info['email'],
        'full_name' => $google_account_info['name'],
        'picture' => $google_account_info['picture'],
        'token' => $google_account_info['id'],
        ];
    
        $q = Config::$g_con->prepare('SELECT * FROM `clienti` where `email` = ?');
        $q->execute(array($userinfo['email']));
        if($q->rowCount()){ // este in baza de date
            $qq = $q->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['isUserID'] = $qq['ID'];
            Config::createNotifAndRedirect(1,"Autentificare", "Te-ai conectat cu succes!","success","bg-success","");
            return;
        } else { // nu este in baza de date
            // insert in DB
            $q = Config::$g_con->prepare("INSERT INTO clienti (`accGoogle`, `Nume`, `Prenume`, `Username`, `Imagine`, `Parola`, `Email`, `Data_nasterii`, `CNP`, `Telefon`, `Prima_conectare`, `Ultima_Conectare`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
            $q->execute(array($userinfo['token'], $userinfo['full_name'], '', '', $userinfo['picture'], '', $userinfo['email'], 0, '', '', time(), time()));

            //select DB
            $q = Config::$g_con->prepare('SELECT * FROM `clienti` where `accGoogle` = ?');
            $q->execute(array($userinfo['token']));
            $qq = $q->fetch(PDO::FETCH_ASSOC);
            
            $_SESSION['isUserID'] = $qq['ID'];
            Config::createNotifAndRedirect(1,"Autentificare", "Te-ai conectat cu succes!","success","bg-success","");
            return;
        }
    }

    if(isset($_POST['submit_create_acc'])){
        Config::createNotifAndRedirect(0,"", "","","","");
        return;
    } else if(isset($_POST['submit_login_default'])) {
        if(!empty($_POST['username']) && !empty($_POST['password'])){
            //ssecuritate SQL
            $username = Config::protect($_POST['username']);
            $password = Config::protect($_POST['password']);
            //criptam parola
            $cryptpass= hash('whirlpool',$password);
            $cryptpass= strtoupper($cryptpass);

            try {
                $qq = Config::$g_con->prepare('SELECT * FROM `clienti` where `Username` = ? AND `Parola` = ?');
                $qq->execute(array($username,$cryptpass));
                if($qq->rowCount()){
                    while ($q = $qq->fetch(PDO::FETCH_ASSOC)) {
                        $_SESSION['isUserID'] = $q['ID'];
                        try {
                            $qq = Config::$g_con->prepare('UPDATE `clienti` SET `Ultima_conectare` = ? WHERE `ID` = ?');
                            $qq->execute(array(time(), $q['ID']));
                        } catch (throwable $eroare) {
                            print($eroare);
                        } finally {
                            Config::createNotifAndRedirect(1,"Autentificare", "Te-ai conectat cu succes!","success","bg-success","");
                            return;
                        }
                        
                    }
                } else {
                    Config::createNotifAndRedirect(1,"Autentificare", "Datele introduse sunt incorecte","error","bg-danger","login");
                    return;
                }
                
            } catch (throwable $eroare) {
                print($eroare);
            }

        } else {
            Config::createNotifAndRedirect(1,"Autentificare", "Ai lasat campuri libere","error","bg-danger","login");
            return;
        }

    } else if(isset($_POST['submit_login_gmail'])) {
        $client->createAuthUrl();
        echo '<script>location.replace("'.$client->createAuthUrl().'")</script>';
        return;
    }
?>
<style>
    body {
        background: url(images/login_bg.png);
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }
    .center-card{
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<div class="center-card pt-5">
    <div class="col-lg-3">
        <div class="card text-bg-dark">
            <div class="card-body">
                <form method="POST">
                    <h5 class="card-title text-center pt-2">AceCar - Autentificare</h5>
                    <div class="d-grid gap-2 pt-3+">
                        <button class="btn btn-danger" type="submit" name="submit_login_gmail"><i class="fa fa-google" style="float:left; font-size: 25px;"></i> Conectare cu Gmail</button>
                    </div>
                    <div class="text-center py-2">- OR -</div>
                    <label class="form-label">Nume de utilizator</label>
                    <input type="name" name="username" class="form-control" placeholder="Introdu numele">
                    <label class="form-label pt-3">Parola</label>
                    <input type="password" name="password" class="form-control" placeholder="Introdu parola">
                    <div class="d-grid gap-2 pt-4">
                        <button class="btn btn-success" type="submit" name="submit_login_default">Conectare</button>
                        <button class="btn btn-primary" type="submit" name="submit_create_acc" >Creeaza cont</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>