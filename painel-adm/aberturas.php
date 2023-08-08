<?php

$pag = 'aberturas';
require_once("../conexao.php");
require_once("verificar-permissao.php");

?>


<div class="mt-4">
    <?php
    // PERCORRER LISTA DE USUÁRIOS
    $query = $pdo->query("SELECT * from caixa order by id desc");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if($total_reg > 0){ ?>
    
    <table id="example" class="table table-hover my-2">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Data Abertura</th>
                    <th>Vendido</th>
                    <th>Quebra</th>
                    <th>Caixa</th>
                    <th>Operador</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    for($i=0; $i <$total_reg; $i++){
                        foreach($res[$i] as $key => $value){

                        }
                        $id_operador = $res[$i]["operador"];
                        $id_caixa = $res[$i]["caixa"];
                        $data2 = implode('/', array_reverse(explode('-', $res[$i]['data_ab'])));
                        $total_vendido = number_format($res[$i]['valor_vendido'], 2, ',', '.');
                        $total_quebra = number_format($res[$i]['valor_quebra'], 2, ',', '.');

                        $res_3 = $pdo->query("SELECT * from usuarios where id = '$id_operador' ");
                        $dados = $res_3->fetchAll(PDO::FETCH_ASSOC);
                        $nome_operador = $dados[0]['nome'];

                        $res_2 = $pdo->query("SELECT * from caixas where id = '$id_caixa' ");
                        $dados = $res_2->fetchAll(PDO::FETCH_ASSOC);
                        $nome_caixa = $dados[0]['nome'];

                        if($res[$i]['status'] == 'Fechado'){
                            $classe = 'text-success';
                        }else{
                            $classe = 'text-danger';
                        }

                ?>
                <tr>
                    <td><span class="<?php echo $classe ?>"><?php echo $res[$i]["status"] ?></span></td>
                    <td><?php echo $data2 ?></td>
                    <td>R$ <?php echo $total_vendido ?></td>
                    <td>R$ <?php echo $total_quebra ?></td>
                    <td><?php echo $nome_caixa ?></td>
                    <td><?php echo $nome_operador ?></td>
                    <td>
                        <?php if($res[$i]['status'] == 'Fechado') { ?>
                            <a href="../rel/fluxoCaixa_class.php?id=<?php echo $res[$i]['id'] ?>" target="_blank" style="text-decoration: none;">
                                <i class="bi bi bi-arrow-down-circle text-primary" title="Relatório de caixa"></i>
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

<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable({
            "ordering": false
        });
    });
</script>
