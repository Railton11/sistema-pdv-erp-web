-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/04/2023 às 16:42
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pdv`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `caixa`
--

CREATE TABLE `caixa` (
  `id` int(11) NOT NULL,
  `data_ab` date NOT NULL,
  `hora_ab` time NOT NULL,
  `valor_ab` decimal(8,2) NOT NULL,
  `gerente_ab` int(11) NOT NULL,
  `data_fec` date DEFAULT NULL,
  `hora_fec` time DEFAULT NULL,
  `valor_fec` decimal(8,2) DEFAULT NULL,
  `valor_vendido` decimal(8,2) DEFAULT NULL,
  `valor_quebra` decimal(8,2) DEFAULT NULL,
  `gerente_fec` int(11) DEFAULT NULL,
  `caixa` int(11) NOT NULL,
  `operador` int(11) NOT NULL,
  `status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `caixa`
--

INSERT INTO `caixa` (`id`, `data_ab`, `hora_ab`, `valor_ab`, `gerente_ab`, `data_fec`, `hora_fec`, `valor_fec`, `valor_vendido`, `valor_quebra`, `gerente_fec`, `caixa`, `operador`, `status`) VALUES
(9, '2023-04-17', '17:24:52', 200.00, 35, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, 'Aberto');

-- --------------------------------------------------------

--
-- Estrutura para tabela `caixas`
--

CREATE TABLE `caixas` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `caixas`
--

INSERT INTO `caixas` (`id`, `nome`) VALUES
(1, 'Caixa ibiara'),
(4, 'Caixa ibiarinha');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `foto` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `foto`) VALUES
(41, 'Cimento', '14-04-2023-19-20-51-cimento.jpeg'),
(42, 'Tijolo', '14-04-2023-19-21-09-tijolo_baiano.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `usuario` int(11) NOT NULL,
  `fornecedor` int(11) NOT NULL,
  `pago` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `compras`
--

INSERT INTO `compras` (`id`, `total`, `data`, `usuario`, `fornecedor`, `pago`) VALUES
(46, 200.00, '2023-04-14', 1, 15, 'Não'),
(47, 100.00, '2023-04-14', 1, 15, 'Não'),
(48, 12000.00, '2023-04-14', 1, 14, 'Não'),
(49, 500.00, '2023-04-14', 1, 14, 'Não');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contas_pagar`
--

CREATE TABLE `contas_pagar` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `pago` varchar(4) NOT NULL,
  `data` date NOT NULL,
  `vencimento` date NOT NULL,
  `id_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `contas_pagar`
--

INSERT INTO `contas_pagar` (`id`, `descricao`, `valor`, `usuario`, `pago`, `data`, `vencimento`, `id_compra`) VALUES
(50, 'Comprar de produtos', 200.00, 1, 'Sim', '2023-04-14', '2023-04-14', 46),
(51, 'Comprar de produtos', 100.00, 1, 'Sim', '2023-04-14', '2023-04-14', 47),
(52, 'Comprar de produtos', 12000.00, 1, 'Não', '2023-04-14', '2023-04-14', 48),
(53, 'Comprar de produtos', 500.00, 1, 'Sim', '2023-04-14', '2023-04-14', 49);

-- --------------------------------------------------------

--
-- Estrutura para tabela `contas_receber`
--

CREATE TABLE `contas_receber` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `pago` varchar(4) NOT NULL,
  `data` date NOT NULL,
  `vencimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `contas_receber`
--

INSERT INTO `contas_receber` (`id`, `descricao`, `valor`, `usuario`, `pago`, `data`, `vencimento`) VALUES
(14, 'Deposito bancário ', 500.00, 1, 'Sim', '2023-04-14', '2022-04-01'),
(15, 'Deposito bancário 2', 250.00, 1, 'Não', '2023-04-14', '2023-04-20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `forma_pgtos`
--

CREATE TABLE `forma_pgtos` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `forma_pgtos`
--

INSERT INTO `forma_pgtos` (`id`, `codigo`, `nome`) VALUES
(1, 1, 'Dinheiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo_pessoa` varchar(10) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `endereco` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `nome`, `tipo_pessoa`, `cpf`, `email`, `telefone`, `endereco`) VALUES
(14, 'Mario', 'Física', '000.000.000-11', 'mario@hotmail.com', '(83) 00000-0000', 'rua projetada, 12, centro, itaporanga'),
(15, 'Maria', 'Júridico', '111.111.111-11', 'maria@hotmail.com', '(85) 22222-2222', 'rua projetada 2, 21, centro, perto da saida, Itaporanga');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_venda`
--

CREATE TABLE `itens_venda` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `valor_unitario` decimal(8,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_total` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `venda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `itens_venda`
--

INSERT INTO `itens_venda` (`id`, `produto`, `valor_unitario`, `quantidade`, `valor_total`, `usuario`, `venda`) VALUES
(74, 52, 24.21, 1, 24.21, 2, 4),
(75, 49, 2.54, 1, 2.54, 2, 4),
(76, 50, 25.99, 1, 25.99, 2, 4),
(77, 49, 2.54, 1, 2.54, 2, 4),
(79, 49, 2.54, 10, 25.40, 2, 5),
(80, 50, 25.99, 10, 259.90, 2, 5),
(81, 51, 21.00, 1, 21.00, 2, 5),
(82, 52, 24.21, 1, 24.21, 2, 5),
(83, 49, 2.54, 20, 50.80, 2, 6),
(84, 50, 25.99, 10, 259.90, 2, 6),
(85, 51, 21.00, 1, 21.00, 2, 6),
(86, 52, 24.21, 1, 24.21, 2, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `movimentacoes`
--

CREATE TABLE `movimentacoes` (
  `id` int(11) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` date NOT NULL,
  `id_mov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `movimentacoes`
--

INSERT INTO `movimentacoes` (`id`, `tipo`, `descricao`, `valor`, `usuario`, `data`, `id_mov`) VALUES
(30, 'Saída', 'Comprar de produtos', 200.00, 1, '2023-04-14', 50),
(31, 'Saída', 'Comprar de produtos', 100.00, 1, '2023-04-14', 51),
(32, 'Saída', 'Comprar de produtos', 500.00, 1, '2023-04-14', 53),
(33, 'Entrada', 'Deposito bancário ', 500.00, 1, '2023-04-14', 14);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `estoque` int(11) NOT NULL,
  `valor_compra` decimal(8,2) NOT NULL,
  `valor_venda` decimal(8,2) NOT NULL,
  `fornecedor` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `foto` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `codigo`, `nome`, `descricao`, `estoque`, `valor_compra`, `valor_venda`, `fornecedor`, `categoria`, `foto`) VALUES
(48, '1', 'tijolo de cimento', 'tijolo feito de cimento', 0, 0.00, 12.69, 0, 41, '14-04-2023-19-22-05-tijolo-de-cimento.jpg'),
(49, '2', 'tijolo velho', 'tijolo velho', 266, 1.00, 2.54, 14, 42, '14-04-2023-19-22-35-tijolo-velho.jpg'),
(50, '3', 'tijolo de bloco', 'tijolo de bloco', 275, 24.00, 25.99, 14, 42, '14-04-2023-19-23-14-tijolo_baiano.jpg'),
(51, '4', 'cimento ciplan', 'cimento de uso geral', 17, 5.00, 21.00, 15, 41, '14-04-2023-19-24-00-cimento.jpeg'),
(52, '5', 'cimento elo', 'cimento da marca elo, uso geral', 0, 20.00, 24.21, 15, 41, '14-04-2023-19-24-44-cimento2.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(18) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `nivel` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `cpf`, `email`, `senha`, `nivel`) VALUES
(1, 'Usuário ADM', '000.000.000-00', 'admin@hotmail.com', '123', 'Administrador'),
(2, 'Usuário OPER', '111.111.111-11', 'operador@hotmail.com', '123', 'Operador'),
(35, 'Teste', '666.666.666-66', 'teste@hotmail.com', '123', 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `operador` int(11) NOT NULL,
  `valor_recebido` decimal(8,2) NOT NULL,
  `desconto` varchar(20) NOT NULL,
  `troco` decimal(8,2) NOT NULL,
  `forma_pgt` int(11) NOT NULL,
  `abertura` int(11) NOT NULL,
  `status` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `valor`, `data`, `hora`, `operador`, `valor_recebido`, `desconto`, `troco`, `forma_pgt`, `abertura`, `status`) VALUES
(3, 50.74, '2023-04-20', '19:50:07', 2, 60.00, 'R$ 2,00', 9.26, 1, 9, 'Concluída'),
(4, 50.28, '2023-04-20', '19:51:23', 2, 60.00, 'R$ 5,00', 9.72, 1, 9, 'Concluída'),
(5, 300.00, '2023-04-20', '20:21:45', 2, 400.00, 'R$ 30.51,00', 100.00, 1, 9, 'Concluída'),
(6, 300.00, '2023-04-20', '20:24:20', 2, 400.00, 'R$ 55.91,00', 100.00, 1, 9, 'Concluída');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `caixas`
--
ALTER TABLE `caixas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contas_pagar`
--
ALTER TABLE `contas_pagar`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contas_receber`
--
ALTER TABLE `contas_receber`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `forma_pgtos`
--
ALTER TABLE `forma_pgtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `caixa`
--
ALTER TABLE `caixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `caixas`
--
ALTER TABLE `caixas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `contas_pagar`
--
ALTER TABLE `contas_pagar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `contas_receber`
--
ALTER TABLE `contas_receber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `forma_pgtos`
--
ALTER TABLE `forma_pgtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
