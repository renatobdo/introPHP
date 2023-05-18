create table artigos(select * from blog);
select * from artigos;
alter table artigos add primary key (id);
create table comentarios(id int primary key,
conteudo varchar(3000), 
artigo_id int,
constraint fk_artigo_id foreign key(artigo_id) 
	references artigos(id));
create table usuario(id int primary key,
nome varchar(100),
email varchar(100),
senha varchar(45));
alter table comentarios add usuario_id int;
alter table comentarios add constraint fk_usuario_id 
	foreign key(usuario_id) references usuario(id);
alter table comentarios add data_comentario date after conteudo; 

insert into usuario (id, nome, email, senha) VALUES
(1, "Renato Bueno", "renato.bueno@ifsp.edu.br", 1234),
(2, "Oliver Colmenares", "oliver.colmenares@ifsp.edu.br", 4567),
(3, "Carmen Vegas", "carmen.vegas@ifsp.edu.br", 8910);

insert into comentarios (id, conteudo, artigo_id, usuario_id)
values (1, "Achei muito legal esse artigo sobre os primeiros passos pois estou aprendendo a criar a minha própria página de portfólio", 1, 2),
(2, "Demais esse artigo, está me ajudano muito", 1, 3);