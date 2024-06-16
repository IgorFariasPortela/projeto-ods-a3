<?php
include('conectar.php');
session_start();

// Configuração do fuso horário
date_default_timezone_set('America/Sao_Paulo'); // Ajuste conforme necessário

// Verifique se a consulta de pesquisa foi enviada
if (isset($_GET['query'])) {
    $query = $_GET['query'];


    // Busca no banco de dados
    $sql = "SELECT * FROM servicos WHERE nm_servico LIKE ? AND id_usuario = ?";
    $stmt = $conexao->prepare($sql);
    $searchQuery = "%" . $query . "%";
    $stmt->bind_param("si", $searchQuery, $_SESSION['id_usuario']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Exibe os resultados
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<div class='card-inner'>";
            echo "<div class='card-front'>";
            echo "<h2>" . htmlspecialchars($row['nm_servico']) . "</h2>";
            echo "<p>" . htmlspecialchars($row['descricao']) . "</p>";
            echo "<button class='interest-btn animated-button'><span>Tenho interesse</span><span></span></button>";
            echo "</div>";
            echo "<div class='card-back'>";
            echo "<p><strong>Objetivo: </strong>" . htmlspecialchars($row['objetivo']) . "</p>";
            echo "<p><strong>Data/Hora: </strong>" . date('d/m/Y H:i', strtotime($row['data_hora'])) . "</p>";
            echo "<p><strong>Endereço: </strong>" . htmlspecialchars($row['endereco']) . "</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>Nenhum serviço encontrado.</p>";
    }
} else {
    echo "<p>Por favor, insira um termo de pesquisa.</p>";
}
?>