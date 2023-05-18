<?php

class Comentario
{
    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this ->mysql = $mysql;
    }

    public function mostrarTodos(): array
    {
        $resultado = $this->mysql->query('select * from comentarios c join usuario u on c.usuario_id = u.id');
        $comentarios = $resultado->fetch_all(MYSQLI_ASSOC);
        return $comentarios;
    }
 
    public function mostrarQtdeComentariosPorIdArtigo(int $id):int
    {
        $buscarQtdeComentariosPorIdArtigo = $this->mysql->prepare("select count(*) as total 
            from comentarios where artigo_id = ?");
        $buscarQtdeComentariosPorIdArtigo -> bind_param('s', $id);
        $buscarQtdeComentariosPorIdArtigo -> execute();
    
        $quantidade = $buscarQtdeComentariosPorIdArtigo->get_result()->fetch_assoc();
        return $quantidade['total'];
    }
    public function insereComentario(string $conteudo, String $data_comentario, 
            int $artigo_id, int $usuario_id): void{
        $insereComentario = $this->
            mysql->prepare('insert into comentarios (conteudo, data_comentario, artigo_id, usuario_id) 
            values (?, ?, ?, ?);');
        $insereComentario->bind_param('ssii',$conteudo, $data_comentario, $artigo_id, $usuario_id);
        $insereComentario->execute();
        
    }
    public function insereResposta(string $conteudo, String $data_comentario, 
            int $artigo_id, int $usuario_id): void{
        $insereComentario = $this->
            mysql->prepare('insert into comentarios (conteudo, data_comentario, artigo_id, usuario_id) 
            values (?, ?, ?, ?);');
        $insereComentario->bind_param('ssii',$conteudo, $data_comentario, $artigo_id, $usuario_id);
        $insereComentario->execute();
        
    }
}