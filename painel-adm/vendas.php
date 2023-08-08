<?php

$pag = 'vendas';
require_once("../conexao.php");
require_once("verificar-permissao.php");

?>


<div class="mt-4">
    <?php
    // PERCORRER LISTA DE USUÁRIOS
    $query = $pdo->query("SELECT * from vendas order by id desc");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){ ?>
    
    <table id="example" class="table table-hover my-2">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Operador</th>
                    <th>Forma de pagamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    for($i=0; $i <$total_reg; $i++){
                        foreach($res[$i] as $key => $value){

                        }
                        $id_operador = $res[$i]["operador"];
                        $tipo_pgto = $res[$i]["forma_pgt"];
                        $data2 = implode('/', array_reverse(explode('-', $res[$i]['data'])));
                        $total = number_format($res[$i]['valor'], 2, ',', '.');

                        $res_2 = $pdo->query("SELECT * from forma_pgtos where codigo = '$tipo_pgto' ");
                        $dados = $res_2->fetchAll(PDO::FETCH_ASSOC);
                        $nome_pgto = $dados[0]['nome'];

                        $res_3 = $pdo->query("SELECT * from usuarios where id = '$id_operador' ");
                        $dados = $res_3->fetchAll(PDO::FETCH_ASSOC);
                        $nome_operador = $dados[0]['nome'];

                        if($res[$i]['status'] == 'Concluída'){
                            $classe = 'text-success';
                        }else{
                            $classe = 'text-danger';
                        }

                ?>
                <tr>
                    <td><span class="<?php echo $classe ?>"><?php echo $res[$i]["status"] ?></span></td>
                    <td>R$ <?php echo $total ?></td>
                    <td><?php echo $data2 ?></td>
                    <td><?php echo $res[$i]["hora"] ?></td>
                    <td><?php echo $nome_operador ?></td>
                    <td><?php echo $nome_pgto ?></td>
                    <td>
                        <a href="../painel-operador/comprovante_class.php?id=<?php echo $res[$i]['id'] ?>" target="_blank" style="text-decoration: none;">
                            <i class="bi bi-clipboard text-primary" title="Gerar comprovante"></i>
                        </a>
                        <?php if($res[$i]['status'] == 'Concluída') { ?>
                            <a href="index.php?pagina=<?php echo $pag ?>&funcao=deletar&id=<?php echo $res[$i]['id'] ?>" style="text-decoration: none;">
                                <i class="bi bi-trash3 text-danger mx-2" title="Cancelar venda"></i>
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

<div class="modal fade" tabindex="-1" id="modalDeletar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancelar venda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form-excluir">
                <div class="modal-body">
                    <p>Deseja realmente cancelar essa venda?</p>
                    <div align="center" class="mt-1" id="mensagem-deletar">
						
					</div>
                </div>

                <div class="modal-footer">
                    <button name="btn-fechar-exluir" id="btn-fechar-exluir" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button name="btn-deletar" id="btn-deletar" type="submit" class="btn btn-danger">Cancelar</button>

                    <input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">
                </div>
            </form>
        </div>
    </div>
</div>


<?php

if(@$_GET['funcao'] == 'deletar'){ ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(
            document.getElementById("modalDeletar"));
        myModal.show();
    </script>
<?php } ?>

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
