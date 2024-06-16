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

          <!-- botão para entrar na plataforma -->
        <span class="forgot-password"><a href="../pages/login.html">Já tem conta? Clique aqui!</a></span>
        <input class="login-button" type="submit" name="salvar" value="ENTRAR" />
      </form>
    </div>
  </body>
  </html>

  <?php
    $local = 'localhost';
    $user = 'root';
    $pass= 'usbw';
    $bd = 'testeprojetofacu';
    $conexao = mysqli_connect($local,$user,$pass,$bd);
if(isset($_POST['salvar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Verificação de senha
    if($senha !== $confirmar_senha) {
        echo "<script>alert('As senhas não coincidem!'); window.history.back();</script>";
    } else {
        // Verificação de e-mail
        $email_check_query = "SELECT nm_email_usuario FROM usuarios WHERE nm_email_usuario = '$email'";
        $result = mysqli_query($conexao, $email_check_query);

        if(mysqli_num_rows($result) > 0) {
            echo "<script>alert('Este e-mail já está registrado!'); window.history.back();</script>";
        } else {
            // Inserção de dados
            $sql = "INSERT INTO usuarios (nm_email_usuario, nm_senha_usuario) VALUES ('$email', AES_ENCRYPT('$senha','99'))";

            if(mysqli_query($conexao, $sql)) {
                echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='../pages/login.html';</script>";
            } else {
                echo "<script>alert('Erro ao realizar cadastro.'); window.history.back();</script>";
            }
        }
    }
}
?>