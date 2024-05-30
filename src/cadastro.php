<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../imgs/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/cadastro/cadastro.css">
    <title>Cadastro</title>
  </head>
  <body>
    <div class="container">
      <div class="heading"><img src="../imgs/text-krow.png" alt="" /></div>
      <form action="" class="form" method="POST">
        <!-- caixas de email e senha -->
        <div class="form-group">
          <input class="form-input" type="email" name="email" placeholder=" " required />
          <label>E-mail</label>
        </div>
        <div class="form-group">
          <input class="form-input" type="password" name="senha" placeholder=" " required  />
          <label>Senha</label>
        </div>
        <div class="form-group">
            <input class="form-input" required type="password" name="confirmar_senha" placeholder=" " />
            <label>Confirmar senha</label>
          </div>
    <!-- caixa de checkbox -->
    <div class="checkbox-wrapper-46">
        <input type="radio" id="radio-46-1" class="inp-cbx" name="tipo_usuario" value="contratado" required> 
        <label for="radio-46-1" class="cbx"
          ><span>
            <svg viewBox="0 0 12 10" height="10px" width="12px">
              <polyline points="1.5 6 4.5 9 10.5 1"></polyline></svg></span
          ><span id="remember-login">Conta Contratado</span>
        </label>
      </div>
  
      <div class="checkbox-wrapper-46">
        <input type="radio" id="radio-46-2" class="inp-cbx" name="tipo_usuario" value="contratante" required> 
        <label for="radio-46-2" class="cbx"
          ><span>
            <svg viewBox="0 0 12 10" height="10px" width="12px">
              <polyline points="1.5 6 4.5 9 10.5 1"></polyline></svg></span
          ><span id="remember-login">Conta Contratante</span>
        </label>
      </div>

          <!-- botão para entrar na plataforma -->
        <span class="forgot-password"><a href="../pages/login.html">Já tem conta? Clique aqui!</a></span>
        <input class="login-button" type="submit" name="salvar" value="ENTRAR" />
      </form>
    </div>
  </body>
  </html>

  <?php

include('conectar.php');

if(isset($_POST['salvar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Verificação de senha
    if($senha !== $confirmar_senha) {
        echo "<script>alert('As senhas não coincidem!')</script>";
    } else {
        // Verificação de e-mail
        $email_check_query = "SELECT nm_email_contratado FROM contratado WHERE nm_email_contratado = '$email' UNION SELECT nm_email_empresa FROM contratante WHERE nm_email_empresa = '$email'";
        $result = mysqli_query($conexao, $email_check_query);

        if(mysqli_num_rows($result) > 0) {
            echo "<script>alert('Este e-mail já está registrado!')</script>";
        } else {
            // Inserção de dados
            if($tipo_usuario == 'contratado') {
                $sql = "INSERT INTO contratado (nm_email_contratado, nm_senha_contratado) VALUES ('$email', AES_ENCRYPT('$senha','99'))";
            } else {
                $sql = "INSERT INTO contratante (nm_email_empresa, nm_senha_empresa) VALUES ('$email', AES_ENCRYPT('$senha','99'))";
            }

            if(mysqli_query($conexao, $sql)) {
                echo "<script>alert('Cadastro realizado!')</script>";
                header('location:../pages/login.html');
            } else {
                echo "<script>alert('Erro ao realizar cadastro.')</script>";
            }
        }
    }
}
?>

