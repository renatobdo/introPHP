  <?php
  include 'header.php';
  include 'conexaoBD.php';
  include 'Artigo.php';
  include 'Comentario.php';
  include 'Usuario.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $meuDado = $_POST['get'];




    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $comentario = $_POST['comentario'];

    // Verificar se o usuário já existe

    $sql = "SELECT * FROM usuario WHERE nome='$nome' OR email='$email'";
    $result = $mysql->query($sql);
    // $array = mysql_fetch_array($result);
    // $idUsuario = 1;
    $valorOculto =  $_POST['get'];
    if ($result->num_rows > 0) {
      $dataAtual = date('Y-m-d');
      // echo $_POST['nome'] . ", sua mensagem foi enviada com sucesso!</br>" . $dataAtual;
      if ($result !== false && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          // Imprimir o valor de cada coluna
          $idUsuario = $row["id"];
          //  echo "ID: " . $row["id"] . "<br>";
          //  echo "Nome: " . $row["nome"] . "<br>";
          $emailUsuario = $row["email"];
          //   echo "Email: " . $emailUsuario  . "<br>";
          // ... e assim por diante para cada coluna da tabela

        }
        $sql = "insert into comentarios (conteudo, data_comentario, artigo_id, usuario_id) 
                            values ('" . mysqli_real_escape_string($mysql, $comentario) . "', '$dataAtual', '$valorOculto', '$idUsuario')";
        $result2 = $mysql->query($sql);
        // echo "resultado do insert: " . $result2;
        // Redireciona o usuário para a página de destino

      }
      session_start();
      $_SESSION['confirmaComentario'] = ' enviado com sucesso. Obrigado pelo seu feedback!';


      header('Location: confirmacaoComentario.php');
      exit;
    } else {
      session_start();

      $_SESSION['cadastrar'] = 'faça seu cadastro para fazer comentários!';
      header('Location: Cadastro.php');
      // echo "faça seu cadastro para fazer comentários!";
    }
  }
  ?>
