<?php 
require_once("../conexao.php"); 


setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];
$status = $_GET['status'];

$status_like = '%'.$status.'%';

$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));

if($status == 'Concluída'){
	$status_serv = 'Concluídas ';
}else if($status == 'Cancelada'){
	$status_serv = 'Canceladas';

}else{
	$status_serv = '';
}


if($dataInicial != $dataFinal){
	$apuracao = $dataInicialF. ' até '. $dataFinalF;
}else{
	$apuracao = $dataInicialF;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Relatório de Vendas</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="shortcut icon" href="../imagem/logo-icone.ico" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<style>

			@page {
				margin: 0px;

			}

			.footer {
				margin-top:20px;
				width:100%;
				background-color: #ebebeb;
				padding:10px;
				position:absolute;
				bottom:0;
			}

			.cabecalho {    
				background-color: white;
				padding:10px;
				margin-bottom:30px;
				width:100%;
				height:100px;
			}

			.titulo{
				margin:0;
				font-size:28px;
				font-family:Arial, Helvetica, sans-serif;
				color:#6e6d6d;

			}

			.subtitulo{
				margin:0;
				font-size:17px;
				font-family:Arial, Helvetica, sans-serif;
			}

			.areaTotais{
				border : 0.5px solid #bcbcbc;
				padding: 15px;
				border-radius: 5px;
				margin-right:25px;
				margin-left:25px;
				position:absolute;
				right:20;
			}

			.areaTotal{
				border : 0.5px solid #bcbcbc;
				padding: 15px;
				border-radius: 5px;
				margin-right:25px;
				margin-left:25px;
				background-color: #f9f9f9;
				margin-top:2px;
			}

			.pgto{
				margin:1px;
			}

			.fonte13{
				font-size:13px;
			}

			.esquerda{
				display:inline;
				width:50%;
				float:left;
			}

			.direita{
				display:inline;
				width:50%;
				float:right;
			}

			.table{
				padding:15px;
				font-family:Verdana, sans-serif;
				margin-top:20px;
			}

			.texto-tabela{
				font-size:12px;
			}


			.esquerda_float{

				margin-bottom:10px;
				float:left;
				display:inline;
			}


			.titulos{
				margin-top:10px;
			}

			.image{
				margin-top:-10px;
			}

			.margem-direita{
				margin-right: 80px;
			}

			.margem-direita50{
				margin-right: 50px;
			}

			hr{
				margin:8px;
				padding:1px;
			}


			.titulorel{
				margin:0;
				font-size:28px;
				font-family:Arial, Helvetica, sans-serif;
				color:#6e6d6d;

			}

			.margem-superior{
				margin-top:30px;
			}


		</style>


	</head>
	<body>
		<div class="cabecalho">
			<div class="row titulos">
				<div class="col-sm-2 esquerda_float image">	
					<img src="<?php echo $url_sistema ?>/imagem/logo.jpg" width="157px">
				</div>
				<div class="col-sm-10 esquerda_float">	
					<h6 class="titulo"><b><?php echo strtoupper($nome_sistema) ?></b></h6>
				</div>
			</div>
		</div>
		<div class="container">
			<div align="center">	
				<span class="titulorel">Relatório de Vendas <?php echo $status_serv ?></span>
			</div>
			<hr>
			<div class="row margem-superior">
				<div class="col-md-12">
					<div class="esquerda_float">	
						<span class=""> <b> Período da Apuração </b> </span>
					</div>
					<div class="esquerda_float margem-direita50">	
						<span class=""> <?php echo $apuracao ?> </span>
					</div>
					
				</div>
			</div>
			<hr>
		</div>
	<table class='table' width='100%'  cellspacing='0' cellpadding='3'>
		<tr bgcolor='#f9f9f9' >
			<th>Status</th>
			<th>Valor</th>
			<th>Data</th>
			<th>Hora</th>
			<th>Operador</th>
			<th>Pagamento</th>
		</tr>
		<?php 
			$saldo = 0;	
			$saldoF = 0;	
			$query = $pdo->query("SELECT * FROM vendas where data >= '$dataInicial' and data <= '$dataFinal' and status LIKE '$status_like' order by id desc");
			$res = $query->fetchAll(PDO::FETCH_ASSOC);
			$totalItens = @count($res);	
			for ($i=0; $i < @count($res); $i++) { 
				foreach ($res[$i] as $key => $value) {
				}
				$total = $res[$i]['valor'];
				$data = $res[$i]['data'];
				$hora = $res[$i]['hora'];
				$usuario = $res[$i]['operador'];
				$forma_pgto = $res[$i]['forma_pgt'];
				
				$status = $res[$i]['status'];
				
				
				$id = $res[$i]['id'];

				$saldo = $saldo + $total;
				$saldoF = number_format($saldo, 2, ',', '.');

				$total = number_format($total, 2, ',', '.');
				$data = implode('/', array_reverse(explode('-', $data)));


				$query_usu = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
				$res_usu = $query_usu->fetchAll(PDO::FETCH_ASSOC);
				$nome_usu = $res_usu[0]['nome'];


				$res_2 = $pdo->query("SELECT * from forma_pgtos where codigo = '$forma_pgto' ");
				$dados = $res_2->fetchAll(PDO::FETCH_ASSOC);
				$nome_pgto = $dados[0]['nome'];
				?>

		<tr>		
			<td><?php echo $status ?> </td>
			<td>R$ <?php echo $total ?> </td>
			<td><?php echo $data ?> </td>
			<td><?php echo $hora ?> </td>
			<td><?php echo $nome_usu ?> </td>
			<td><?php echo $nome_pgto ?> </td>
		</tr>
		<?php } ?>
	</table>
	<hr>
	<div class="row margem-superior">
		<div class="col-md-12">
			<div class="col-md-12">
				<b>Total R$: <?php echo $saldoF ?></b>
			</div>
		</div>
	</div>
	<hr>
	<div class="footer">
		<p style="font-size:14px" align="center"><?php echo $endereco_sistema . ' Tel: '.$telefone_sistema  ?></p>
		<p style="font-size:14px" align="center"><?php echo $data_hoje ?></p>  
	</div>
	</body>
</html>
