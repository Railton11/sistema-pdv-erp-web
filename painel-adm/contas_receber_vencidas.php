<?php 
$pag = 'contas_receber';
@session_start();

require_once('../conexao.php');
require_once('verificar-permissao.php')

?>
<div class="mt-4" style="margin-right:25px">
	<?php 
	$query = $pdo->query("SELECT * from contas_receber where vencimento < curDate() and pago != 'Sim' order by vencimento asc");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){ 
		?>
			<table id="example" class="table table-hover my-4" style="width:100%">
				<thead>
					<tr>
						<th>Pago</th>
						<th>Descrição</th>
						<th>Valor</th>
						<th>Usuário</th>
						<th>Vencimento</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>

					<?php 
					for($i=0; $i < $total_reg; $i++){
						foreach ($res[$i] as $key => $value){	}

						$id_usu = $res[$i]['usuario'];
						$query_p = $pdo->query("SELECT * from usuarios where id = '$id_usu'");
						$res_p = $query_p->fetchAll(PDO::FETCH_ASSOC);
						$nome_usu = $res_p[0]['nome'];

						?>

						<tr>
							<td><?php echo $res[$i]['pago'] ?></td>

							<td><?php echo $res[$i]['descricao'] ?></td>

							<td>R$ <?php echo number_format($res[$i]['valor'], 2, ',', '.'); ?></td>

							<td><?php echo $nome_usu ?></td>

							<td><?php echo implode('/', array_reverse(explode('-', $res[$i]['vencimento']))); ?></td>
							<td>
								<a href="index.php?pagina=contas_receber_vencidas&funcao=pagar&id=<?php echo $res[$i]['id'] ?>" title="Confirma recebimento" style="text-decoration: none">
									<i class="bi bi-cash-coin text-success mx-1"></i>
								</a>
							</td>
						</tr>

					<?php } ?>

				</tbody>

			</table>
	<?php }else{
		echo '<p>Não existem dados para serem exibidos!!';
	} ?>
</div>

<div class="modal fade" tabindex="-1" id="modalPagar" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirmar recebimento</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST" id="form-pagar">
				<div class="modal-body">

					<p>Deseja Realmente confirmar o Recebimento do pagamento desta conta?</p>

					<small><div align="center" class="mt-1" id="mensagem-pagar">
						
					</div> </small>

				</div>
				<div class="modal-footer">
					<button type="button" id="btn-fechar-baixar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button name="btn-baixar" id="btn-excluir" type="submit" class="btn btn-success">Confirmar</button>

					<input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

				</div>
			</form>
		</div>
	</div>
</div>

<?php 
if(@$_GET['funcao'] == "pagar"){ ?>
	<script type="text/javascript">
		var myModal = new bootstrap.Modal(document.getElementById('modalPagar'), {
			
		})

		myModal.show();
	</script>
<?php } ?>

<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
	$("#form-pagar").submit(function () {
		var pag = "<?=$pag?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/pagar.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {

				$('#mensagem-pagar').removeClass()

				if (mensagem.trim() == "Baixado com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pagina="+pag;

                } else {

                	$('#mensagem-pagar').addClass('text-danger')
                }

                $('#mensagem-pagar').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
            	var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                	myXhr.upload.addEventListener('progress', function () {
                		/* faz alguma coisa durante o progresso do upload */
                	}, false);
                }
                return myXhr;
            }
        });
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable({
			"ordering": false
		});
	} );
</script>