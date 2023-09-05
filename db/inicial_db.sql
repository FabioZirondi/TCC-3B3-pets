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
    email varchar(40),
    senha varchar(255),
    telefone varchar(19),
    nomeemp varchar(20),
    cnpj varchar(19),
    tipo char(1)
);