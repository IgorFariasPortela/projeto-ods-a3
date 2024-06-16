<?php
    session_start();
    include('conectar.php');
    
    $conexao = mysqli_connect($local,$user,$pass,$bd);
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $botao = $_POST['entrar'];
    {
        $sql = "SELECT * FROM usuarios WHERE nm_email_usuario = '$email' AND nm_senha_usuario = AES_ENCRYPT('$senha','99')";
        $result = mysqli_query($conexao, $sql);
    
        if(mysqli_num_rows($result) > 0) {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('location:../../pages/home-contratado.php');
        } else {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            echo "<script>alert('Login ou senha incorretos!'); window.location.href='../../pages/login.html';</script>";
        }
    }
    ?>