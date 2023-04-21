<?php

// VARIAVEIS GLOBAIS
$nome_sistema = "Casa Nova Materiais de ConstruÇÃo";
$url_sistema = "http://localhost/pdv/"; // é preciso configurar essa url para gerar relatorios, ela deve apontar para raiz do seu dominio exemplo: (https://www.google.com/) com a barra no final e o protocolo http ou https de acordo com seu dominio no inicio.
$telefone_sistema = "(83) 98690-7611, (83) 98797-5484"; // Telefone da loja
$endereco_sistema = "Rua Osório Pinto Ramalho, N°29, Praça Central - Ibiara - PB";
$email_adm = 'admin@hotmail.com';

// VARIAVEIS PARA O BANCO DE DADOS LOCAL
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "pdv";

// VARIAVEIS DE CONFIGURAÇÕES DO SISTEMA
$relatorio_pdf = "Sim"; // Se você utilizar sim, ele vai gerar os relatórios usando a biblioteca do dompdf configurada para o PHP 8.2, se utilizar outra versão do php ou do dompdf pode dá erros, caso utilize não ele vai gerar relatorio em html.

$desconto_porcentagem = "Não" // Se essa variavel receber sim o desconto aplicado na tela de pdv será em %, caso contrário ele será em reais
?>