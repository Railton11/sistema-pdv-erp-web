<?php

require_once("../../conexao.php");

$nome = $_POST['nome'];
$codigo = $_POST['codigo'];
$descricao = $_POST['descricao'];
$valor_venda = $_POST['valor_venda'];
$valor_venda = str_replace(',', '.', $valor_venda);
$categoria = $_POST['categoria'];
$id = $_POST['id'];


$antigo = $_POST['antigo'];
$antigo2 = $_POST['antigo2'];

// EVITAR DUPLICIDADE DE NOME
if($antigo != $nome){
    $query_con = $pdo->prepare("SELECT * from produtos WHERE nome = :nome");
    $query_con->bindValue(":nome", $nome);
    $query_con->execute();
    $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
    if(@count($res_con) > 0){
        echo "Protudo já cadastrado! ";
        exit();
    }
}

// EVITAR DUPLICIDADE DE CÓDIGO
if($antigo2 != $codigo){
    $query_con = $pdo->prepare("SELECT * from produtos WHERE codigo = :codigo");
    $query_con->bindValue(":codigo", $codigo);
    $query_con->execute();
    $res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
    if(@count($res_con) > 0){
        echo "Protudo com este código já existe! ";
        exit();
    }
}

//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['imagem']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../imagem/produtos/' .$nome_img;
if (@$_FILES['imagem']['name'] == ""){
  $imagem = "sem-foto.png";
}else{
    $imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name']; 
$ext = pathinfo($imagem, PATHINFO_EXTENSION);   
if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
move_uploaded_file($imagem_temp, $caminho);
}else{
	echo 'Extensão de Imagem não permitida!';
	exit();
}


if($id == ""){
    $res = $pdo->prepare("INSERT INTO produtos SET nome = :nome, codigo = :codigo, descricao = :descricao, valor_venda = :valor_venda, categoria = :categoria, foto = :foto");

    $res->bindValue(":nome", $nome);
    $res->bindValue(":codigo", $codigo);
    $res->bindValue(":descricao", $descricao);
    $res->bindValue(":valor_venda", $valor_venda);
    $res->bindValue(":categoria", $categoria);
    $res->bindValue(":foto", $imagem);
    $res->execute();
}else{
    if($imagem != 'sem-foto.png'){
        $res = $pdo->prepare("UPDATE produtos SET nome = :nome, codigo = :codigo, descricao = :descricao, valor_venda = :valor_venda, categoria = :categoria, foto = :foto WHERE id = :id");
        $res->bindValue(":foto", $imagem);
    }else{
        $res = $pdo->prepare("UPDATE produtos SET nome = :nome, codigo = :codigo, descricao = :descricao, valor_venda = :valor_venda, categoria = :categoria WHERE id = :id");
    }
    
    $res->bindValue(":nome", $nome);
    $res->bindValue(":codigo", $codigo);
    $res->bindValue(":descricao", $descricao);
    $res->bindValue(":valor_venda", $valor_venda);
    $res->bindValue(":categoria", $categoria);
    $res->bindValue(":id", $id);
    $res->execute();
    
}
echo "Salvo com Sucesso!";
?>