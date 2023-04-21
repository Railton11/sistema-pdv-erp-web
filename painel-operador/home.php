<?php 

require_once('../conexao.php');
require_once('verificar-permissao.php');
@session_start();
$id_usuario = $_SESSION['id_usuario'];

//VERIFICAR SE O CAIXA ESTÁ ABERTO
$query = $pdo->query("SELECT * from caixa where operador = '$id_usuario' and status = 'Aberto' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){ 
	$aberto = 'Sim';
}else{
	$aberto = 'Não';
}

?>






<div class="modal fade" tabindex="-1" id="modalAbertura" data-bs-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Abrir Caixa</h5>
				
			</div>
			<form method="POST" id="form-abertura">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Caixa</label>
								
								<select class="form-select mt-1" aria-label="Default select example" name="caixa">
									<?php 
									$query = $pdo->query("SELECT * from caixas order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if($total_reg > 0){ 

										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){	}
												?>

											<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

										<?php }

									}else{ 
										echo '<option value="">Cadastre um Caixa</option>';

									} ?>
									

								</select>

							</div> 
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Gerente</label>
								<select class="form-select mt-1" aria-label="Default select example" name="gerente">
									<?php 
									$query = $pdo->query("SELECT * from usuarios where nivel = 'Administrador' order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if($total_reg > 0){ 

										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){	}
												?>

											<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

										<?php }

									}else{ 
										echo '<option value="">Cadastre um Administrador</option>';

									} ?>


								</select>
							</div>  
						</div>
					</div>




					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Valor Abertura</label>
								<input type="text" class="form-control" id="valor_ab" name="valor_ab" placeholder="Valor da Abertura" required="" >
							</div> 
						</div>

						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Senha Gerente</label>
								<input type="password" class="form-control" id="senha_gerente" name="senha_gerente" placeholder="Senha Gerente" required="" >
							</div> 
						</div>
					</div>

					

					<small><div align="center" class="mt-1" id="mensagem-abertura">
						
					</div> </small>

				</div>
				<div class="modal-footer">
					
					<button name="btn-salvar-perfil" id="btn-salvar-abertura" type="submit" class="btn btn-primary">Abrir Caixa</button>

					<input name="id-abertura" type="hidden" value="<?php echo @$id_usu ?>">

					

				</div>
			</form>
		</div>
	</div>
</div>






<div class="modal fade" tabindex="-1" id="modalFechamento" data-bs-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Fechar Caixa</h5>

				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="POST" id="form-abertura">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Caixa</label>
								
								<select class="form-select mt-1" aria-label="Default select example" name="caixa">
									<?php 
									$query = $pdo->query("SELECT * from caixas order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if($total_reg > 0){ 

										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){	}
												?>

											<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

										<?php }

									}else{ 
										echo '<option value="">Cadastre um Caixa</option>';

									} ?>
									

								</select>

							</div> 
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Gerente</label>
								<select class="form-select mt-1" aria-label="Default select example" name="gerente">
									<?php 
									$query = $pdo->query("SELECT * from usuarios where nivel = 'Administrador' order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);
									if($total_reg > 0){ 

										for($i=0; $i < $total_reg; $i++){
											foreach ($res[$i] as $key => $value){	}
												?>

											<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

										<?php }

									}else{ 
										echo '<option value="">Cadastre um Administrador</option>';

									} ?>


								</select>
							</div>  
						</div>
					</div>




					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Valor Abertura</label>
								<input type="text" class="form-control" id="valor_ab" name="valor_ab" placeholder="Valor da Abertura" required="" >
							</div> 
						</div>

						<div class="col-md-6">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Senha Gerente</label>
								<input type="password" class="form-control" id="senha_gerente" name="senha_gerente" placeholder="Senha Gerente" required="" >
							</div> 
						</div>
					</div>

					

					<small><div align="center" class="mt-1" id="mensagem-abertura">
						
					</div> </small>

				</div>
				<div class="modal-footer">

					<a href="pdv.php" class="btn btn-primary">Voltar caixa</a>
					
					<button name="btn-salvar-perfil" id="btn-salvar-abertura" type="submit" class="btn btn-danger">Fechar Caixa</button>

					<input name="id-abertura" type="hidden" value="<?php echo @$id_usu ?>">

					

				</div>
			</form>
		</div>
	</div>
</div>



<script type="text/javascript">
	$(document).ready(function() {
		var aberto = "<?=$aberto?>";
		if(aberto === 'Sim'){
			var myModal = new bootstrap.Modal(document.getElementById('modalFechamento'), {
		});
		}else{
			var myModal = new bootstrap.Modal(document.getElementById('modalAbertura'), {
		});
		}
		

		myModal.show();
	} );
</script>






<script type="text/javascript">
	$("#form-abertura").submit(function () {
		
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "abertura.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {

				$('#mensagem-abertura').removeClass()

				if (mensagem.trim() == "Aberto com sucesso") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar-perfil').click();
                    window.location = "pdv.php";

                } else {

                	$('#mensagem-abertura').addClass('text-danger')
                }

                $('#mensagem-abertura').text(mensagem)

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

