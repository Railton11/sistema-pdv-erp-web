<?php

require_once("../../conexao.php");
@session_start();

$id_usuario = $_SESSION['id_usuario'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$id = $_POST['id'];

$query = $pdo->query("SELECT * from contas_pagar where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
    $pago = $res[0]['pago'];

    if($pago == 'Sim'){
        echo 'Essa conta já esta paga, você não pode editá-la';
        exit();
    }
}


if($id == ""){
    $res = $pdo->prepare("INSERT INTO contas_pagar SET data = curDate(), usuario = '$id_usuario', descricao = :descricao, pago = 'Não', valor = :valor");

    $res->bindValue(":descricao", $descricao);
    $res->bindValue(":valor", $valor);
    $res->execute();
}else{
    $res = $pdo->prepare("UPDATE contas_pagar SET usuario = '$id_usuario', descricao = :descricao, valor = :valor WHERE id = :id");
    
    $res->bindValue(":descricao", $descricao);
    $res->bindValue(":valor", $valor);
    $res->bindValue(":id", $id);
    $res->execute();
}
echo "Salvo com Sucesso!";
?>