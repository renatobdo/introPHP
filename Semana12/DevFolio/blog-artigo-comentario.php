<?php
include 'header.php';
include 'conexaoBD.php';
include 'Artigo.php';
include 'Comentario.php';
include 'Usuario.php';

$objeto_comentario = new Comentario($mysql);
$objeto_usuario = new Usuario($mysql);





$nome = $_POST['nome'];
$email = $_POST['email'];
$conteudoComentario = $_POST['comentario'];
$dataComentario = date('Y-m-d');
$artigoid = $_POST['get'];


$usuario = $objeto_usuario->encontrarUsuario($nome, $email);
$usuarioid =  $usuario['id'];


$comentario = $objeto_comentario->insereComentario($conteudoComentario, $dataComentario, $artigoid, $usuarioid);

$resposta = $nome . ' sua mensagem foi enviada com sucesso!';
//$resposta = array('status' => 'ok', 'mensagem' => 'O valor enviado foi: '.$nome);
echo json_encode($comentario);
