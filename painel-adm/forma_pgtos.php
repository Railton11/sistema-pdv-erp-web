<?php

$pag = 'forma_pgtos';
require_once("../conexao.php");
require_once("verificar-permissao.php");

?>
<a class="btn btn-primary mt-2" href='index.php?pagina=<?php echo $pag ?>&funcao=novo' role="button">Nova Forma</a>

<div class="mt-4">
    <?php
    // PERCORRER LISTA DE USUÁRIOS
    $query = $pdo->query("SELECT * from forma_pgtos order by nome asc");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){ ?>
    
    <table id="example" class="table table-hover my-2">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                for($i=0; $i <$total_reg; $i++){
                    foreach($res[$i] as $key => $value){

                    }

                ?>
                <tr>
                    <td><?php echo $res[$i]["codigo"] ?></td>
                    <td><?php echo $res[$i]["nome"] ?></td>
                    <td>
                        <a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $res[$i]['id'] ?>" style="text-decoration: none;">
                            <i class="bi bi-pencil-square text-primary" title="Editar Registro"></i>
                        </a>
                        <a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $res[$i]['id'] ?>" style="text-decoration: none;">
                            <i class="bi bi-trash3 text-danger mx-2" title="Excluir Registro"></i>
                        </a>
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
    $titulo_modal = "Editar caixa";
    $query = $pdo->query("SELECT * from forma_pgtos WHERE id = '$_GET[id]'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){
        $nome = $res[0]['nome'];
        $codigo = $res[0]['codigo'];
    }
}else{
    $titulo_modal = "Inserir forma de pagamento";
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
                        <label for="exampleFormControlInput1" class="form-label">Código</label>
                        <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Código do pagamento" required="" value="<?php echo @$codigo ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do caixa" required="" value="<?php echo @$nome ?>">
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
                <h5 class="modal-title">Excluir forma de pagamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form-excluir">
                <div class="modal-body">
                    <p>Deseja realmente excluir?</p>
                    <div align="center" class="mt-1" id="mensagem-deletar">
						
					</div>
                </div>

                <div class="modal-footer">
                    <button name="btn-fechar-exluir" id="btn-fechar-exluir" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button name="btn-deletar" id="btn-deletar" type="submit" class="btn btn-danger">Excluir</button>

                    <input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">
                    <input name="antigo" type="hidden" value="<?php echo @$codigo ?>">
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

<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable({
            "ordering": false
        });
    });
</script>
