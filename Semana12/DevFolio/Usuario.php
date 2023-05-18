    <?php

    class Usuario
    {
        private $mysql;

        public function __construct(mysqli $mysql)
        {
            $this->mysql = $mysql;
        }

        public function mostrarTodos(): array
        {
            $resultado = $this->mysql->query('select * from usuario');
            $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);
            return $usuarios;
        }
        public function encontrarUsuario(String $nome, String $email): String
        {
            $buscarUsuario = $this->mysql->prepare("select * from usuario where nome = ? or email = ?");
            $buscarUsuario->bind_param('ss', $nome, $email);
            $buscarUsuario->execute();

            // Verifica se a consulta retornou algum resultado
            if ($buscarUsuario->num_rows > 0) {
                $usuario = $buscarUsuario->get_result()->fetch_assoc();
                return $usuario;
            } else {
                // Retorna algum valor que indique que nenhum resultado foi encontrado
                return "usuário não encontrado";
            }
        }
        public function insereUsuario(
            int $id,
            string $nome,
            String $email,
            String $senha,
            String $imagem
        ): void {
            $insereUsuario = $this->mysql->prepare('insert into usuario (id, nome, email, senha, imagem) 
                values (?, ?, ?, ?, ?);');
            $insereUsuario->bind_param('issss', $id, $nome, $email, $senha, $imagem);

            if (!$insereUsuario->execute()) {
                throw new Exception("Erro ao inserir usuário: " . $insereUsuario->error);
            }
        }
        public function geraImagem(): string
        {

            // Gerar um nome aleatório para a imagem
            $nomeImagem = uniqid() . '.png';

            // Definir o caminho do diretório onde a imagem será salva
            $caminhoDiretorio = 'assets/img/';

            // Gerar a imagem aleatória
            $img = imagecreatetruecolor(200, 200);
            $corFundo = imagecolorallocate($img, 255, 255, 255);
            imagefill($img, 0, 0, $corFundo);
            $corTexto = imagecolorallocate($img, 0, 0, 0);
            $fonte = 'C:\Windows\Fonts\arial.ttf';
            $tamanho = 24;
            $texto = 'Imagem aleatória: ' . rand();
            $posX = 50;
            $posY = 100;
            imagettftext($img, $tamanho, 0, $posX, $posY, $corTexto, $fonte, $texto);

            // Salvar a imagem no diretório especificado
            imagepng($img, $caminhoDiretorio . $nomeImagem);

            // Salvar o caminho do arquivo no banco de dados
            $caminhoCompleto = $caminhoDiretorio . $nomeImagem;
            return $caminhoCompleto;
        }
        public function encontrarPorId(int $id): array
        {
            $buscarUsuario = $this->mysql->prepare("select * from usuario where id = ?");
            if (!$buscarUsuario) {
                throw new Exception("Error preparing SQL statement: " . $this->mysql->error);
            }
        
            $buscarUsuario->bind_param('s', $id);
            if (!$buscarUsuario->execute()) {
                throw new Exception("Error executing SQL statement: " . $buscarUsuario->error);
            }
        
            $result = $buscarUsuario->get_result();
            if (!$result) {
                throw new Exception("Error getting result set: " . $buscarUsuario->error);
            }
        
            $usuario = $result->fetch_assoc();
            if (!$usuario) {
                throw new Exception("No user found with id $id");
            }
        
            return $usuario;
        }

        function gerarSenha(
            $tamanho = 10,
            $usarNumeros = true,
            $usarMaiusculas = true,
            $usarMinusculas = true,
            $usarSimbolos = false
        ) {
            $caracteres = '';
            $senha = '';

            if ($usarNumeros) {
                $caracteres .= '0123456789';
            }

            if ($usarMaiusculas) {
                $caracteres .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            }

            if ($usarMinusculas) {
                $caracteres .= 'abcdefghijklmnopqrstuvwxyz';
            }

            if ($usarSimbolos) {
                $caracteres .= '!@#$%&*()_+-=[]{}|';
            }

            for ($i = 0; $i < $tamanho; $i++) {
                $senha .= $caracteres[rand(0, strlen($caracteres) - 1)];
            }

            return $senha;
        }
    }
