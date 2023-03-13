<?php

require_once("../config.php");
// VARIAVEIS DO MENU ADMINISTRATIVO
$menu1 = "home";
$menu2 = "usuarios";

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Painel Administrativo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">Administrador</a>
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
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="d-flex">
                            <div class="btn-group">
                                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; color: #363636;">
                                    <img src="../imagem/icone-usuario.png" width="49px" height="49px" alt="usuário padrão"/>
                                    <font face="Verdana">Administrador</font>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    <li><button class="dropdown-item" type="button">Editar Perfil</button></li>
                                    <li><button class="dropdown-item" type="button">Sair</button></li>
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
                else{
                    require_once($menu1. ".php");
                }
                ?>
            </div>
        </main>
    </body>
</html>