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