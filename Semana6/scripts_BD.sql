drop  database if exists devfolio;
create database if not exists devfolio;
use devfolio;
create table artigos (id int auto_increment primary key,
categoria varchar(50),
imagem varchar(200),
titulo varchar(150),
conteudo text,
link varchar(200),
testimonial varchar(150),
data_artigo date);
INSERT INTO `artigos` (`categoria`, `imagem`, `titulo`, `conteudo`, `link`, `testimonial`, `id`, `data_artigo`) VALUES
('PHP', 'assets/img/post-1_0.jpg', 'Primeiros passos com o PHP', 'O PHP é uma linguagem fracamente tipada. É open source e pode ser feito o download junto com o XAMP', 'blog-single-o-que-e-php.php', 'assets/img/testimonial-3_1.jpg', 1, '2023-03-23'),
('gastronomia', 'assets/img/post-2.jpg', 'Explosão de sabores', 'Existem cinco sabores que nossa língua pode sentir: doce, salgado, azedo, amargo e umami. O kokumi seria o sexto sabor?', 'explosao-sabores.php', 'assets/img/testimonial-3_1.jpg', 2, '2023-03-23'),
('fotos', 'assets/img/post-3_2.jpg', 'Fotos históricas', 'Aqui você encontra fotos sobre tecnologia desde foguetes, celulares, notebooks, computadores, etc.', 'artigo-fotos-historicas.php', 'assets/img/testimonial-3_1.jpg', 3, '2023-03-23');

create table comentarios(id int auto_increment primary key ,
conteudo varchar(3000), 
artigo_id int,
constraint fk_artigo_id foreign key(artigo_id) 
	references artigos(id));
    
create table usuario(id int auto_increment primary key,
nome varchar(100),
email varchar(100),
senha varchar(45),
imagem varchar(255));
alter table comentarios add usuario_id int;
alter table comentarios add constraint fk_usuario_id 
	foreign key(usuario_id) references usuario(id);
alter table comentarios add data_comentario date after conteudo; 

insert into usuario (id, nome, email, senha, imagem) VALUES
(1, "Renato Bueno", "renato.bueno@ifsp.edu.br", 1234, ''),
(2, "Oliver Colmenares", "oliver.colmenares@ifsp.edu.br", 4567, 'assets/img/testimonial-2.jpg'),
(3, "Carmen Vegas", "carmen.vegas@ifsp.edu.br", 8910, 'assets/img/testimonial-4.jpg');

insert into comentarios (id, conteudo, artigo_id, usuario_id)
values (1, "Achei muito legal esse artigo sobre os primeiros passos pois estou aprendendo a criar a minha própria página de portfólio", 1, 2),
(2, "Demais esse artigo, está me ajudano muito", 1, 3);


select * from usuario ;
update comentarios set data_comentario ='2023-03-30';
delete from usuario where id >=4;
select * from usuario where email = 'rafaelbdo@gmail.com' order by id desc limit 1;

select * from comentarios;
select * from usuario;
delete from comentarios where id >= 3;
