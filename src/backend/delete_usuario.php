<?php
// Incluir o arquivo de conexão com o banco de dados
include('conectar.php');

// Verificar se o formulário foi enviado
if(isset($_POST['del'])) {
    // Sanitizar e obter o ID do usuário a ser deletado
    $id_usuario = mysqli_real_escape_string($conexao, $_POST['id_usuario']);

    // Montar a consulta SQL para deletar o usuário
    $sql = "DELETE FROM usuarios WHERE id_usuario = '$id_usuario'";

    // Executar a consulta SQL
    if(mysqli_query($conexao, $sql)) {
        echo "<script>alert('Usuário deletado com sucesso!');</script>";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        echo "Erro ao deletar usuário: " . mysqli_error($conexao);
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($conexao);
}
?>