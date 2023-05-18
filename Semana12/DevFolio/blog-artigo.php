      <?php
      include 'header.php';
      include 'conexaoBD.php';
      include 'Artigo.php';
      include 'Comentario.php';
      include 'Usuario.php';
      include 'foto.php';
      session_start();

      $objeto_artigo = new Artigo($mysql);
      //if (!isset($_POST['get'])) {


      $artigo = $objeto_artigo->encontrarPorId($_GET['id']);
      $artigosRecentes = $objeto_artigo->buscarArtigosRecentes();
      $valorOculto = $_GET['id'];
      $urlOculta = 'http://localhost/DevFolio/blog-artigo.php?id=' . $valorOculto;
      $urlProcessaComentario = 'http://localhost/DevFolio/processa-comentario.php?id=' . $valorOculto;
      //}

      $objeto_comentario = new Comentario($mysql);
      $comentarios = $objeto_comentario->mostrarTodos();

      $qtdComentarios = $objeto_comentario->mostrarQtdeComentariosPorIdArtigo($_GET['id']);


      ?>




      <body>



        <div class="hero hero-single route bg-image" style="background-image: url(assets/img/overlay-bg.jpg)">
          <div class="overlay-mf"></div>
          <div class="hero-content display-table">
            <div class="table-cell">
              <div class="container">
                <h2 class="hero-title mb-4"><?php echo $artigo['titulo']; ?></h2>

              </div>
            </div>
          </div>
        </div>

        <main id="main">

          <!-- ======= Blog Single Section ======= -->
          <section class="blog-wrapper sect-pt4" id="blog">
            <div class="container">
              <div class="row">
                <div class="col-md-8">
                  <div class="post-box">
                    <div class="post-thumb">
                      <img src="<?php echo $artigo['imagem'];?>" class="img-fluid" alt="">
                    </div>
                    <div class="post-meta">
                      <h1 class="article-title"><?php echo $artigo['titulo']; ?></h1>
                      <ul>
                        <li>
                          <span class="bi bi-person"></span>
                          <a href="#">Renato Bueno</a>
                        </li>
                        <li>
                          <span class="bi bi-tag"></span>
                          <a href="#"><?php echo $artigo['categoria']; ?></a>
                        </li>
                        <li>
                          <span class="bi bi-chat-left-text"></span>
                          <a href="#"><?php echo $qtdComentarios; ?></a>
                        </li>
                      </ul>
                    </div>
                    <div class="article-content">
                      <?php 
                      $palavras = explode(" ", $artigo['conteudo']);
                      $qtde_palavras = count($palavras);
                      //echo  $qtde_palavras."<br>";

                      if ($qtde_palavras > 70) { // verifica se há mais de 30 palavras na string
                        $nova_string = ''; // inicializa uma nova string vazia
                        $contadorPontos = 0;
                        for ($i = 0; $i < $qtde_palavras; $i++) { // percorre todas as palavras
                          $nova_string .= $palavras[$i] . ' '; // adiciona a palavra atual na nova string
                          if (strpos($palavras[$i], '.') !== false) { // verifica se a palavra atual contém um ponto final
                             // encerra o loop assim que encontrar o ponto final
                            $contadorPontos++;
                            if ($contadorPontos == 2){
                              echo "<p id =".$i." > &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp". $nova_string."</p>";
                             // break;
                             $contadorPontos = 0;
                             $nova_string= "";
                            }
                          }
                          
                        }
                      } else {
                        $nova_string = $artigo['conteudo']; // se a string tiver 30 palavras ou menos, a nova string será igual à string original
                      }
                      // Imprime as referências do conteúdo do artigo
                      echo $artigo['referencias'];                    

                      if (($artigo['categoria'] == 'fotos') || ($artigo['categoria'] == 'gastronomia')) {
                       
                        $artigos = $objeto_artigo->encontrarCaminhoFotoPorId($_GET['id']);

                        foreach ($artigos as $foto) :

                          echo "<br><br><br>Título da foto: " . $foto->getTitulo() . "<br><br><br>";
                      ?> <img src="<?php echo $foto->getCaminho(); ?>" class="img-fluid" alt="">
                          </br>


                      <?php  if ($artigo['categoria'] == 'fotos'){ 
                                echo "Data da foto: " . $foto->getData() . "<br>";
                                echo "Texto do artigo: " . $foto->getTexto() . "<br>";
                            }

                        endforeach;
                      }
                      ?>
                      <!-- O ideal seria criar um botão para criar nova imagem da nasa
                      // com isso evitaria que quando a página fosse recarregada consumisse o serviço da nasa novamente
                      // seria legal também mostrar a descrição dessa imagem em formato de texto...

                      //aqui -->


                    </div>
                  </div>

                  <div class="box-comments">
                    <div class="title-box-2">
                      <h4 class="title-comments title-left">Comentarios (<?php echo $qtdComentarios; ?>)</h4>
                    </div>

                    <ul class="list-comments">
                      <?php if (!$qtdComentarios == 0) {

                        foreach ($comentarios as $comentario) :
                      ?>
                          <li>

                            <div class="comment-avatar">
                              <img src="<?php echo $comentario['imagem']; ?>" alt="">
                            </div>
                            <div class="comment-details">
                              <h4 class="comment-author"><?php echo $comentario['nome']; ?> </h4>
                              <span><?php echo $comentario['data_comentario'];  ?></span>
                              <p>
                                <?php echo $comentario['conteudo'];








                                ?>
                              </p>
                              <!-- <a href="#" class="remover.php" data-comentario-id="1">Remover</a> -->

                              <!--    <script>
                              const responderLinks = document.querySelectorAll('.responder-link');

                              responderLinks.forEach((link) => {
                                link.addEventListener('click', (event) => {
                                  event.preventDefault();
                                  const comentarioId = link.dataset.comentarioId;
                                  exibirFormularioResposta(comentarioId, link);
                                });
                              });

                              function exibirFormularioResposta(comentarioId, link) {
                                // Crie o elemento HTML para o formulário de resposta
                                const formulario = document.createElement('form');
                                formulario.method = 'post';
                                formulario.action = 'processa_resposta.php';

                                const campoResposta = document.createElement('textarea');
                                campoResposta.name = 'resposta';
                                formulario.appendChild(campoResposta);

                                const botaoEnviar = document.createElement('input');
                                botaoEnviar.type = 'submit';
                                botaoEnviar.value = 'Enviar';
                                formulario.appendChild(botaoEnviar);

                                // Adicione o formulário à página
                                const caixaComentarios = link.parentNode;
                                caixaComentarios.appendChild(formulario);
                              }
                            </script> -->

                              <?php
                              if (isset($resposta)) {

                                $resposta = $_POST['resposta'];
                              }
                              ?>




                            </div>
                          </li>

                      <?php endforeach;
                      }

                      ?>

                    </ul>
                  </div>

                  <div class="form-comments">
                    <div class="title-box-2">
                      <h3 class="title-left">
                        Deixe seu comentário
                      </h3>
                    </div>

                    <form id="formComentarios" class="form-mf" method="post" action="<?php echo $urlProcessaComentario; ?>">

                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <div class="form-group">
                            <input type="text" class="form-control input-mf" id="nome" placeholder="Nome *" name="nome" required>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <div class="form-group">
                            <input type="email" class="form-control input-mf" id="email" placeholder="Email *" name="email" required>
                          </div>
                          <input type="hidden" id="get" name="get" value="<?php echo $valorOculto; ?>">
                          <input type="hidden" id="get1" name="get1" value="1">
                        </div>

                        <div class="col-md-12 mb-3">
                          <div class="form-group">
                            <textarea id="comentario" class="form-control input-mf" placeholder="Comentários *" name="comentario" cols="45" rows="8" required></textarea>
                          </div>
                        </div>
                        <div id="minhaDiv"></div>
                        <div class="col-md-12">
                          <button type="submit" class="button button-a button-big button-rouded">Envie sua mensagem</button>
                        </div>
                      </div>

                    </form>
                    <!-- <script>
                      $(document).ready(function() {
                        $('formComentarios').submit(function(event) {
                          event.preventDefault(); // Impede que o formulário seja enviado normalmente
                          var formData = $(this).serialize(); // Obtém os dados do formulário
                          $.ajax({
                            type: 'POST',
                            url: $(this).attr('action'),
                            data: formData
                          }).done(function(response) {
                            $('resultado').html(response); // Atualiza o conteúdo da div "resultado" com a resposta do servidor
                          }).fail(function() {
                            alert('Ocorreu um erro ao enviar o formulário.');
                          });
                        });
                      });
                    </script>
                    <div id="resultado"></div> -->
                    <!-- aqui -->
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="widget-sidebar sidebar-search">
                    <h5 class="sidebar-title">Pesquisar</h5>
                    <div class="sidebar-content">
                      <form>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="pesquisar ..." aria-label="Pesquisar...">
                          <span class="input-group-btn">
                            <button class="btn btn-secondary btn-search" type="button">
                              <span class="bi bi-search"></span>
                            </button>
                          </span>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="widget-sidebar">
                    <h5 class="sidebar-title">Posts recentes</h5>
                    <div class="sidebar-content">
                    <?php foreach ($artigosRecentes as $artigosRec): ?>
                      <ul class="list-sidebar">
                        <li>
                          <a href="blog-artigo.php?id=<?php echo $artigosRec['id']; ?>">
                             <?php echo  $artigosRec['titulo'];  ?>
                           </a>
                        </li>
                      <?php endforeach;?>
                        
                      </ul>
                    </div>
                  </div>
                  <div class="widget-sidebar">
                    <h5 class="sidebar-title">Outros artigos</h5>
                    <div class="sidebar-content">
                      <ul class="list-sidebar">
                        <li>
                          <a href="#">September, 2017.</a>
                        </li>
                        <li>
                          <a href="#">April, 2017.</a>
                        </li>
                        <li>
                          <a href="#">Nam quo autem exercitationem.</a>
                        </li>
                        <li>
                          <a href="#">Atque placeat maiores nam quo autem</a>
                        </li>
                        <li>
                          <a href="#">Nam quo autem exercitationem.</a>
                        </li>
                      </ul>
                    </div>
                  </div>




                </div>
              </div>
            </div>
          </section><!-- End Blog Single Section -->

        </main><!-- End #main -->

        <!-- ======= Footer ======= -->
        <?php include 'footer.php'; ?>
        <!-- End  Footer -->



      </body>

      </html>