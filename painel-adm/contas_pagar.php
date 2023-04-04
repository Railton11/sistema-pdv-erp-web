<?php

$pag = 'contas_pagar';
require_once("../conexao.php");
require_once("verificar-permissao.php");

?>
<a class="btn btn-primary mt-2" href='index.php?pagina=<?php echo $pag ?>&funcao=novo' role="button">Nova Conta</a>

<div class="mt-4">
    <?php
    // PERCORRER LISTA DE USUÁRIOS
    $query = $pdo->query("SELECT * from contas_pagar order by id desc");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){ ?>
    
    <table id="example" class="table table-hover my-2">
            <thead>
                <tr>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Usuário</th>
                    <th>Descrição</th>
                    <th>Pago</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                for($i=0; $i <$total_reg; $i++){
                    foreach($res[$i] as $key => $value){

                    }
                    $id_usu = $res[$i]['usuario'];
                    $query_p = $pdo->query("SELECT * from usuarios where id = '$id_usu'");
                    $res_p = $query_p->fetchAll(PDO::FETCH_ASSOC);
                    $nome_usu = $res_p[0]["nome"];

                ?>
                <tr>
                    <td>R$ <?php echo number_format($res[$i]["valor"], 2, ',', '.'); ?></td>
                    <td><?php echo implode('/', array_reverse(explode('-', $res[$i]["data"]))); ?></td>
                    <td><?php echo $nome_usu ?></td>
                    <td><?php echo $res[$i]["descricao"] ?></td>
                    <td><?php echo $res[$i]["pago"] ?></td>
                    <td>
                        <?php if($res[$i]['pago'] != 'Sim'){ ?>
                        <a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $res[$i]['id'] ?>" style="text-decoration: none;">
                            <i class="bi bi-pencil-square text-primary" title="Editar Registro"></i>
                        </a>
                        <a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $res[$i]['id'] ?>" style="text-decoration: none;">
                            <i class="bi bi-trash3 text-danger mx-2" title="Excluir Registro"></i>
                        </a>
                        </a>
                        <a href="index.php?pagina=<?php echo $pag ?>&funcao=pagar&id=<?php echo $res[$i]['id'] ?>" style="text-decoration: none;">
                            <i class="bi bi-cash-coin text-success" title="Pagar"></i>
                        </a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
    </table>
    <?php }else{
        echo "<p>Não existem dados para serem exibidos!";
    } ?>
</div>

<?php
if(@$_GET['funcao'] == "editar"){
    $titulo_modal = "Editar registro";
    $query = $pdo->query("SELECT * from contas_pagar WHERE id = '$_GET[id]'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){
        $descricao = $res[0]['descricao'];
        $valor = $res[0]['valor'];
    }
}else{
    $titulo_modal = "Inserir registro";
}
?>

<div class="modal fade" tabindex="-1" id="modalCadastrar" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $titulo_modal ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Valor</label>
                        <input type="text" class="form-control" name="valor" id="valor" required="" value="<?php echo number_format(@$valor, 2, ',', '.') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Descrição</label>
                        <textarea type="text" class="form-control" name="descricao" id="descricao" valu="<?php echo @$descricao ?>"></textarea>
                    </div> 

                    <div align="center" class="mt-1" id="mensagem">
						
					</div>
                </div>

                <div class="modal-footer">
                    <button name="btn-fechar" id="btn-fechar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button name="btn-salvar" id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>

                    <input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">

                    <input name="antigo" type="hidden" value="<?php echo @$nome ?>">

                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modalDeletar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir conta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form-excluir">
                <div class="modal-body">
                    <p>Deseja realmente excluir essa conta?</p>
                    <div align="center" class="mt-1" id="mensagem-deletar">
						
					</div>
                </div>

                <div class="modal-footer">
                    <button name="btn-fechar-exluir" id="btn-fechar-exluir" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button name="btn-deletar" id="btn-deletar" type="submit" class="btn btn-danger">Excluir</button>

                    <input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modalPagar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pagamento de conta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form-pagar">
                <div class="modal-body">
                    <p>Deseja realmente pagar essa conta?</p>
                    <div align="center" class="mt-1" id="mensagem-pagar">
						
					</div>
                </div>

                <div class="modal-footer">
                    <button name="btn-fechar-pagar" id="btn-fechar-pagar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button name="btn-pagar" id="btn-pagar" type="submit" class="btn btn-success">Pagar</button>

                    <input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">
                </div>
            </form>
        </div>
    </div>
</div>

<?php

if(@$_GET['funcao'] == 'novo'){ ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(
            document.getElementById("modalCadastrar"));
        myModal.show();
    </script>
<?php } ?>

<?php

if(@$_GET['funcao'] == 'editar'){ ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(
            document.getElementById("modalCadastrar"));
        myModal.show();
    </script>
<?php } ?>

<?php

if(@$_GET['funcao'] == 'deletar'){ ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(
            document.getElementById("modalDeletar"));
        myModal.show();
    </script>
<?php } ?>

<?php

if(@$_GET['funcao'] == 'pagar'){ ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(
            document.getElementById("modalPagar"));
        myModal.show();
    </script>
<?php } ?>

<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
    $("#form").submit(function () {
        var pag = "<?=$pag?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST',
            data: formData,

            success: function (mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pagina="+pag;

                } else {

                    $('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

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

<!--AJAX PARA EXCLUIR DADOS -->
<script type="text/javascript">
	$("#form-excluir").submit(function () {
		var pag = "<?=$pag?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/excluir.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {

				$('#mensagem-deletar').removeClass()

				if (mensagem.trim() == "Excluído com Sucesso!") {

                    $('#btn-fechar-exluir').click();
                    window.location = "index.php?pagina="+pag;

                } else {

                	$('#mensagem-deletar').addClass('text-danger')
                }

                $('#mensagem-deletar').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            
        });
	});
</script>

<!--AJAX PARA PAGAR DADOS -->
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

				if (mensagem.trim() == "Pago com Sucesso!") {

                    $('#btn-fechar-pagar').click();
                    window.location = "index.php?pagina="+pag;

                } else {

                	$('#mensagem-pagar').addClass('text-success')
                }

                $('#mensagem-pagar').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            
        });
	});
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable({
            "ordering": false
        });
    });
</script>

<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">

    function carregarImg() {

        var target = document.getElementById('target');
        var file = document.querySelector("input[type=file]").files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);


        } else {
            target.src = "";
        }
    }

</script>