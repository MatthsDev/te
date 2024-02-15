<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está autenticado como administrador, usuário comum ou operador
if (!isset($_SESSION['nome_usuario']) || !isset($_SESSION['nivel_usuario']) || !in_array($_SESSION['nivel_usuario'], ['ADMINISTRADOR', 'USUARIO_COMUM', 'OPERADOR'])) {
    // Se o usuário não estiver autenticado ou não tiver o nível de acesso correto, redireciona para a página de login
    header("Location: /we/index.php#paralogin");
    exit();
}
?>