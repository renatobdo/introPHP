<?php

class Artigo
{
    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function mostrarTodos(): array
    {
        $resultado = $this->mysql->query('select * from artigos');
        $artigos = $resultado->fetch_all(MYSQLI_ASSOC);
        return $artigos;
    }
    public function encontrarPorId(int $id): array
    {
        $buscarArtigo = $this->mysql->prepare("select * from artigos where id = ?");
        $buscarArtigo->bind_param('s', $id);
        $buscarArtigo->execute();
        $artigo = $buscarArtigo->get_result()->fetch_assoc();
        return $artigo;
    }
    public function encontrarCaminhoFotoPorId(int $id): array
    {
      
        $buscarArtigo = $this->mysql->prepare("SELECT caminho, fotos.data, texto, fotos.titulo FROM `artigos`
         INNER JOIN fotos ON artigos.id = fotos.artigo_id WHERE artigos.id = ?");
        $buscarArtigo->bind_param('i', $id);
        $buscarArtigo->execute();
    
        $resultados = $buscarArtigo->get_result();
        $fotos = array();
        while ($row = $resultados->fetch_assoc()) {
            
            $fotos[] = new Foto($row['caminho'], $row['data'], $row['titulo'], $row['texto']);
        }
        return $fotos;
    }
    public function buscarArtigosRecentes(): array
    {
       

        $buscarArtigo = $this->mysql->query("select * from artigos order by id limit 5");
        //$buscarArtigo->bind_param('s', $id);
        $artigos = $buscarArtigo->fetch_all(MYSQLI_ASSOC);
        return $artigos;
      
       
    }
}
