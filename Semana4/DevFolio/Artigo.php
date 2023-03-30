<?php

class Artigo
{
    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this ->mysql = $mysql;
    }

    public function mostrarTodos(): array
    {
        $resultado = $this->mysql->query('select * from blog');
        $artigos = $resultado->fetch_all(MYSQLI_ASSOC);
        return $artigos;
    }
    public function encontrarPorId(int $id):array
    {
        $buscarArtigo = $this->mysql->prepare("select * from blog where id = ?");
        $buscarArtigo -> bind_param('s', $id);
        $buscarArtigo -> execute();
        $artigo = $buscarArtigo->get_result()->fetch_assoc();
        return $artigo;
    }
}
