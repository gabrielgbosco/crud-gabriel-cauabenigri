create database crud_caua_gabriel;

use crud_caua_gabriel;

create table usuarios (
	pk_usuario int primary key not null auto_increment,
    nome_usuario varchar(100),
    email_usuario varchar(100)
);

create table notas (
	pk_nota int primary key not null auto_increment,
    titulo_nota varchar(50),
    conteudo_nota text,
    data_nota timestamp default current_timestamp,
    prioridade_nota enum('irrelevante','baixa','média','alta','urgente'),
    fk_usuario int,
    FOREIGN KEY (fk_usuario) REFERENCES usuarios(pk_usuario) ON DELETE CASCADE
);
