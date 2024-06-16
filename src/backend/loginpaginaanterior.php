<?php
session_start();

// Destruir a sessão
session_destroy();

// Verificar se o parâmetro de redirecionamento existe e é seguro
if (isset($_POST['redirect'])) {
    $redirect = urldecode($_POST['redirect']);
    // Redirecionar para a página anterior
    header('Location: ' . $redirect);
} else {
    // Se não houver um redirecionamento válido, redirecionar para uma página padrão
    header('Location: index.php'); // Substitua 'index.php' pela página que deseja redirecionar por padrão
}
?>