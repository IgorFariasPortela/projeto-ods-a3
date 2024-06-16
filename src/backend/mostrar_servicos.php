<?php
    $local = 'localhost';
    $user = 'root';
    $pass= 'usbw';
    $bd = 'testeprojetofacu';
    $conexao = mysqli_connect($local,$user,$pass,$bd);

// Cria a conexão
$conn = new mysqli($local,$user,$pass,$bd);
// Configuração do fuso horário
date_default_timezone_set('America/Sao_Paulo');

// Consulta SQL para selecionar todos os serviços
$sql = "SELECT id_servico, nm_nome_servico, nm_sobre_servico, nm_categoria_servico, data_servico FROM servicos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Iterar sobre os resultados para gerar os cards
  while($row = $result->fetch_assoc()) {
    $id_servico = $row['id_servico'];
    $nome_servico = htmlspecialchars($row['nm_nome_servico']);
    $sobre_servico = htmlspecialchars($row['nm_sobre_servico']);
    $categoria_servico = htmlspecialchars($row['nm_categoria_servico']);
    $data_servico = date('Y-m-d', strtotime($row['data_servico'])); // Formatando a data para Y-m-d

    // Exibição do card para cada serviço
    echo '<div class="card">';
    echo '<div class="card-inner">';
    echo '<div class="card-front">';
    echo '<h2>' . $nome_servico . '</h2>';
    echo '<p>' . $sobre_servico . '</p>';
    echo '<button class="animated-button interest-btn">';
    echo '<span>Tenho interesse</span>';
    echo '<span></span>';
    echo '</button>';
    echo '</div>';
    echo '<div class="card-back">';
    echo '<p><strong>Objetivo: </strong>' . $categoria_servico . '</p>';
    echo '<p><strong>Data: </strong>' . date('d/m/Y', strtotime($data_servico)) . '</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }
} else {
  echo "Nenhum serviço encontrado.";
}

$conn->close();
?>