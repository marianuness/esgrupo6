-- Database: `db_lojao_ze`

-- --------------------------------------------------------

-- Estrutura da tabela `usuarios`

START TRANSACTION;
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
			id				INTEGER		NOT NULL	AUTO_INCREMENT,
			nome 			TEXT 		NOT NULL,
			email			VARCHAR(20),
			senha			VARCHAR(40),
			telefone 		VARCHAR(12) NOT NULL,
			cpf 			VARCHAR(14) NOT NULL,
			id_endereco 	INTEGER		NOT NULL,
			tipo_usuario	TEXT		NOT NULL,

			PRIMARY KEY (id),
			FOREIGN KEY (id_endereco) REFERENCES Endereco(id) ON DELETE CASCADE	ON UPDATE CASCADE
	);

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE Endereco (
			id			INTEGER 	NOT NULL	AUTO_INCREMENT,
			rua			TEXT		NOT NULL,
			numero		INTEGER 	NOT NULL,
			complemento VARCHAR(40) DEFAULT NULL,
			cep 		VARCHAR(10) NOT NULL,
			cidade 		VARCHAR(40) NOT NULL,
			estado 		VARCHAR(20) NOT NULL,

			PRIMARY KEY (id)
	);
COMMIT;