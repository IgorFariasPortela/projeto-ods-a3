<?php
// Conexão com o banco de dados
$local = 'localhost';
$user = 'root';
$pass = 'usbw';
$bd = 'testeprojetofacu';
$conn = new mysqli($local, $user, $pass, $bd);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se a sessão não está iniciada, iniciar
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o email está definido na sessão
if (!isset($_SESSION['email'])) {
    echo json_encode(array('success' => false, 'message' => 'Sessão não iniciada.'));
    exit; // Ou redirecione para página de erro, etc.
}

// Buscar o ID do usuário pelo email da sessão
$email = $_SESSION['email'];
$sql_busca_id_usuario = "SELECT id_usuario FROM usuarios WHERE email = '$email'";
$result_busca_id = $conn->query($sql_busca_id_usuario);

if ($result_busca_id->num_rows > 0) {
    $row = $result_busca_id->fetch_assoc();
    $id_usuario = $row['id_usuario'];

    // Verificar se o ID do serviço foi recebido via POST
    if (isset($_POST['id_servico'])) {
        $id_servico = $_POST['id_servico'];

        // Inserir interesse na tabela 'interessado'
        $sql_insert = "INSERT INTO interessado (id_cliente, id_servico) VALUES ($id_usuario, $id_servico)";

        if ($conn->query($sql_insert) === TRUE) {
            // Retornar resposta JSON de sucesso
            echo json_encode(array('success' => true, 'message' => 'Interesse registrado com sucesso!'));
        } else {
            // Retornar resposta JSON de erro
            echo json_encode(array('success' => false, 'message' => 'Erro ao registrar interesse: ' . $conn->error));
        }
    } else {
        // Retornar resposta JSON de erro se o ID do serviço não foi recebido
        echo json_encode(array('success' => false, 'message' => 'ID do serviço não fornecido.'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Nenhum usuário encontrado para o email da sessão.'));
}

// Fechar conexão após as operações
$conn->close();
?>