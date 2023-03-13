<?php

require_once("../../conexao.php");

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$nivel = $_POST['nivel'];
$id = $_POST['id'];

$antigo = $_POST['antigo'];
$antigo2 = $_POST['antigo2'];

// EVITAR DUPLICIDADE DE EMAIL
if($antigo2 != $email){
    $query_con = $pdo->prepare("SELECT * from usuarios WHERE email = :email");
    $query_con->bindValue(":email", $email);
    $query_con->execute();
    $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
    if(@count($res_con) > 0){
        echo "Esse email já existe! ";
        exit();
    }
}



// EVITAR DUPLICIDADE DE CPF
if($antigo != $cpf){
    $query_con = $pdo->prepare("SELECT * from usuarios WHERE cpf = :cpf");
    $query_con->bindValue(":cpf", $cpf);
    $query_con->execute();
    $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
    if(@count($res_con) > 0){
        echo "Esse CPF já existe! ";
        exit();
    }
}

if($id == ""){
    $res = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, cpf = :cpf, email = :email, senha= :senha, nivel = :nivel");

    $res->bindValue(":nome", $nome);
    $res->bindValue(":cpf", $cpf);
    $res->bindValue(":email", $email);
    $res->bindValue(":senha", $senha);
    $res->bindValue(":nivel", $nivel);
    $res->execute();
}else{
    $res = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf, email = :email, senha= :senha, nivel = :nivel WHERE id = :id");

    $res->bindValue(":nome", $nome);
    $res->bindValue(":cpf", $cpf);
    $res->bindValue(":email", $email);
    $res->bindValue(":senha", $senha);
    $res->bindValue(":nivel", $nivel);
    $res->bindValue(":id", $id);
    $res->execute();
}
echo "Salvo com Sucesso!";
?>