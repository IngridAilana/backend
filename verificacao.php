<?php 

    session_start();
    require_once 'config.php';

    $login = $_POST['login'];
    $senha = $_POST['senha'];

        if (!empty($login) and !empty($senha)) {
            $sql = "SELECT * FROM usuarios WHERE LOGIN_USU = '$login'"; // buscar o usuario no sistema 
            $resultlogin= mysqli_query($conexao, $sql);
            $rowlogin = mysqli_fetch_array($resultlogin); 

            if ($rowlogin['SENHA_USU'] == "$senha") { 
                if($rowlogin['status_ID']=="A"){
                $_SESSION['CPF'] = $rowlogin['CPF'];
                $_SESSION['NOME_MAE'] = $rowlogin['NOME_MAE'];
                $_SESSION['CELULAR'] = $rowlogin['CELULAR'];
                $_SESSION['DT_NASC'] = $rowlogin['DT_NASC'];
                $_SESSION['ID_USU'] = $rowlogin['ID_USU'];

                header ('location: 2FA.php'); 

                }else{
                    session_destroy();
                    session_start();
                    $_SESSION['mensagem'] = "Usuário Excluido do Sistema"; 
                     header('Location:loginusu.php');

            }
            }   else { 
                session_destroy();
                session_start();
                $_SESSION['mensagem'] = "Login ou Senha incorretos."; 
                 header('Location:loginusu.php');
            }
    
        }else { 
                session_destroy();
                session_start();
                $_SESSION['mensagem'] = "Login ou Senha incorretos."; 
                 header('Location:loginusu.php');
            } 
        
        
    

?> 