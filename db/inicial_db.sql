create table usuario (
	cod int PRIMARY KEy AUTO_INCREMENT,
    nome varchar(40),
    email varchar(40),
    senha varchar(255),
    tipo char(1)
);

create table vendedor(
	cod int PRIMARY KEY AUTO_INCREMENT,
    nome varchar(40),
    email varchar(40) UNIQUE,
    senha varchar(255),
    telefone varchar(19),
    nomeemp varchar(20),
    cnpj varchar(19),
    tipo char(1)
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(255),
    descricao TEXT,
    preco DECIMAL(10, 2),
    imagem_nome_uniq VARCHAR(255) UNIQUE,
    cod_vendedor INT,
    email VARCHAR(40),
    CONSTRAINT fk_cod_vendedor
        FOREIGN KEY (cod_vendedor)
        REFERENCES vendedor (cod),
    CONSTRAINT fk_email_vendedor
        FOREIGN KEY (email)
        REFERENCES vendedor (email)
);




-- teste

-- Tabela para armazenar os agendamentos
CREATE TABLE agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT,
    id_usuario INT,
    data_agendamento DATETIME,
    status CHAR(1),
    CONSTRAINT fk_id_produto
        FOREIGN KEY (id_produto)
        REFERENCES produtos (id),
    CONSTRAINT fk_id_usuario
        FOREIGN KEY (id_usuario)
        REFERENCES usuario (cod)
);

-- Tabela para armazenar os horários disponíveis para agendamento
CREATE TABLE horarios_disponiveis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT,
    data_agendamento DATETIME,
    status CHAR(1),
    CONSTRAINT fk_id_produto_horarios
        FOREIGN KEY (id_produto)
        REFERENCES produtos (id)
);

INSERT INTO horarios_disponiveis (id_produto, data_agendamento, status)
VALUES
(1, '2023-10-01 07:00:00', 'D'),
(1, '2023-10-01 08:00:00', 'D'),
(1, '2023-10-01 09:00:00', 'D'),
(1, '2023-10-01 10:00:00', 'D'),
(1, '2023-10-01 13:00:00', 'D'),
(1, '2023-10-01 14:00:00', 'D'),
(1, '2023-10-01 15:00:00', 'D'),
(1, '2023-10-01 16:00:00', 'D'),
(1, '2023-10-01 17:00:00', 'D');
