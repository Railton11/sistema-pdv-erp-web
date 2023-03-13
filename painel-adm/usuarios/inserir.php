<?php

require_once("../../conexao.php");

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$nivel = $_POST['nivel'];

// EVITAR DUPLICIDADE DE EMAIL
$query_con = $pdo->prepare("SELECT * from usuarios WHERE email = :email");
$query_con->bindValue(":email", $email);
$query_con->execute();
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
if(@count($res_con) > 0){
    echo "Esse email já existe! ";
    exit();
}
// EVITAR DUPLICIDADE DE CPF
$query_con = $pdo->prepare("SELECT * from usuarios WHERE cpf = :cpf");
$query_con->bindValue(":cpf", $cpf);
$query_con->execute();
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
if(@count($res_con) > 0){
    echo "Esse CPF já existe! ";
    exit();
}

$res = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, cpf = :cpf, email = :email, senha= :senha, nivel = :nivel");

$res->bindValue(":nome", $nome);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":email", $email);
$res->bindValue(":senha", $senha);
$res->bindValue(":nivel", $nivel);
$res->execute();

echo "Salvo com Sucesso!";

?>