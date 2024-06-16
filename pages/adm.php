<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Excluir Cliente</title>

</head>
<body>
<form action="../src/backend/delete_usuario.php" method="POST">
            <h3>Digite o ID do cliente:</h3>
            <input type="number" name="id_usuario" required>
            <input type="submit" value="Deletar" name="del">
            <input type="reset" value="Limpar">
        </form>
</div>
<?php
         $local = 'localhost';
         $user = 'root';
         $pass= 'usbw';
         $bd = 'testeprojetofacu';
         $conexao = mysqli_connect($local,$user,$pass,$bd);
     if(isset($_POST['del']))
     {
        $codigo = $_POST['id_cliente'];
        $sql ="DELETE FROM usuarios WHERE id_usuario = '$codigo'" or die ("Erro ao deletar cliente");
     echo "<script>alert ('Cliente excluido com sucesso')</script>";
     $result = mysqli_query($conexao,$sql);   
     }
?>
<?php
    include ('conectar.php');
    $sql = "SELECT * FROM usuarios";
    $result = mysqli_query ($conexao, $sql);

    echo"<center><h1> Lista de clientes </h1></center>";

    while ($reg = mysqli_fetch_array($result))
   
    {
        echo "<div class='sus'>id: ".$reg['id_cliente'];
        echo "<br>email: ". $reg['nm_email_usuario'];
        echo "<br>id: ". $reg['id_usuario']."<hr></div>";
    }
?>
</body>
</html>