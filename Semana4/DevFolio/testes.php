<?php
class Fruta {
  // Properties
  public $nome;
  public $cor;

  function construc($nome, $cor) {
    $this->nome = $nome;
    $this->cor = $cor;
  } 

  // Methods
  function set_nome($nome) {
    $this->nome = $nome;
  }
  function get_nome() {
    return $this->nome;
  }
  function set_cor($cor) {
    $this->cor = $cor;
  }
  function get_cor() {
    return $this->cor;
  }


}

$maca = new Fruta("maça gala","vermelha");
$banana = new Fruta("Banana nanica","amarela");

echo $maca->get_nome();
echo "<br>";
echo $maca->get_cor();
echo "<br>";
echo $banana->get_nome();
echo "<br>";
echo $banana->get_cor();
echo "<br>";
?>
