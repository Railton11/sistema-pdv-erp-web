<?php

require_once("../../conexao.php");

$id = $_POST['id'];

// BUSCAR E EXCLUIR FOTO DA PASTA
$query_con = $pdo->query("SELECT * FROM contas_pagar WHERE id = '$id'");
$res_con = $query_con->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res_con);
if($total_reg > 0){
    $pago = $res_con[0]['pago'];

    if($pago == 'Sim'){
        echo 'Essa conta já esta paga, você não pode excluí-la';
        exit();
    }
}

$query_con = $pdo->query("DELETE FROM contas_pagar WHERE id = '$id'");

echo "Excluído com Sucesso!";

?>