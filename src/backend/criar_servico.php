<?php
session_start();
include('conectar.php');

$conn = new mysqli($local,$user,$pass,$bd);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o usuário está logado
    if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
        echo "Usuário não autenticado.";
        exit;
    }

    // Recuperar o ID do usuário usando o email e senha da sessão
    $email = $_SESSION['email'];
    $senha = $_SESSION['senha'];

    $sql_usuario = "SELECT id_usuario FROM usuarios WHERE nm_email_usuario = ? AND nm_senha_usuario = AES_ENCRYPT(?, '99')";
    $stmt_usuario = $conn->prepare($sql_usuario);
    $stmt_usuario->bind_param("ss", $email, $senha);
    $stmt_usuario->execute();
    $stmt_usuario->store_result(); // Armazena o resultado para contar as linhas
    $stmt_usuario->bind_result($id_usuario);

    if ($stmt_usuario->num_rows > 0 && $stmt_usuario->fetch()) {
        // O usuário foi encontrado, podemos proceder com a inserção do serviço
        $nome_servico = $_POST['nome_servico'];
        $sobre_servico = $_POST['sobre_servico'];
        $data_servico = $_POST['data_servico'];

        // Preparar e vincular
        $stmt_servico = $conn->prepare("INSERT INTO servicos (id_usuario, nm_nome_servico, nm_sobre_servico, nm_categoria_servico, data_servico) VALUES (?, ?, ?, ?, ?)");
        $stmt_servico->bind_param("issss", $id_usuario, $nome_servico, $sobre_servico, $categoria_servico, $data_servico);

        // Executar
        if ($stmt_servico->execute()) {
          header('location:../../pages/home-contratante.php');
        } else {
            echo "Erro ao criar serviço: " . $stmt_servico->error;
        }

        $stmt_servico->close();
    } else {
        echo "Erro ao recuperar o ID do usuário.";
    }

    $stmt_usuario->close();
    $conn->close();
}
?>