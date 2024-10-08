create database sistema_bloco_notas_caua;

use sistema_bloco_notas_caua;

create table mensagens (
    id int auto_increment primary key ,
    author char(90),
    mensagem char(255)
);
