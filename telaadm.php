<?php

session_start();
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">  

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title> Área do  ADM  </title>
</head>

<body>
    <?php 
    $sql = "SELECT c. *, p.* ,s.* FROM usuarios as c, perfil_usuarios as p, status_usuarios as s  WHERE c. ID_PERFIL = p. ID_PERFIL and c.status_ID=s.status_ID ";
    $result = mysqli_query($conexao, $sql);

    echo '<table class="table table-hover">';
    echo "<tr>";
    echo "<th> ID: </th>";
    echo "<th> Nome: </th>";
    echo "<th> Login:</th>";
    echo "<th> Data de Nascimento: </th>";
    echo "<th> Nome da Mãe: </th>";
    echo "<th> CPF: </th>";
    echo "<th> Celular: </th>";
    echo "<th> Telefone Fixo: </th>";
    echo "<th> Endereço: </th>";
    echo "<th> Tipo  de Usuário:</th>";
    echo "<th> Status do Usuário:</th>";
    echo "<th> Status da Conta | Perfil | Ação </th>";
    echo "</tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['ID_USU'] . "</td>";
        echo "<td>" . $row['NOME_USU'] . "</td>";
        echo "<td>" . $row['LOGIN_USU'] . "</td>";
        echo "<td>" . $row['DT_NASC'] . "</td>";
        echo "<td>" . $row['NOME_MAE'] . "</td>";
        echo "<td>" . $row['CPF'] . "</td>";
        echo "<td>" . $row['CEL_USU'] . "</td>";
        echo "<td>" . $row['TELFIXO'] . "</td>";
        echo "<td>" . $row['ENDERECO'] . "</td>";
        echo "<td>" . $row['PERFIL_DESC'] . "</td>";
        echo "<td>" . $row['status_desc'] . "</td>"; 
        echo "<td><form action='' method='post'><input type='hidden' name='id' value='".$row['ID_USU']."'><select name='status'><option value='A'> Ativo </option><option value='E'> Excluido </option></select><select name='perfil'><option value='A'> Administrador </option><option value='C'> Comum </option></option></select><input type='Submit' value='Alterar' name='btnalterar'> </form> ";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <a href="sair.php" class="btn btn-primary"> Deslogar </a></button> 
    <a href="baixarlog.php" class="btn btn-primary" > Baixar dados </a></button> 
    
</body> 
</html>

<?php

    $dados=filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(isset($dados['btnalterar'])){
    $sql="UPDATE usuarios set ID_PERFIL='".$dados['perfil']."',status_ID='".$dados['status']."'
    WHERE ID_USU='".$dados['id']."'";
    mysqli_query($conexao, $sql);

    }

?>