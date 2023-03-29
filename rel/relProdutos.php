<?php 
require_once("../conexao.php"); 


setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Catálogo de Produtos</title>
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
				background-color: #white;
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
				<span class="titulorel">Catálogo de Produtos</span>
			</div>


			<hr>


			<!--<div class="row margem-superior">
				<div class="col-md-12">
					<div class="esquerda_float margem-direita50">	
						<span class=""> <b> Período da Apuração </b> </span>
					</div>
					<div class="esquerda_float margem-direita50">	
						<span class=""> <?php //echo $apuracao ?> </span>
					</div>
					
				</div>
			</div>

			<hr>-->



	<table class='table' width='100%'  cellspacing='0' cellpadding='3'>
				<tr bgcolor='#f9f9f9' >
					<th>Nome</th>
					<th>Estoque</th>
					<th>Valor de compra</th>
					<th>Valor de venda</th>
				</tr>
				<?php 
				
					$query = $pdo->query("SELECT * FROM produtos order by id desc");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					$totalItens = @count($res);
						
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$nome = $res[$i]['nome'];
						$valor_compra = $res[$i]['valor_compra'];
						$valor_venda = $res[$i]['valor_venda'];
						$estoque = $res[$i]['estoque'];
							
						$id = $res[$i]['id'];

						$valor_compra = number_format($valor_compra, 2, ',', '.');
						$valor_venda = number_format($valor_venda, 2, ',', '.');
					?>

					<tr>
						
						<td><?php echo $nome ?> </td>
						<td><?php echo $estoque ?> </td>
						<td>R$ <?php echo $valor_compra ?> </td>
						<td>R$ <?php echo $valor_venda ?> </td>
					</tr>
				<?php } ?>



			</table>

			<hr>


			<div class="row margem-superior">
				<div class="col-md-12">
					<div class="" align="right">
						<b>Total de Produtos: <?php echo $totalItens ?></b>
					</div>

				</div>
			</div>

			<hr>


		</div>


		<div class="footer">
			<p style="font-size:14px" align="center"><?php echo $endereco_sistema . ' Tel: '.$telefone_sistema  ?></p>
			<p style="font-size:14px" align="center"><?php echo $data_hoje ?></p>  
		</div>

	</body>
</html>
