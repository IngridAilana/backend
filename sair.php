<?php

    session_start();
    require_once 'config.php';
    session_destroy(); 
    session_start();
    $_SESSION['mensagem'] = 'Deslogado com sucesso';
    header('location: loginusu.php');
?>