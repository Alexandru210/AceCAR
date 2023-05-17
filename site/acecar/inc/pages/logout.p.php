<?php
    if(!defined('acecar'))
        die('Nope');

    unset($_SESSION['isUserID']);

    Config::createNotifAndRedirect(1,"Deconectare", "Te-ai deconectat cu succes!","success","bg-success","");
    return;
?>