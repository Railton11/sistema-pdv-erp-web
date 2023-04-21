<?php 

@session_start();
$id_usuario = $_SESSION['id_usuario'];
require_once('../conexao.php');
require_once('verificar-permissao.php');

$pag = 'pdv';

//VERIFICAR SE O CAIXA ESTÁ ABERTO
$query = $pdo->query("SELECT * from caixa where operador = '$id_usuario' and status = 'Aberto' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){ 
  echo "<script language='javascript'>window.location='index.php'</script>";
}
if($desconto_porcentagem == "Sim"){
  $desc = '%';
}else{
  $desc = 'R$';
}

?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="pt-br">
<head>
  <title>Caixa</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"/>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

  <link rel="stylesheet" href="../recurso/css/telapdv.css" type="text/css" media="all"/>
  <link rel="shortcut icon" href="../imagem/logo-icone.ico" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

</head>
<body>


  <div class='checkout'>
    <div class="row">
      <div class="col-md-5 col-sm-12">
        <div class='order py-2'>
          <p class="background">LISTA DE PRODUTOS</p>

          <span id="listar"></span>
          
        </div>
      </div>
      <div id='payment' class='payment col-md-7'>
        <form method="post" id="form-buscar">
          <div class="row py-2">
            <div class="col-md-7">
              <p class="background">CÓDIGO DE BARRAS</p>
              <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código de barras">

              <p class="background mt-3">PRODUTO</p>
              <input type="text" class="form-control" id="produto" name="produto" placeholder="Produto">

              <p class="background mt-3">DESCRIÇÃO</p>
              <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição do produto">

              <div class="row">
                <div class="col-6">
                  <p class="background mt-3">QUANTIDADE</p>
                  <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade">

                  <p class="background mt-3">VALOR UNITÁRIO</p>
                  <input type="text" class="form-control" id="valor_unitario" name="valor_unitario" placeholder="Valor unitário">

                  <p class="background mt-3">ESTOQUE</p>
                  <input type="text" class="form-control" id="estoque" name="estoque" placeholder="Estoque">
                </div>
                <div class="col-6 mt-4">
                  <img id="imagem" src="" width="100%">
                </div>
              </div>

            </div>

            <div class="col-md-5">
              <p class="background">TOTAL DO ITEM</p>
              <input type="text" class="form-control" id="total_item" name="total_item" placeholder="Total do Item">

              <p class="background mt-1">SUB TOTAL</p>
              <input type="text" class="form-control" id="sub_total_item" name="sub_total_item" placeholder="Sub total">

              <p class="background mt-1">DESCONTO EM <?php echo $desc ?></p>
              <input type="text" class="form-control" id="desconto" name="desconto" placeholder="Desconto em <?php echo $desc ?>">

              <!--<p class="background mt-1">TOTAL DO ITEM</p>
              <input type="text" class="form-control" id="total_item2" name="total_item" placeholder="Total do Item" required="">-->

              <p class="background mt-1">TOTAL DA COMPRA</p>
              <input type="text" class="form-control" id="total_compra" name="total_compra" placeholder="Total da compra" required="">

              <p class="background mt-1">VALOR RECEBIDO</p>
              <input type="text" class="form-control  form-control-md" id="valor_recebido" name="valor_recebido" placeholder="R$ 0,00" >

              <p class="background mt-1">TROCO</p>
              <input type="text" class="form-control" id="valor_troco" name="valor_troco" placeholder="Troco">
              <input type="hidden" name="forma_pgto_input" id="forma_pgto_input">
            </div>
          </div>
        </form>
      </div>
      

    </div>
  </div>
  <div class="modal fade" tabindex="-1" id="modalDeletar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form-excluir">
                <div class="modal-body">
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
                  <div class="mb-3">
								    <label for="exampleFormControlInput1" class="form-label">Senha Gerente</label>
								    <input type="password" class="form-control" id="senha_gerente" name="senha_gerente" placeholder="Senha Gerente" required="" >
							    </div>
                  <div align="center" class="mt-1" id="mensagem-deletar"></div>

                </div>

                <div class="modal-footer">
                    <button name="btn-fechar-exluir" id="btn-fechar-exluir" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button name="btn-deletar" id="btn-deletar" type="submit" class="btn btn-danger">Excluir</button>

                    <input name="id" type="hidden" id="id_deletar_item">
                </div>
            </form>
        </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" id="modalVenda">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Fechar venda</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form-fechar-venda">
                <div class="modal-body">
                  <div class="mb-3">
								    <label for="exampleFormControlInput1" class="form-label">Forma de pagamento</label>
								    <select class="form-select mt-1" aria-label="Default select example" name="forma_pgto" id="forma_pgto">
									    <?php 
									      $query = $pdo->query("SELECT * from forma_pgtos order by id asc");
									      $res = $query->fetchAll(PDO::FETCH_ASSOC);
									      $total_reg = @count($res);
									      if($total_reg > 0){ 

										      for($i=0; $i < $total_reg; $i++){
											      foreach ($res[$i] as $key => $value){	}
												    ?>

											      <option value="<?php echo $res[$i]['codigo'] ?>"><?php echo $res[$i]['nome'] ?></option>

										    <?php }

									      }else{ 
										      echo '<option value="">Cadastre um forma de pagamento</option>';

									    } ?>


								    </select>
							    </div>
                  <div align="center" class="mt-1" id="mensagem-venda"></div>

                </div>

                <div class="modal-footer">
                    <button name="btn-fechar-venda" id="btn-fechar-venda" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button name="btn-venda" id="btn-venda" type="submit" class="btn btn-success">Fechar Venda</button>
                </div>
            </form>
        </div>
    </div>
  </div>

</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
    listarProdutos();
    buscarDados();
    document.getElementById('codigo').focus();
    document.getElementById('quantidade').value = '1';
    $('#imagem').attr('src', '../imagem/produtos/sem-foto.png');
	} );
</script>

<!--AJAX PARA BUSCAR DADOS PARA INPUTS -->
<script type="text/javascript">
	$("#codigo").keyup(function () {
    buscarDados();
	});
</script>
<script type="text/javascript">
    var pag = "<?=$pag?>";
	  function buscarDados(){
        $.ajax({
            url: pag + "/buscar-dados.php",
            method: 'POST',
            data: $('#form-buscar').serialize(),
            dataType: "html",
            
            success:function(result){
              $('#mensagem-venda').text("");
              if(result.trim() === "Venda Salva!"){
          
                $('#btn-fechar-venda').click();
                window.location = "pdv.php";
                return;
              }
              if(result.trim() === "Não é possível efetuar uma venda sem itens!"){
                $('#mensagem-venda').addClass('text-danger')
                $('#mensagem-venda').text(result)
                document.getElementById('forma_pgto_input').value = "";
                return;
              }
              var array = result.split("&-/z");
              if(array.length == 2){
                var ms1 = array[0];
                var ms2 = array[1];
                window.alert(ms1 + ms2)
              }else{
                var estoque = array[0];
                var nome = array[1];
                var descricao = array[2];
                var imagem = array[3];
                var valor = array[4];
                var subtotal = array[5];
                var subtotalF = array[6];
                var totalVenda = array[7];
                var totalVendaF = array[8];
                var troco = array[9];
                var trocoF = array[10];

                document.getElementById('total_compra').value = "R$ " + totalVendaF;
              
                document.getElementById('valor_troco').value = "R$ " + trocoF;

                if(nome.trim() != "Código não cadastrado"){
                  document.getElementById('estoque').value = estoque;
                  document.getElementById('produto').value = nome;
                  document.getElementById('descricao').value = descricao;
                  //formatar_valor_unit = "R$ " + valor.replace('.',',');
                  document.getElementById('valor_unitario').value = valor;
                  if(imagem !== undefined && imagem.trim() === ""){
                    $('#imagem').attr('src', '../imagem/produtos/sem-foto.png');
                  }else{
                    $('#imagem').attr('src', '../imagem/produtos/'+imagem);
                  }
                  
                  var audio = new Audio('../imagem/barCode.wav');
                  audio.addEventListener('canplaythrough', function() {
                    audio.play();
                  });
                  formatar_total_item = "R$ " + valor.replace('.',',');
                  document.getElementById('total_item').value = formatar_total_item;
                  document.getElementById('sub_total_item').value = "R$ " + subtotalF;
                  document.getElementById('codigo').value = "";     
                  
                  listarProdutos();
                }
              }
            }
        });
    }
</script>

<!--AJAX PARA MOSTRAR OS ITENS DA VENDA -->
<script type="text/javascript">
    var pag = "<?=$pag?>";
	  function listarProdutos(){
        $.ajax({
            url: pag + "/listar-produtos.php",
            method: 'POST',
            data: $('#form-listar').serialize(),
            dataType: "html",
            
            success:function(result){
              $("#listar").html(result);
            }
        });
    }
</script>

<!--AJAX PARA EXCLUIR DADOS -->
<script type="text/javascript">
	$("#form-excluir").submit(function () {
		var pag = "<?=$pag?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/excluir-item.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {

				$('#mensagem-deletar').removeClass()

				if (mensagem.trim() == "Excluído com Sucesso!") {

                    $('#btn-fechar-exluir').click();
                    window.location = "pdv.php";

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
    function modalExcluir(id){
        document.getElementById('id_deletar_item').value = id;
        var myModal = new bootstrap.Modal(
            document.getElementById("modalDeletar"));
        myModal.show();
    }
</script>

<!--AJAX PARA DAR DESCONTO -->
<script type="text/javascript">
	$("#desconto").keyup(function () {
        buscarDados();
		});
</script>

<!--AJAX PARA VALOR RECEBIDO -->
<script type="text/javascript">
	$("#valor_recebido").keyup(function () {
        buscarDados();
		});
</script>

<script type="text/javascript">
	$(document).keypress(function (e) {
        if(e.which == 13){
          var myModal = new bootstrap.Modal(
            document.getElementById("modalVenda"));
          myModal.show();
        }
		});
</script>

<script type="text/javascript">
    $("#form-fechar-venda").submit(function () {
        event.preventDefault();
        var pgto = document.getElementById('forma_pgto').value;
        document.getElementById('forma_pgto_input').value = pgto;
        buscarDados();
    });
</script>