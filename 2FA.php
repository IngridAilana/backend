<?php

session_start();
require_once 'config.php';

$rand = rand(1, 5);
     

switch ($rand): 
    case 1:
        echo "<form method='post' action='2FA.php'>";
        echo "<h2>Insira os 3 ULTIMOS digitos do CPF cadastrado</h2><br>";
        echo "<input type='text' name='cpf3U'>";
        echo "<input type='submit'  name='btn2FA' value='Verificar'>";
        echo "</form>";
        break;
    case 2:
        echo "<form method='post' action='2FA.php'>";
        echo "<h2>Insira os 3 PRIMEIROS digitos do CPF cadastrado</h2><br>";
        echo "<input type='text' name='cpf3P'>";
        echo "<input type='submit'  name='btn2FA' value='Verificar'>";
        echo "</form>";
        break;
    case 3:
        echo "<form method='post' action='2FA.php'>";
        echo "<h2>Insira o  telefone celular cadastrado</h2><br>";
        echo "<input type='text' name='celular'>";
        echo "<input type='submit'  name='btn2FA' value='Verificar'>";
        echo "</form>";
        break;
    case 4:
        echo "<form method='post' action='2FA.php'>";
        echo "<h2>Insira o nome da Mãe conforme foi preenchido no cadastrado</h2><br>";
        echo "<input type='text' name='mae'>";
        echo "<input type='submit'  name='btn2FA' value='Verificar'>";
        echo "</form>";
        break;
    case 5:
        echo "<form method='post' action='2FA.php'>";
        echo "<h2>Insira a sua data de nascimento</h2><br>";
        echo "<input type='date' name='nasc'>";
        echo "<input type='submit'  name='btn2FA' value='Verificar'>";
        echo "</form>";
        break;
endswitch;
$btn2FA = filter_input(INPUT_POST, 'btn2FA', FILTER_SANITIZE_STRING);
if ($btn2FA) {


    $cpf3U = filter_input(INPUT_POST, 'cpf3U', FILTER_SANITIZE_STRING);
    $cpf3P = filter_input(INPUT_POST, 'cpf3P', FILTER_SANITIZE_STRING);
    $cell = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRING);
    $mae = filter_input(INPUT_POST, 'mae', FILTER_SANITIZE_STRING);
    $nasc = filter_input(INPUT_POST, 'nasc', FILTER_SANITIZE_STRING);


    $rowCPF3P = substr($_SESSION['CPF'], 0, 3);
    $rowCPF3U = substr($_SESSION['CPF'], -3);

    $sql = "SELECT * FROM usuarios WHERE ID_USU = '" . $_SESSION['ID_USU'] . "'"; 
    $resultperfil = mysqli_query($conexao, $sql);
    $rowperfil = mysqli_fetch_array($resultperfil);

    if ($rowperfil['ID_PERFIL'] == "A") {
        if (isset($mae)) {
            if ($mae === $_SESSION['NOME_MAE']) {
                $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'NOME_MAE', 'ON','" . $_SESSION['ID_USU'] . "')";
                $result = mysqli_query($conexao, $sql);
                header('location:telaadm.php');  
            } else {
                $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'NOME_MAE', 'OFF','" . $_SESSION['ID_USU'] . "')";
                $result = mysqli_query($conexao, $sql);
                $_SESSION['mensagem'] = "Verificação de duas etapas falhou, tente logar novamente";
                header("Location:loginadm.php");
            }
        }
        if (isset($nasc)) {
            if ($nasc === $_SESSION['DT_NASC']) {
                $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'DT_NASC', 'ON','" . $_SESSION['ID_USU'] . "')";
                $result = mysqli_query($conexao, $sql);
                header('location:telaadm.php');
            } else {
                $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'DT_NASC', 'OFF','" . $_SESSION['ID_USU'] . "')";
                $result = mysqli_query($conexao, $sql);
                $_SESSION['mensagem'] = "Verificação de duas etapas falhou, tente logar novamente";
                header("Location:loginadm.php");
            }
        }
        if (isset($cell)) {
            if ($cell === $_SESSION['CELULAR']) {
                $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'CELL', 'ON','" . $_SESSION['ID_USU'] . "')";
                $result = mysqli_query($conexao, $sql);
                header('location:telaadm.php');
            } else {
                $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'CELL', 'OFF','" . $_SESSION['ID_USU'] . "')";
                $result = mysqli_query($conexao, $sql);
                $_SESSION['mensagem'] = "Verificação de duas etapas falhou, tente logar novamente";
                header("Location:loginadm.php");
            }
        }
        if (isset($cpf3P)) {
            if ($cpf3P === $rowCPF3P) {
                $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'CPF3P', 'ON','" . $_SESSION['ID_USU'] . "')";
                $result = mysqli_query($conexao, $sql);
                header('location:telaadm.php');
            } else {
                $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'CPF3P', 'OFF','" . $_SESSION['ID_USU'] . "')";
                $result = mysqli_query($conexao, $sql);
                $_SESSION['mensagem'] = "Verificação de duas etapas falhou, tente logar novamente";
                header("Location:loginadm.php");
            }
        }  
        if (isset($cpf3U)) {
            if ($cpf3U === $rowCPF3U) {
                $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'CPF3U', 'ON','" . $_SESSION['ID_USU'] . "')";
                $result = mysqli_query($conexao, $sql);
                header('location:telaadm.php');
            } else {
                $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'CPF3U', 'OFF','" . $_SESSION['ID_USU'] . "')";
                $result = mysqli_query($conexao, $sql);
                $_SESSION['mensagem'] = "Verificação de duas etapas falhou, tente logar novamente";
                header("Location:loginadm.php");
            }
        }  
    } 
        else { 
           


    if (isset($mae)) {
        if ($mae === $_SESSION['NOME_MAE']) {
            $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'NOME_MAE', 'ON','" . $_SESSION['ID_USU'] . "')";
            $result = mysqli_query($conexao, $sql);
            header('location:telausuario.php'); 
        } else {
            $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'NOME_MAE', 'OFF','" . $_SESSION['ID_USU'] . "')";
            $result = mysqli_query($conexao, $sql);
            $_SESSION['mensagem'] = "Verificação de duas etapas falhou, tente logar novamente";
            header("Location:loginusu.php");
        }  
    }
    if (isset($nasc)) {
        if ($nasc === $_SESSION['DT_NASC']) {
            $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'DT_NASC', 'ON','" . $_SESSION['ID_USU'] . "')";
            $result = mysqli_query($conexao, $sql);
            header('location:telausuario.php');
        } else {
            $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'DT_NASC', 'OFF','" . $_SESSION['ID_USU'] . "')";
            $result = mysqli_query($conexao, $sql);
            $_SESSION['mensagem'] = "Verificação de duas etapas falhou, tente logar novamente";
            header("Location:loginusu.php");
        }
    }
    if (isset($cell)) {
        if ($cell === $_SESSION['CELULAR']) {
            $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'CELL', 'ON','" . $_SESSION['ID_USU'] . "')";
            $result = mysqli_query($conexao, $sql);
            header('location:telausuario.php');
        } else {
            $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'CELL', 'OFF','" . $_SESSION['ID_USU'] . "')";
            $result = mysqli_query($conexao, $sql);
            $_SESSION['mensagem'] = "Verificação de duas etapas falhou, tente logar novamente";
            header("Location:loginusu.php");
        }
    }
    if (isset($cpf3P)) {
        if ($cpf3P === $rowCPF3P) {
            $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'CPF3P', 'ON','" . $_SESSION['ID_USU'] . "')";
            $result = mysqli_query($conexao, $sql);
            header('location:telausuario.php');
        } else {
            $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'CPF3P', 'OFF','" . $_SESSION['ID_USU'] . "')";
            $result = mysqli_query($conexao, $sql);
            $_SESSION['mensagem'] = "Verificação de duas etapas falhou, tente logar novamente";
            header("Location:loginusu.php");
        }
    }
    if (isset($cpf3U)) {
        if ($cpf3U === $rowCPF3U) {
            $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'CPF3U', 'ON','" . $_SESSION['ID_USU'] . "')";
            $result = mysqli_query($conexao, $sql);
            header('location:telausuario.php');
        } else {
            $sql =  "INSERT INTO registro ( hora_ac, metodo_ac, status_ac, ID_USU) VALUES ( '" . DATE('d-m-Y H:i:s') . "', 
                        'CPF3U', 'OFF','" . $_SESSION['ID_USU'] . "')";
            $result = mysqli_query($conexao, $sql);
            $_SESSION['mensagem'] = "Verificação de duas etapas falhou, tente logar novamente";
            header("Location:loginusu.php");
        }
    }
}
}
