<?php
session_start();

if (isset($_POST['entrar'])) {
    $local = 'localhost';
    $user = 'root';
    $pass = 'usbw';
    $bd = 'adms';
    $conexao = mysqli_connect($local, $user, $pass, $bd);

    if (!$conexao) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $sql = "SELECT * FROM admin WHERE nm_nome = '$nome' AND nm_senha_usuario = '$senha'";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['nome'] = $nome;
        $_SESSION['senha'] = $senha;
        header('location: pages/adm.php');
    } else {
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);
        echo "<script>alert('Login ou senha incorreta!'); window.history.back();</script>";
    }

    mysqli_close($conexao);
}
?>