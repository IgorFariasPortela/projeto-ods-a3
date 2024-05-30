<?php
    session_start();
    if(isset($_POST['entrar']))
    $local = 'localhost';
    $user = 'root';
    $pass= 'usbw';
    $bd = 'testeprojetofacu';
    $conexao = mysqli_connect($local,$user,$pass,$bd);
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $botao = $_POST['entrar'];
    {
        $sql_contratado = "SELECT * FROM contratado WHERE nm_email_contratado = '$email' AND nm_senha_contratado = AES_ENCRYPT('$senha', '99')";
        $result_contratado = mysqli_query($conexao, $sql_contratado);
    
        $sql_contratante = "SELECT * FROM contratante WHERE nm_email_empresa = '$email' AND nm_senha_empresa = AES_ENCRYPT('$senha', '99')";
        $result_contratante = mysqli_query($conexao, $sql_contratante);
    
        if(mysqli_num_rows($result_contratado) > 0) {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('location:../pages/funcionou_contratado.html'); // Encaminhar para a página do contratado
        } elseif(mysqli_num_rows($result_contratante) > 0) {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('location:../pages/funcionou_contratante.html'); // Encaminhar para a página do contratante
        } else {
            echo"<script>alert('Login ou senha incorreta!'); window.location.href='login.html';</script>";
        }
    }
    ?>