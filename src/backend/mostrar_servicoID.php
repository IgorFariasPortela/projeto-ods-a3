<?php
include('conectar.php');

if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    echo "Usuário não autenticado.";
    exit;
}
$conn = new mysqli($local,$user,$pass,$bd);

$conn->set_charset("utf8");

date_default_timezone_set('America/Sao_Paulo');

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
    // O usuário foi encontrado, podemos proceder com a consulta dos serviços
    $sql = "SELECT * FROM servicos WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Loop para exibir os serviços
    while($row = $result->fetch_assoc()) {
        $id_servico = $row['id_servico'];
        $nome_servico = htmlspecialchars($row['nm_nome_servico']);
        $sobre_servico = htmlspecialchars($row['nm_sobre_servico']);
        $categoria_servico = htmlspecialchars($row['nm_categoria_servico']);
        $data_servico = date('Y-m-d', strtotime($row['data_servico'])); // Formatação da data
    
        // Exibição do card para cada serviço
        echo '<div class="card">';
        echo '<div class="card-inner">';
        echo '<div class="card-front">';
        echo '<h2>' . $nome_servico . '</h2>';
        echo '<p>' . $sobre_servico . '</p>';
    
        // Formulário para excluir serviço
        echo '<form action="../src/backend/excluir_servico.php" method="post">';
        echo '<input type="hidden" name="id_servico" value="' . $id_servico . '">'; // Campo oculto com o ID do serviço
        echo '<button type="submit" class="btn-excluir">Excluir Serviço</button>';
        echo '</form>';
    
        echo '</div>';
        echo '<div class="card-back">';
        echo '<p><strong>Objetivo: </strong>' . $categoria_servico . '</p>';
        echo '<p><strong>Data: </strong>' . date('d/m/Y', strtotime($data_servico)) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    $stmt->close();
} else {
    echo "Erro ao recuperar o ID do usuário.";
}

$stmt_usuario->close();
$conn->close();
?>
