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
                <!-- Tabs Titles -->

                <!-- Icon -->
                <div class="fadeIn first">
                    <!-- <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" /> -->
                    <h2><?php echo $nome_sistema ?></h2> <br>
                    <h2 class="my-5">Entrar</h2>
                </div>

                <!-- Login Form -->
                <form method="POST" action="autenticar.php">
                    <input type="text" id="email" class="fadeIn second zero-raduis" name="usuario" placeholder="Email ou CPF" required="">
                    <input type="text" id="senha" class="fadeIn third zero-raduis" name="senha" placeholder="Senha" required="">
                        <!--<div id="formFooter">
                            <a class="underlineHover" href="#">Esqueceu sua senha?</a>
                        </div>-->
                    <input type="submit" class="fadeIn fourth zero-raduis" value="Entrar">
                    <!--<h2>Você não tem uma conta?</h2>
                    <input type="button" class="fadeIn fourth zero-raduis pc" value="register">-->
                </form>
            </div>
        </div>
    </body>
</html>