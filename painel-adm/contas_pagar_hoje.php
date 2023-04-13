<?php

$pag = 'contas_pagar';
require_once("../conexao.php");
require_once("verificar-permissao.php");

?>

<div class="mt-4">
    <?php
    // PERCORRER LISTA DE USUÁRIOS
    $query = $pdo->query("SELECT * from contas_pagar where vencimento = curDate() and pago != 'Sim' order by id asc");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){ ?>
    
    <table id="example" class="table table-hover my-2">
            <thead>
                <tr>
                    <th>Valor</th>
                    <th>Vencimento</th>
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
                    <td><?php echo implode('/', array_reverse(explode('-', $res[$i]["vencimento"]))); ?></td>
                    <td><?php echo $nome_usu ?></td>
                    <td><?php echo $res[$i]["descricao"] ?></td>
                    <td><?php echo $res[$i]["pago"] ?></td>
                    <td>
                        </a>
                        <a href="index.php?pagina=contas_pagar_hoje&funcao=pagar&id=<?php echo $res[$i]['id'] ?>" style="text-decoration: none;">
                            <i class="bi bi-cash-coin text-success" title="Pagar"></i>
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

if(@$_GET['funcao'] == 'pagar'){ ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(
            document.getElementById("modalPagar"));
        myModal.show();
    </script>
<?php } ?>

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
                    window.location = "index.php?pagina=contas_pagar_vencidas";

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