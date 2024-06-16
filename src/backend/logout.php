<?php
session_start();
session_destroy();
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : '../../pages/login.html';
header("Location: $redirect");
exit;
?>