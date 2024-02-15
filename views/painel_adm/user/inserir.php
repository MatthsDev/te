<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/bdconnect/conexao.php';

	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$nivel_user = $_POST['nivel'];
	$senha_hashed = password_hash($_POST['senha'], PASSWORD_DEFAULT);

	//VERIFICAR SE O USUÁRIO JÁ ESTÁ CADASTRADO
	$res_c = $pdo->query("select * from usuario where usuario = '$email'");
	$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_c);
    
	if ($linhas == 0) {
		$res = $pdo->prepare("INSERT into usuario (nome, usuario, senha, senha_original, nivel) values (:nome, :usuario, :senha, :senha_original, :nivel) ");

		$res->bindValue(":nome", $nome);
		$res->bindValue(":usuario", $email);
		$res->bindValue(":senha", $senha_hashed);
		$res->bindValue(":senha_original", $senha);
		$res->bindValue(":nivel", $nivel_user);

		$res->execute();


        echo "Cadastrado com Sucesso!!";

	} else {
        echo "Usuario já cadastrado com este email!";
	}


?>