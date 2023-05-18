create table blog (id int auto_increment primary key,
categoria varchar(50),
imagem varchar(200),
titulo varchar(150),
conteudo text,
link varchar(200),
testimonial varchar(150),
data_artigo date);

INSERT INTO `blog` (`categoria`, `imagem`, `titulo`, `conteudo`, `link`, `testimonial`, `id`, `data_artigo`) VALUES
('PHP', 'assets/img/post-1_0.jpg', 'Primeiros passos com o PHP', 'O PHP é uma linguagem fracamente tipada. É open source e pode ser feito o download junto com o XAMP', 'blog-single-o-que-e-php.php', 'assets/img/testimonial-3_1.jpg', 1, '2023-03-23'),
('gastronomia', 'assets/img/post-2.jpg', 'Explosão de sabores', 'Existem cinco sabores que nossa língua pode sentir: doce, salgado, azedo, amargo e umami. O kokumi seria o sexto sabor?', 'explosao-sabores.php', 'assets/img/testimonial-3_1.jpg', 2, '2023-03-23'),
('fotos', 'assets/img/post-3_2.jpg', 'Fotos históricas', 'Aqui você encontra fotos sobre tecnologia desde foguetes, celulares, notebooks, computadores, etc.', 'artigo-fotos-historicas.php', 'assets/img/testimonial-3_1.jpg', 3, '2023-03-23');
