<?php
require_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $nome_sistema ?></title>
        <link rel="stylesheet" href="recurso/login/style.css">
    </head>
    <body>
        <div class="wrapper fadeInDown zero-raduis">
            <div id="formContent">
                <div class="fadeIn first">
                    <img src="imagem/logo.png" class="img-fluid" width="38%" height="38%" alt="Logo"/>
                    <br>
                    <h2 class="my-5">Entrar</h2>
                </div>
                <form method="POST" action="autenticar.php">
                    <input type="text" id="email" class="fadeIn second zero-raduis" name="usuario" placeholder="Email ou CPF" required="">
                    <input type="text" id="senha" class="fadeIn third zero-raduis" name="senha" placeholder="Senha" required="">
                    <input type="submit" class="fadeIn fourth zero-raduis" value="Entrar">
                </form>
            </div>
        </div>
    </body>
</html>