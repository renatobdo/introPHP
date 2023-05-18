<?php
include 'header.php';
include 'conexaoBD.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Comentários </title>
</head>
<body>
<div class="hero hero-single route bg-image" style="background-image: url(assets/img/overlay-bg.jpg)">
            <div class="overlay-mf"></div>
            <div class="hero-content display-table">
                <div class="table-cell">
                    <div class="container">
                        <h2 class="hero-title mb-4">Comentário  </h2>

                        <?php if (isset($_SESSION['confirmaComentario'])){
                                    echo  $_SESSION['confirmaComentario'];
                                }?>
                      
                    </div>
                </div>
            </div>
        </div>

 
  <br><br><div style='margin-left: 650px'><a href="#" onclick="history.back()">Voltar</a>
</body>
</html>
