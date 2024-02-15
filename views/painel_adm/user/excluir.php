<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/bdconnect/conexao.php';

$id = $_POST['id'];
$res = $pdo->prepare("DELETE from usuario where id = :id ");

$res->bindValue(":id", $id);

$res->execute();

?>