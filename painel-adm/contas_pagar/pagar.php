<?php

require_once("../../conexao.php");
@session_start();

$id = $_POST['id'];
$id_usuario = $_SESSION['id_usuario'];


$query_con = $pdo->query("UPDATE contas_pagar SET pago = 'Sim', usuario = '$id_usuario' where id = '$id'");

// VERIFICAR SE É UMA COMPRA DE PRODUTO PARA PODER CONFIRMAR A COMPRA COMO PAGA
$query_con = $pdo->query("SELECT * FROM contas_pagar WHERE id = '$id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res_con);
if($total_reg > 0){
    $descricao = $res_con[0]['descricao'];
    $id_compra = $res_con[0]['id_compra'];
    if($descricao == "Compra de produtos"){
        $query_con = $pdo->query("UPDATE contas_pagar SET pago = 'Sim' where id = '$id_compra'");
    }
}

echo "Pago com Sucesso!";

?>