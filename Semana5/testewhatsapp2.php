<?php
require_once 'vendor/autoload.php'; // Carregue a biblioteca Twilio
use Twilio\Rest\Client;
// Configurações do Twilio
$twilioAccountSid = 'seu_id';
$twilioAuthToken = 'seu_token';
$twilioPhoneNumber = 'seu_numero';

// Conexão com o banco de dados
$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'devfolio';

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
date_default_timezone_set('America/Sao_Paulo');
// Verifica se há aniversariantes hoje
$today = date('m-d');
$query = "SELECT nome, tel FROM usuario WHERE DATE_FORMAT(data_nascimento, '%m-%d') = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $today);
echo "<br>hoje = " . $today;

if ($stmt->execute()) {
    
    $result = $stmt->get_result();

    if ($result->num_rows >= 1) {
        echo "<br>Temos aniversariantes no dia de hoje";
        // Envia mensagens de feliz aniversário
        foreach ($result as $row) {
            $nome = $row['nome'];
            $telefone = "+" . $row['tel'];
            echo "<br>Número de telefone = " . $telefone;

            // Enviar mensagem via Twilio para o número de telefone
            $twilio = new Twilio\Rest\Client($twilioAccountSid, $twilioAuthToken);
            $message = $twilio->messages->create(
                "whatsapp:$telefone",
                array(
                    "from" => "whatsapp:$twilioPhoneNumber",
                    "body" => "Feliz aniversário, $nome! 🎉🎂"
                )
            );

            // Registrar o envio em um log, se necessário
            // Log::info("Mensagem de aniversário enviada para $nome");
        }
    }else{
        echo "<br>Não há aniversários nessa data";
    }
} else {
    echo "<br>Erro na consulta ao banco de dados";
};
$stmt->close();
$conn->close();
