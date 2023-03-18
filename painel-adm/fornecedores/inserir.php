<?php

require_once("../../conexao.php");

$nome = $_POST['nome'];
$tipo_pessoa = $_POST['tipo_pessoa'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$id = $_POST['id'];

$antigo = $_POST['antigo'];
$antigo2 = $_POST['antigo2'];

// EVITAR DUPLICIDADE DE EMAIL
if($antigo2 != $email){
    $query_con = $pdo->prepare("SELECT * from fornecedores WHERE email = :email");
    $query_con->bindValue(":email", $email);
    $query_con->execute();
    $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
    if(@count($res_con) > 0){
        echo "O email do fornecedor já está cadastrado! ";
        exit();
    }
}



// EVITAR DUPLICIDADE DE CPF
if($antigo != $cpf){
    $query_con = $pdo->prepare("SELECT * from fornecedores WHERE cpf = :cpf");
    $query_con->bindValue(":cpf", $cpf);
    $query_con->execute();
    $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
    if(@count($res_con) > 0){
        echo "Esse CPF / CNPJ do fornecedor já está cadastrado! ";
        exit();
    }
}

if($id == ""){
    $res = $pdo->prepare("INSERT INTO fornecedores SET nome = :nome, cpf = :cpf, email = :email, tipo_pessoa= :tipo_pessoa, telefone = :telefone, endereco = :endereco");

    $res->bindValue(":nome", $nome);
    $res->bindValue(":cpf", $cpf);
    $res->bindValue(":email", $email);
    $res->bindValue(":endereco", $endereco);
    $res->bindValue(":telefone", $telefone);
    $res->bindValue(":tipo_pessoa", $tipo_pessoa);
    $res->execute();
}else{
    $res = $pdo->prepare("UPDATE fornecedores SET nome = :nome, cpf = :cpf, email = :email, tipo_pessoa= :tipo_pessoa, telefone = :telefone, endereco = :endereco WHERE id = :id");

    $res->bindValue(":nome", $nome);
    $res->bindValue(":cpf", $cpf);
    $res->bindValue(":email", $email);
    $res->bindValue(":tipo_pessoa", $tipo_pessoa);
    $res->bindValue(":telefone", $telefone);
    $res->bindValue(":endereco", $endereco);
	$res->bindValue(":id", $id);
    $res->execute();
}
echo "Salvo com Sucesso!";
?>