DROP TABLE IF EXISTS `item_venda`;
DROP TABLE IF EXISTS `produto`;
DROP TABLE IF EXISTS `venda`;
DROP TABLE IF EXISTS `setor`;
DROP TABLE IF EXISTS `cliente`;
DROP TABLE IF EXISTS `funcionario`;
DROP TABLE IF EXISTS `usuario`;

CREATE TABLE usuario (
	id_cadastro 	INTEGER   		NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nome			TEXT			NOT NULL,
	cpf		  		VARCHAR(14),
	telefone  		VARCHAR(12)		NOT NULL,
	email   		TEXT			NOT NULL,
	senha   		TEXT			NOT NULL,
	rua	 			TEXT  			NOT NULL,
	numero			INTEGER 		NOT NULL,
	cep	 			TEXT  			NOT NULL,
	cidade 			TEXT  			NOT NULL,
	estado 			TEXT  			NOT NULL,
	complemento 	TEXT,
	tipo_usuario	TEXT			NOT NULL
);

CREATE TABLE cliente (
		id_cliente	INTEGER		NOT NULL	PRIMARY KEY,
		cnpj		VARCHAR(18),
		FOREIGN KEY (id_cliente) REFERENCES usuario(id_cadastro)	ON DELETE CASCADE	ON UPDATE CASCADE
);

CREATE TABLE funcionario (
		id_funcionario			INTEGER	 		NOT NULL	PRIMARY KEY,
		codigo_identificacao	TEXT 			NOT NULL,
		salario					NUMERIC(10,2)	NOT NULL,
		cargo					TEXT			NOT NULL,
		FOREIGN KEY (id_funcionario) REFERENCES usuario(id_cadastro)	ON DELETE CASCADE	ON UPDATE CASCADE
);

CREATE TABLE setor (
		id_setor				INTEGER	 	NOT NULL	PRIMARY KEY 	AUTO_INCREMENT,
		nome					TEXT		NOT NULL,
		id_responsavel			INTEGER 	NOT NULL,
		codigo_identificacao	TEXT		NOT NULL,
		FOREIGN KEY (id_responsavel) REFERENCES funcionario(id_funcionario)	ON DELETE CASCADE	ON UPDATE CASCADE
);

CREATE TABLE produto (
		id_produto	INTEGER	 		NOT NULL	PRIMARY KEY 	AUTO_INCREMENT,
		nome		TEXT		 	NOT NULL,
		preco		NUMERIC(10,2) 	NOT NULL,
		fabricante	TEXT			NOT NULL,
		desconto	NUMERIC(10,2)	NOT NULL,
		quantidade	INTEGER	 		NOT NULL,
		id_setor	INTEGER	 		NOT NULL,
		FOREIGN KEY (id_setor) REFERENCES setor(id_setor)	ON DELETE CASCADE	ON UPDATE CASCADE
);

CREATE TABLE venda (
		id_venda		INTEGER	 	NOT NULL	PRIMARY KEY 	AUTO_INCREMENT,
		id_cliente		INTEGER 	NOT NULL,
		id_responsavel	INTEGER 	NOT NULL,
		data			DATETIME	NOT NULL,
		total			FLOAT		NOT NULL,
		FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)	ON DELETE CASCADE	ON UPDATE CASCADE,
		FOREIGN KEY (id_responsavel) REFERENCES funcionario(id_funcionario)	ON DELETE CASCADE	ON UPDATE CASCADE
);

CREATE TABLE item_venda (
		id_venda	INTEGER	 		NOT NULL,
		id_produto	INTEGER	 		NOT NULL,
		quantidade	INTEGER			NOT NULL,
		preco		NUMERIC(10,2) 	NOT NULL,
		PRIMARY KEY (id_venda, id_produto),
		FOREIGN KEY (id_venda) 		REFERENCES venda(id_venda)	ON DELETE CASCADE	ON UPDATE CASCADE,
		FOREIGN KEY (id_produto) 	REFERENCES produto(id_produto)	ON DELETE CASCADE	ON UPDATE CASCADE
);

INSERT INTO `usuario` (`id_cadastro`, `nome`, `cpf`, `telefone`, `email`, `senha`, `rua`, `numero`, `cep`, `cidade`, `estado`, `complemento`, `tipo_usuario`) VALUES
(1, 'Kevyn', '111.111.111-11', '00 0000-0000', 'teste@teste.com', 'vertrigo', 'A', 1212, '11.111-111', 'Fora', 'MG', '', 'Cliente'),
(2, 'Ana', '123.12', '1111111111', 'admin', 'admin1', 'A', 12, '11.111-111', 'Juiz', 'MG', '', 'Cliente'),
(3, 'ZÃ© o Dono', '000.000.000-00', '11 1111-1111', 'admin', 'admin2', 'Em algum lugar', 0, '00.000-000', 'Juiz de Fora', 'DF', 'Casa', 'Funcionario'),
(4, 'Bruno', '111.111.111-11', '11 1111-1111', 'admin', 'admin3', 'Em algum lugar', 0, '', 'Juiz de Fora', 'DF', '', 'Funcionario'),
(5, 'Rodrigo', '000.000.000-00', '11 1111-1111', 'admin', 'admin4', 'Em algum lugar', 0, '00.000-000', 'Juiz de Fora', 'DF', 'Casa', 'Funcionario');

INSERT INTO `cliente` (`id_cliente`, `cnpj`) VALUES
(1, '11.111.111/1111-11'),
(2, '00.000.000/0000-00');

INSERT INTO `funcionario` (`id_funcionario`, `codigo_identificacao`, `salario`, `cargo`) VALUES
(3, '11.111-11', '1100200.00', 'Administrador'),
(4, '22.222-22', '11.00', 'Vendedor'),
(5, '00.000-00', '1200.00', 'Administrador');

INSERT INTO `setor` (`id_setor`, `nome`, `id_responsavel`, `codigo_identificacao`) VALUES
(1, 'AÃ§ougue', 5, '00.000-00'),
(2, 'Padaria', 3, '00.000-00');

INSERT INTO `produto` (`id_produto`, `nome`, `preco`, `fabricante`, `desconto`, `quantidade`, `id_setor`) VALUES
(1, 'PÃ£o', '1.00', 'Joaquim', '0.00', 200, 1);