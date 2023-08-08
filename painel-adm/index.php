<?php

@session_start();
require_once("../conexao.php");
require_once("verificar-permissao.php");

// VARIAVEIS DO MENU ADMINISTRATIVO
$menu1 = "home";
$menu2 = "usuarios";
$menu3 = "fornecedores";
$menu4 = "categorias";
$menu5 = "produtos";
$menu6 = "compras";
$menu7 = "contas_pagar";
$menu8 = "contas_receber";
$menu9 = "movimentacoes";
$menu10 = "contas_pagar_vencidas";
$menu11 = "contas_pagar_hoje";
$menu12 = "contas_receber_vencidas";
$menu13 = "caixas";
$menu14 = "forma_pgtos";
$menu15 = "vendas";
$menu16 = "aberturas";
$menu17 = "estoque";


// RECUPERAR DADOS DO USUÁRIO
$query = $pdo->query("SELECT * from usuarios WHERE id = '$_SESSION[id_usuario]'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$nome_usu = $res[0]['nome'];
$email_usu = $res[0]['email'];
$cpf_usu = $res[0]['cpf'];
$senha_usu = $res[0]['senha'];
$nivel_usu = $res[0]['nivel'];
$id_usu = $res[0]['id'];

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Painel Administrativo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../recurso/DataTables/datatables.min.css"/>
        <script type="text/javascript" src="../recurso/DataTables/datatables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="shortcut icon" href="../imagem/logo-icone.ico" />
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php"><img src="../imagem/logo.png" class="img-fluid" width="94px" height="60px" alt="Logo"/></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php?pagina=<?php echo $menu1 ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?pagina=<?php echo $menu2 ?>">Usuários</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?pagina=<?php echo $menu3 ?>">Fornecedores</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Produtos
                                </a>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu17 ?>">Estoque</a></li>
                                    <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu5 ?>">Cadastro de produtos</a></li>
                                    <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu4 ?>">Cadastro de categorias</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Financeiro
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu9 ?>">Movimentações</a></li>
                                    <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu6 ?>">Lista de compras</a></li>
                                    <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu14 ?>">Forma pagamentos</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Contas
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu7 ?>">Contas pagar</a></li>
                                    <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu8 ?>">Contas receber</a></li>
                                    <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu11 ?>">Pagar hoje</a></li>
                                    <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu10 ?>">Pagar contas vencidas</a></li>
                                    <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu12 ?>">Receber contas vencidas</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Vendas / Caixas
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu13 ?>">Caixas</a></li>
                                    <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu15 ?>">Vendas</a></li>
                                    <li><a class="dropdown-item" href="index.php?pagina=<?php echo $menu16 ?>">Caixa Aberto / Fechados</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Relatórios
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../rel/relProdutos_class.php" target="_blank">Relatório de produtos</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalRelCompras" href="">Relatório de compras</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalRelContas" href="">Relatório de contas pagar</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalRelContasRec" href="">Relatório de contas receber</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalRelMov" href="">Relatório de movimentações</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalRelVendas" href="">Relatório de vendas</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="d-flex">
                            <div class="btn-group">
                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; color: #363636;">
                                    <img src="../imagem/icone-usuario.png" width="49px" height="49px" alt="usuário padrão"/>
                                    <font face="Verdana"><?php echo $nome_usu; ?></font>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    <li><button class="dropdown-item" type="button" href="" data-bs-toggle="modal" data-bs-target="#modalPerfil">Editar Perfil</button></li>
                                    <li><a class="dropdown-item" type="button" href="../logout.php">Sair</a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <div class="container-fluid mt-4">
                <?php
                
                if(@$_GET['pagina'] == $menu1){
                    require_once($menu1. ".php");
                }
                else if(@$_GET['pagina'] == $menu2){
                    require_once($menu2. ".php");
                }
                else if(@$_GET['pagina'] == $menu3){
                    require_once($menu3. ".php");
                }
                else if(@$_GET['pagina'] == $menu4){
                    require_once($menu4. ".php");
                }
                else if(@$_GET['pagina'] == $menu5){
                    require_once($menu5. ".php");
                }
                else if(@$_GET['pagina'] == $menu6){
                    require_once($menu6. ".php");
                }
                else if(@$_GET['pagina'] == $menu7){
                    require_once($menu7. ".php");
                }
                else if(@$_GET['pagina'] == $menu8){
                    require_once($menu8. ".php");
                }
                else if(@$_GET['pagina'] == $menu9){
                    require_once($menu9. ".php");
                }
                else if(@$_GET['pagina'] == $menu10){
                    require_once($menu10. ".php");
                }
                else if(@$_GET['pagina'] == $menu11){
                    require_once($menu11. ".php");
                }
                else if(@$_GET['pagina'] == $menu12){
                    require_once($menu12. ".php");
                }
                else if(@$_GET['pagina'] == $menu13){
                    require_once($menu13. ".php");
                }
                else if(@$_GET['pagina'] == $menu14){
                    require_once($menu14. ".php");
                }
                else if(@$_GET['pagina'] == $menu15){
                    require_once($menu15. ".php");
                }
                else if(@$_GET['pagina'] == $menu16){
                    require_once($menu16. ".php");
                }
                else if(@$_GET['pagina'] == $menu17){
                    require_once($menu17. ".php");
                }
                else{
                    require_once($menu1. ".php");
                }
                ?>
            </div>
        </main>

        <div class="modal fade" tabindex="-1" id="modalPerfil" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Perfil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="form-perfil">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nome</label>
                                        <input type="text" class="form-control" name="nome-perfil" id="nome-perfil" placeholder="Nome" required="" value="<?php echo @$nome_usu ?>">
                                    </div>
                                </div>    
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">CPF</label>
                                        <input type="text" class="form-control" name="cpf-perfil" id="cpf-perfil" placeholder="CPF" required="" value="<?php echo @$cpf_usu ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email-perfil" id="email-perfil" placeholder="Email" required="" value="<?php echo @$email_usu ?>">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Senha</label>
                                <input type="text" class="form-control" name="senha-perfil" id="senha-perfil" placeholder="Senha" required="" value="<?php echo @$senha_usu ?>">
                            </div>

                            <div align="center" class="mt-1" id="mensagem-perfil">
                                        
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button name="btn-editar-fechar" id="btn-editar-fechar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button name="btn-salvar-perfil" id="btn-salvar-perfil" type="submit" class="btn btn-primary">Salvar</button>

                            <input name="id-perfil" type="hidden" value="<?php echo @$id_usu ?>">

                            <input name="antigo-perfil" type="hidden" value="<?php echo @$cpf_usu ?>">

                            <input name="antigo2-perfil" type="hidden" value="<?php echo @$email_usu ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        

        <!--  Modal Rel Compras-->
        <div class="modal fade" id="ModalRelCompras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Compras</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../rel/relCompras_class.php" method="POST" target="_blank">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Data Inicial</label>
                                        <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataInicial" >
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label >Data Final</label>
                                        <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataFinal" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Pago</label>
                                        <select class="form-select" name="status">
                                            <option value="">Todas</option>
                                            <option value="Sim">Sim</option>
                                            <option value="Não">Não</option>
                                        
                                        </select>
                                    </div>
                                </div>

                            </div>     

                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--  Modal Rel Vendas-->
        <div class="modal fade" id="ModalRelVendas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Vendas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../rel/relVendas_class.php" method="POST" target="_blank">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Data Inicial</label>
                                        <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataInicial_venda" >
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label >Data Final</label>
                                        <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataFinal_venda" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Status</label>
                                        <select class="form-select" name="status_venda">
                                            <option value="">Todas</option>
                                            <option value="Concluída">Concluída</option>
                                            <option value="Cancelada">Cancelada</option>
                                        
                                        </select>
                                    </div>
                                </div>

                            </div>     

                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--  Modal Rel Contas-->
        <div class="modal fade" id="ModalRelContas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Contas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../rel/relContas_class.php" method="POST" target="_blank">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Data Inicial</label>
                                        <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataInicial" >
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label >Data Final</label>
                                        <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataFinal" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Pago</label>
                                        <select class="form-select" name="status">
                                            <option value="">Todas</option>
                                            <option value="Sim">Sim</option>
                                            <option value="Não">Não</option>
                                        
                                        </select>
                                    </div>
                                </div>

                            </div>     

                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--  Modal Rel Movimentação-->
        <div class="modal fade" id="ModalRelMov" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Movimentações</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../rel/relMov_class.php" method="POST" target="_blank">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Data Inicial</label>
                                        <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataInicial" >
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label >Data Final</label>
                                        <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataFinal" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Status</label>
                                        <select class="form-select" name="status">
                                            <option value="">Todas</option>
                                            <option value="Entrada">Entradas</option>
                                            <option value="Saída">Saídas</option>
                                        
                                        </select>
                                    </div>
                                </div>

                            </div>     

                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--  Modal Rel Contas Receber-->
        <div class="modal fade" id="ModalRelContasRec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Contas receber</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../rel/relContasRec_class.php" method="POST" target="_blank">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Data Inicial</label>
                                        <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataInicial" >
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label >Data Final</label>
                                        <input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control"  name="dataFinal" >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Pago</label>
                                        <select class="form-select" name="status">
                                            <option value="">Todas</option>
                                            <option value="Sim">Sim</option>
                                            <option value="Não">Não</option>
                                        
                                        </select>
                                    </div>
                                </div>

                            </div>     

                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        <script type="text/javascript" src="../recurso/js/mascaras.js"></script>

        <script type="text/javascript">
            $("#form-perfil").submit(function () {
                event.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: "editar-perfil.php",
                    type: 'POST',
                    data: formData,

                    success: function (mensagem) {

                        $('#mensagem-perfil').removeClass()

                        if (mensagem.trim() == "Salvo com Sucesso!") {

                            //$('#nome').val('');
                            //$('#cpf').val('');
                            $('#btn-editar-fechar').click();
                            //window.location = "index.php?pagina="+pag;

                        } else {

                            $('#mensagem-perfil').addClass('text-danger')
                        }

                        $('#mensagem-perfil').text(mensagem)

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
    </body>
</html>

