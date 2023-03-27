<?php

$pag = 'produtos';
require_once("../conexao.php");
require_once("verificar-permissao.php");

?>
<a class="btn btn-primary mt-2" href='index.php?pagina=<?php echo $pag ?>&funcao=novo' role="button">Nova Produto</a>

<div class="mt-4">
    <?php
    // PERCORRER LISTA DE USUÁRIOS
    $query = $pdo->query("SELECT * from produtos order by id desc");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){ ?>
    
    <table id="example" class="table table-hover my-2">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Código</th>
                    <th>Estoque</th>
                    <th>Valor de compra</th>
                    <th>Valor de venda</th>
                    <th>Fornecedor</th>
                    <th>Foto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                for($i=0; $i <$total_reg; $i++){
                    foreach($res[$i] as $key => $value){

                    }
                    $id_cat = $res[$i]['categoria'];
                    $query_2 = $pdo->query("SELECT * FROM categorias WHERE id = '$id_cat'");
                    $res_2 = $query_2->fetchAll(PDO::FETCH_ASSOC);
                    $nome_categoria = $res_2[0]['nome'];

                    // BUSCAR OS DADOS DO FORNECEDOR
                    $id_forn = $res[$i]['fornecedor'];
                    $query_f = $pdo->query("SELECT * from fornecedores where id = '$id_forn'");
                    $res_f = $query_f->fetchAll(PDO::FETCH_ASSOC);
                    $total_reg_f = @count($res_f);
                    if($total_reg_f > 0){
                        $nome_forn = $res_f[0]['nome'];
                        $tel_forn = $res_f[0]['telefone'];
                    }else {
                        $nome_forn = 'Fornecedor não existe';
                        $tel_forn = 'Telefone não existe';
                    }

                ?>
                <tr>
                    <td><?php echo $res[$i]["nome"] ?></td>
                    <td><?php echo $res[$i]["codigo"] ?></td>
                    <td><?php echo $res[$i]["estoque"] ?></td>
                    <td>R$ <?php echo number_format($res[$i]["valor_compra"], 2, ',', '.'); ?></td>
                    <td>R$ <?php echo number_format($res[$i]["valor_venda"], 2, ',', '.'); ?></td>
                    <td><?php echo $nome_forn ?></td>
                    <td><img src="../imagem/produtos/<?php echo $res[$i]['foto'] ?>" width="40px"></td>
                    <td>
                        <a href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $res[$i]['id'] ?>" title="Editar produto">
                            <i class="bi bi-pencil-square text-primary" ></i>
                        </a>
                        <a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $res[$i]['id'] ?>" title="Excluir produto">
                            <i class="bi bi-trash3 text-danger mx-2" ></i>
                        </a>
                        <a href="#" onclick="mostrarDados('<?php echo $res[$i]['nome'] ?>', '<?php echo $nome_categoria ?>', '<?php echo $res[$i]['descricao'] ?>', '<?php echo $nome_forn ?>', '<?php echo $tel_forn ?>')" title="Mais informações">
                            <i class="bi bi-three-dots text-dark mx-1"></i>
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
    $titulo_modal = "Editar produto";
    $query = $pdo->query("SELECT * from produtos WHERE id = '$_GET[id]'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){
        $nome = $res[0]['nome'];
        $descricao = $res[0]['descricao'];
        $estoque = $res[0]['estoque'];
        $valor_compra = $res[0]['valor_compra'];
        $valor_venda = $res[0]['valor_venda'];
        $fornecedor = $res[0]['fornecedor'];
        $categoria = $res[0]['categoria'];
        $codigo = $res[0]['codigo'];
        $foto = $res[0]['foto'];
        
    }
}else{
    $titulo_modal = "Inserir produto";
}
?>

<div class="modal fade" tabindex="-1" id="modalCadastrar" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $titulo_modal ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form">
                <div class="modal-body">
                    <div class="row">
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Código</label>
								<input type="number" class="form-control" id="codigo" name="codigo" placeholder="Código do produto" required="" value="<?php echo @$codigo ?>">
							</div> 

						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do produto" required="" value="<?php echo @$nome ?>">
							</div> 
						</div>
						<div class="col-md-4">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Valor de venda</label>
								<input type="text" class="form-control" id="valor_venda" name="valor_venda" placeholder="Valor de venda do produto" required="" value="<?php echo @$valor_venda ?>">
							</div> 
						</div>
					</div>
                    <div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Descrição do produto</label>
						<textarea type="text" class="form-control" id="descricao" name="descricao" maxlenght="200"><?php echo @$descricao ?></textarea>
					</div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3"> 
                                <label for="exampleFormControlInput1" class="form-label">Categoria</label>
                                <select class="form-select mt-1" aria-label="Default select example" name="categoria">
                                    <?php 
							        $query = $pdo->query("SELECT * from categorias order by nome asc");
							        $res = $query->fetchAll(PDO::FETCH_ASSOC);
							        $total_reg = @count($res);
							        if($total_reg > 0){
                                        for($i=0; $i <$total_reg; $i++){
                                            foreach($res[$i] as $key => $value){
                        
                                            }
										    ?>
                                            <option <?php if(@$categoria == $res[$i]['id']){ ?> selected <?php } ?>  value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
                                    <?php } 
                                    }else{
                                        echo "<option value=''>Cadastre categoria</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Foto do produto</label>
                                <input type="file" class="form-control" name="imagem" id="imagem" valu="<?php echo @$foto ?>" onChange="carregarImg();">
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <?php if (@$foto != ""){ ?>
                                    <img src="../imagem/produtos/<?php echo $foto ?>" width="200px" id="target">
                                <?php }else{ ?>
                                    <img src="../imagem/produtos/sem-foto.png" width="200px" id="target">
                                <?php } ?>
                            </div>
                           
                        </div>
                    </div>
                    <div id="codigoBarra"></div> 
                    
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
                <h5 class="modal-title">Excluir Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form-excluir">
                <div class="modal-body">
                    <p>Deseja realmente excluir essa categoria?</p>
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

<div class="modal fade" tabindex="-1" id="modalDados">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="nome-registro"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mb-3">
                <b>Categoria:</b>
                <span id="categoria-registro"></span>
                <hr>
                <span class="mr-4">
                    <b>Fornecedor:</b>
                    <span id="nome-forn-registro"></span>
                </span>
                
                <span class="mr-4">
                    <b>Telefone:</b>
                    <span id="tel-forn-registro"></span>
                </span>
                <hr>
                <b>Descrição:</b>
                <span id="descricao-registro"></span>
            </div>
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

<script type="text/javascript">
    function mostrarDados(nome, categoria, descricao, nome_forn, tel_forn){
        $('#nome-registro').text(nome);
        $('#categoria-registro').text(categoria);
        $('#descricao-registro').text(descricao);
        $('#nome-forn-registro').text(nome_forn);
        $('#tel-forn-registro').text(tel_forn);
        var myModal = new bootstrap.Modal(
            document.getElementById("modalDados"));
        myModal.show();
    }
</script>

<script type="text/javascript">
	$("#codigo").keyup(function () {
        gerarCodigo();
		});
</script>
<script type="text/javascript">
    var pag = "<?=$pag?>";
	function gerarCodigo(){
        $.ajax({
            url: pag + "/barras.php",
            method: 'POST',
            data: $('#form').serialize(),
            dataType: "html",
            
            success:function(result){
                $("#codigoBarra").html(result);
            }
        });
    }
</script>
