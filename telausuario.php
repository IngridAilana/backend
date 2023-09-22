<?php

session_start();
require_once 'config.php';
 // busca na tabela "usuarios" e na tabela "perfil_usuarios" onde o ID_PERFIL da tabela "usuarios" seja igual os ID_PERFIL da tabela "perfil_usuarios" e o ID_USU seja igual ao da sessão.  
$sql = "SELECT c. *, p.* FROM usuarios as c, perfil_usuarios as p WHERE c. ID_PERFIL = p. ID_PERFIL and ID_USU  ='" . $_SESSION['ID_USU'] . "'";
$result = mysqli_query($conexao, $sql);
$dados =  mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title> Área do Usuário </title>
</head>

<body>
    <form method="post" action="telausuario.php">
        <table border="1">

            <tr>
                <td> Nome: <input type="text" name="nome" value="<?php
            echo $dados['NOME_USU'];
            ?> ">
                </td>
            </tr>
            <tr>
                <td> Data de Nascimento: <input type="date" required name="dt_nasc" value=<?php
                echo "'". $dados['DT_NASC'] ."'";
                ?>>
                </td>
            </tr>
            <tr>
                <td> Nome da Mãe: <input type="text" name="nome_mae" value="<?php
            echo $dados['NOME_MAE'];
            ?> ">
                </td>
            </tr>
            <tr>
                <td> CPF: <input type="text" name="cpf" value="<?php
            echo $dados['CPF'];
            ?> "> </td>
            </tr>
            <tr>
                <td> Celular: <input type="text" name="cel_usu" value="<?php
            echo $dados['CEL_USU'];
            ?> "> </td>
            </tr>
            <tr>
                <td> Telefone Fixo: <input type="text" name="telfixo" value="<?php
            echo $dados['TELFIXO'];
            ?> "> </td>
            </tr>
            <tr>
                <td> Endereço: <input type="text" name="endereco" value="<?php
            echo $dados['ENDERECO'];
            ?> "> </td>
            </tr>
            <tr>
                <td> Login: <input type="text" name="login_usu" value="<?php
                    echo $dados['LOGIN_USU'];
             ?>"> </td>
            </tr>
            <tr>
                <td><input type="submit" name="btnatualizar" Value="Atualizar"></td>
            </tr>
            </tr>
            <tr>
                <td><input type="submit" name="btnDELETAR" Value="Deletar"></td>
            </tr>
        </table>
    </form>
    <a href="sair.php" class="btn btn-primary"> Deslogar </a>
</body>

</html>
                    
<?php

$btn = filter_input(INPUT_POST, 'btnatualizar', FILTER_SANITIZE_STRING);
if (isset($btn)) {
    $dado = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $sql = "UPDATE usuarios set 
    NOME_USU='" . $dado['nome'] . "',
    DT_NASC='" . $dado['dt_nasc'] . "',
    NOME_MAE='" . $dado['nome_mae'] . "',
    CPF='" . $dado['cpf'] . "',
    CEL_USU='" . $dado['cel_usu'] . "',
    TELFIXO='" . $dado['telfixo'] . "',
    ENDERECO='" . $dado['endereco'] . "', 
    LOGIN_USU='" . $dado['login_usu'] . "' WHERE ID_USU='" . $_SESSION['ID_USU'] . "'";
    $result = mysqli_query($conexao, $sql);

    $_SESSION['mensagem'] = "Cadastro Alterado Com Sucesso!";
    session_destroy();
    session_start();
    header('Location:loginusu.php');
}
$btnDELL = filter_input(INPUT_POST, 'btnDELETAR', FILTER_SANITIZE_STRING);
if(isset($btnDELL))

{ $dado = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $sql = "UPDATE usuarios set status_ID='E' Where ID_USU='" . $_SESSION['ID_USU'] . "'";
    $result = mysqli_query($conexao, $sql);
    session_destroy();
    session_start();

    $_SESSION['mensagem'] = "Cadastro Apagado Com Sucesso!";
    header('Location:loginusu.php');
    
}

?>