<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/bdconnect/conexao.php';

session_start();

if (empty($_POST['usuario']) || empty($_POST['senha'])) {
    header("location: /we/views/index.php");
}

$usuario = $_POST['usuario'];
$senha_login = $_POST['senha'];

$stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario = :usuario");
$stmt->bindValue(":usuario", $usuario);
$stmt->execute();

$dados = $stmt->fetch(PDO::FETCH_ASSOC);

if ($dados && password_verify($senha_login, $dados['senha'])) {
    $_SESSION['nome_usuario'] = $dados['nome'];
    $_SESSION['user_usuario'] = $dados['usuario'];
    $_SESSION['nivel_usuario'] = $dados['nivel'];

    // Redirecione com base no nível de acesso
    if ($_SESSION['nivel_usuario'] == 'SUPORTE') {
        header("location: /we/views/areasuporte.php");
        exit();
    }

    if ($_SESSION['nivel_usuario'] == 'OPERADOR') {
        header("location: /we/views/painel_user/user_panel.php");
        exit();
    }

    if ($_SESSION['nivel_usuario'] == 'ADMINISTRADOR') {
        header("location: /we/views/painel_adm/adm_panel.php");
        exit();
    }

} else {
    echo "<script language='javascript'>window.alert('Senha incorreta!'); </script>";
    echo "<script language='javascript'>window.location='/we/views/#paralogin'; </script>";
}