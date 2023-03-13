<?php

$pag = 'usuarios';

?>
<a class="btn btn-primary mt-2" href='index.php?pagina=<?php echo $pag ?>&funcao=novo' role="button">Novo Usuario</a>

<div class="modal fade" tabindex="-1" id="modalCadastrar" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inserir Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required="">
                            </div>
                        </div>    
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">CPF</label>
                                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF" required="">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Senha</label>
                        <input type="text" class="form-control" name="senha" id="senha" placeholder="Senha" required="">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nível</label>
                        <select class="form-select mt-1" aria-label="Default select example" name="nivel">

							<option <?php if(@$nivel == 'Operador'){ ?> selected <?php } ?>  value="Operador">Operador</option>
							
                            <option <?php if(@$nivel == 'Administrador'){ ?> selected <?php } ?>  value="Administrador">Administrador</option>

							<option <?php if(@$nivel == 'Tesoureiro'){ ?> selected <?php } ?>  value="Tesoureiro">Tesoureiro</option>
                        </select>
                        
                    </div>
                    <div align="center" class="mt-1" id="mensagem">
						
					</div>
                </div>

                <div class="modal-footer">
                    <button name="btn-fechar" id="btn-fechar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button name="btn-salvar" id="btn-salvar" type="submit" class="btn btn-primary">Salvar</button>
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
                    //window.location = "index.php?pag="+pag;

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

