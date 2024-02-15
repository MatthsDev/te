<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/bdconnect/conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$nivel_user = $_POST['nivel'];
$senha_hashed = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Consulta SQL para verificar se o email já está cadastrado, excluindo o próprio email
$verifica_usuario = $pdo->prepare("SELECT COUNT(*) AS total FROM usuario WHERE usuario = :email AND usuario != :email_post");
$verifica_usuario->bindValue(":email", $email);
$verifica_usuario->bindValue(":email_post", $email); // Bind para o próprio email
$verifica_usuario->execute();
$linhas = $verifica_usuario->fetchColumn();

if ($linhas > 0) {
    echo "Usuário já cadastrado com este email!";
} else {
    $res = $pdo->prepare("UPDATE usuario SET nome = :nome, usuario = :usuario, senha = :senha, senha_original = :senha_original, nivel = :nivel WHERE usuario = :email");

    $res->bindValue(":nome", $nome);
    $res->bindValue(":usuario", $email);
    $res->bindValue(":senha", $senha_hashed);
    $res->bindValue(":senha_original", $senha);
    $res->bindValue(":nivel", $nivel_user);
    $res->bindValue(":email", $email);

    $res->execute();

    echo "Cadastrado com Sucesso!!";
}
