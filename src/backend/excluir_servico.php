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

// Verificar se o ID do serviço foi recebido via POST
if (isset($_POST['id_servico'])) {
    $id_servico = $_POST['id_servico'];

    // Exemplo de SQL para excluir serviço (aqui você deve ajustar conforme sua estrutura)
    $sql_excluir_servico = "DELETE FROM servicos WHERE id_servico = $id_servico";

    if ($conn->query($sql_excluir_servico) === TRUE) {
        // Redirecionar de volta para a página onde o serviço foi excluído
        header("Location: {$_SERVER['HTTP_REFERER']}"); // Redireciona de volta para a página anterior
        exit();
    } else {
        echo "Erro ao excluir serviço: " . $conn->error;
    }
} else {
    echo "ID do serviço não fornecido.";
}

// Fechar conexão após as operações
$conn->close();
?>