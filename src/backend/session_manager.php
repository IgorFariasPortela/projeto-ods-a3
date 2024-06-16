<?php
// Inclui o arquivo de conexão com o banco de dados
$local = 'localhost';
$user = 'root';
$pass= 'usbw';
$bd = 'testeprojetofacu';
$conexao = mysqli_connect($local,$user,$pass,$bd);

    // Consulta SQL para buscar o nome do usuário pelo email
    $query = "SELECT nome FROM sua_tabela_usuarios WHERE email = ?";
    
    // Prepara a declaração SQL
    $stmt = $conexao->prepare($query);

    // Verifica se a preparação da consulta foi bem-sucedida
    if($stmt === false) {
        die('Erro na preparação da consulta: ' . $conexao->error);
    }

    // Vincula os parâmetros à declaração SQL
    $stmt->bind_param('s', $email_usuario);

    // Executa a consulta
    $stmt->execute();

    // Associa as colunas da consulta a variáveis PHP
    $stmt->bind_result($nome);

    // Obtém o resultado da consulta
    $stmt->fetch();

    // Fecha a declaração
    $stmt->close();

    // Verifica se encontrou algum resultado
    if(!empty($nome)) {
        // Exibe o nome do usuário
        echo $nome;
    } else {
        // Caso não encontre o nome do usuário
        echo "Nome não encontrado";
    }
?>