<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/bdconnect/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['nome_cad'];
    $email = $_POST['email_cad'];
    $senha_hashed = password_hash($_POST['senha_cad'], PASSWORD_DEFAULT);

    // Verifica se o nome de usuário já existe no banco de dados
    $verifica_usuario = $conn->prepare("SELECT * FROM usuario WHERE usuario = ?");
    $verifica_usuario->bind_param("s", $user_name);
    $verifica_usuario->execute();
    $verifica_usuario->store_result();

    if ($verifica_usuario->num_rows > 0) {
        // Se o nome de usuário já está em uso, exibe uma mensagem ou redirecione de volta ao formulário
        echo '<script>alert("Nome de usuário já em uso. Por favor, escolha outro."); window.location.href = "/we/views/index.php";</script>';
        exit();
    }

    // Caso o Nome do Usuário seja unico será adicionado ao SQL
    $smtp = $conn->prepare("INSERT INTO usuario 
    (nome, usuario, senha) 
    VALUES (?, ?, ? )");

    // Verifica se a preparação foi bem-sucedida
    if ($smtp === false) {
        die('Erro na preparação SQL: ' . $conn->error);
    }

    $smtp->bind_param("sss", $user_name, $email, $senha_hashed);

    if ($smtp->execute()) { ?>
        <?php
        echo '<script> setTimeout(function(){alert("CADASTRO REALIZADO COM SUCESSO."); window.location.href = "/we/views/#paralogin"; }, 1500); </script>';
        exit();
    } else {
        echo "ERRO no envio dos DADOS: " . $smtp->error;
    }
}
?>