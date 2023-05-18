<?php class Foto {
    private $caminho;
    private $data;
    private $titulo;
    private $texto;

    public function __construct($caminho, $data, $titulo, $texto) {
        $this->caminho = $caminho;
        $this->data = $data;
        $this->titulo = $titulo;
        $this->texto = $texto;
    }
    public function getCaminho() {
        return $this->caminho;
    }
    public function setCaminho($caminho) {
        $this->caminho = $caminho;
    }
    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

}
?>