    <?php
    include 'header.php';
    include 'conexaoBD.php';
    include 'Usuario.php';
    ?>


    <div class="hero hero-single route bg-image" style="background-image: url(assets/img/overlay-bg.jpg)">
        <div class="overlay-mf"></div>
        <div class="hero-content display-table">
            <div class="table-cell">
                <div class="container">
                    <h2 class="hero-title mb-4">Cadastro</h2>
                </div>
            </div>
        </div>
    </div>

    <body>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validar se o campo de nome foi preenchido
            if (empty($_POST['nome'])) {
                $errors[] = 'O campo nome é obrigatório.';
            }

            // Validar se o campo de e-mail foi preenchido e tem um formato válido
            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'O campo de e-mail é obrigatório e deve ter um formato válido.';
            }

            // Validar se o campo de senha foi preenchido e tem pelo menos 4 caracteres
            if (empty($_POST['senha']) || strlen($_POST['senha']) < 4) {
                $errors[] = 'O campo de senha é obrigatório e deve ter pelo menos 4 caracteres.';
            }

            // Se não houver erros de validação, salvar as informações no banco de dados e redirecionar para a página de confirmação
            if (empty($errors)) {
                // Substitua estas linhas pelo código que salva as informações no banco de dados
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $sexo = $_POST['sexo'];
                $etnia = $_POST['etnia'];
                echo $sexo;
                echo "<br><div style='margin-left: 550px'><p>Nome: $nome</p>";
                echo "<p>E-mail: $email</p>";
                // Verificar se o usuário já existe

                $sql = "SELECT * FROM usuario WHERE nome='$nome' OR email='$email'";
                $result = $mysql->query($sql);

                if ($result->num_rows > 0) {
                    echo "<b>Usuário já existe!</b>" ?><br><br><a href="#" onclick="history.back()">Voltar</a>
                    <?php
                } else {
                    if ($sexo == 'masculino') {
                        //antes de inserir cadastrar imagens aleatórias buscadas do caminho C:\xampp\htdocs\DevFolio\assets\img
                        if ($etnia == 'Branca') {
                            $caminho = "C:/xampp/htdocs/DevFolio/assets/img/perfisUsuarioMasculino/etniaBranca";
                        } else if ($etnia == 'Amarela') {
                            $caminho = "C:/xampp/htdocs/DevFolio/assets/img/perfisUsuarioMasculino/etniaAmarela";
                        } else if ($etnia == "Indigena") {
                            $caminho = "C:/xampp/htdocs/DevFolio/assets/img/perfisUsuarioMasculino/etniaIndigena";
                        } else if ($etnia == 'Afrodescendente') {
                            $caminho = "C:/xampp/htdocs/DevFolio/assets/img/perfisUsuarioMasculino/etniaAfro";
                        } else {
                            $caminho = "C:/xampp/htdocs/DevFolio/assets/img/perfisUsuarioMasculino";
                        }
                    } else {
                        //antes de inserir cadastrar imagens aleatórias buscadas do caminho C:\xampp\htdocs\DevFolio\assets\img
                        if ($etnia == 'Branca') {
                            $caminho = "C:/xampp/htdocs/DevFolio/assets/img/perfisUsuarioFeminino/etniaBranca";
                        } else if ($etnia == 'Amarela') {
                            $caminho = "C:/xampp/htdocs/DevFolio/assets/img/perfisUsuarioFeminino/etniaAmarela";
                        } else if ($etnia == "Indigena") {
                            $caminho = "C:/xampp/htdocs/DevFolio/assets/img/perfisUsuarioFeminino/etniaIndigena";
                        } else if ($etnia == 'Afrodescendente') {
                            $caminho = "C:/xampp/htdocs/DevFolio/assets/img/perfisUsuarioFeminino/etniaAfro";
                        } else {
                            $caminho = "C:/xampp/htdocs/DevFolio/assets/img/perfisUsuarioFeminino";
                        }
                    }
                    // Lista todos os arquivos do diretório
                    $arquivos = scandir($caminho);
                    // Remove os diretórios "." e ".." da lista de arquivos
                    $arquivos = array_diff($arquivos, array('.', '..'));
                    // Seleciona um índice aleatório do array de arquivos
                    $indice = array_rand($arquivos);
                    // Seleciona a imagem correspondente ao índice aleatório
                    $imagem_selecionada = $arquivos[$indice];

                    //atribui a imagem escolhida 
                    // $nome_imagem =  "assets/img/perfisUsuario/".$imagem_selecionada;
                    $nome_imagem =  substr($caminho, 25) . "/" . $imagem_selecionada;

                    // Se o usuário não existe, inserir os dados no banco de dados
                    $sql = "INSERT INTO usuario (nome, email, senha, imagem) 
                                    VALUES ('$nome', '$email', '$senha','$nome_imagem')";

                    if ($mysql->query($sql)) {
                        echo "<b>Cadastro efetuado com sucesso!</b>"; ?><br><br><a href="#" onclick="history.back()">Voltar</a> </div><?php
                                                                                                                                    } else {

                                                                                                                                        echo "Erro ao cadastrar: " . $mysql->error; ?><br><br><a href="#" onclick="history.back()">Voltar</a> </div><?php
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            } else {
                                                                                                                                foreach ($errors as $error) {
                                                                                                                                    echo "<div style='margin-left: 550px'><p>$error</p></div>";
                                                                                                                                }
                                                                                                                                    ?> <br><br>
                <div style='margin-left: 550px'><a href="#" onclick="history.back()">Voltar</a><?php
                                                                                                                            }
                                                                                                                        }



                                                                                                ?>