<?php
/**
 * TESTE PHPMAILER
 * Use este arquivo para testar se o PHPMailer está funcionando
 * Acesse: https://gerlenmascarenhas.com.br/test-phpmailer.php
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Carregar configurações
if (!file_exists('config.php')) {
    echo "<h1 style='color: red;'>❌ Erro de Configuração</h1>";
    echo "<hr>";
    echo "<p><strong>O arquivo config.php não foi encontrado!</strong></p>";
    echo "<p>Siga estas instruções:</p>";
    echo "<ol>";
    echo "<li>Copie o arquivo <code>config.example.php</code></li>";
    echo "<li>Renomeie a cópia para <code>config.php</code></li>";
    echo "<li>Edite o <code>config.php</code> e configure suas credenciais SMTP</li>";
    echo "<li>Recarregue esta página</li>";
    echo "</ol>";
    exit;
}

require 'config.php';

echo "<h1>🧪 Teste PHPMailer</h1>";
echo "<hr>";

// Usar configurações do config.php
$smtp_host = SMTP_HOST;
$smtp_port = SMTP_PORT;
$smtp_secure = SMTP_SECURE;
$smtp_username = SMTP_USERNAME;
$smtp_password = SMTP_PASSWORD;
$email_destino = EMAIL_COPIA; // Usa o e-mail de cópia como destino do teste

echo "<strong>Configurações (do config.php):</strong><br>";
echo "Host: $smtp_host<br>";
echo "Porta: $smtp_port<br>";
echo "Segurança: $smtp_secure<br>";
echo "Usuário: $smtp_username<br>";
echo "Senha: " . (empty($smtp_password) || $smtp_password == 'SUA_SENHA_AQUI' ? '❌ NÃO CONFIGURADA' : '✅ Configurada') . "<br>";
echo "E-mail destino: $email_destino<br>";
echo "<hr>";

if (empty($smtp_password) || $smtp_password == 'SUA_SENHA_AQUI') {
    echo "<p style='color: red;'><strong>❌ ERRO:</strong> Configure a senha SMTP no arquivo <code>config.php</code></p>";
    exit;
}

try {
    echo "<p>📧 Iniciando teste de envio...</p>";
    
    $mail = new PHPMailer(true);
    
    // Configurações do servidor
    $mail->SMTPDebug = 2; // Debug detalhado
    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;
    $mail->SMTPSecure = $smtp_secure;
    $mail->Port = $smtp_port;
    $mail->CharSet = 'UTF-8';
    
    echo "<p>✅ Configurações SMTP aplicadas</p>";
    
    // Remetente e destinatário
    $mail->setFrom($smtp_username, 'Teste PHPMailer');
    $mail->addAddress($email_destino);
    
    echo "<p>✅ Remetente e destinatário configurados</p>";
    
    // Conteúdo
    $mail->isHTML(true);
    $mail->Subject = '🧪 Teste PHPMailer - ' . date('d/m/Y H:i:s');
    $mail->Body = '
    <html>
    <body style="font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5;">
        <div style="max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px;">
            <h1 style="color: #3f7052;">✅ PHPMailer Funcionando!</h1>
            <p>Este é um e-mail de teste enviado em <strong>' . date('d/m/Y \à\s H:i:s') . '</strong></p>
            <p>Se você está recebendo este e-mail, significa que o PHPMailer está configurado corretamente!</p>
            <hr>
            <p style="font-size: 12px; color: #666;">
                Host: ' . $smtp_host . '<br>
                Porta: ' . $smtp_port . '<br>
                Segurança: ' . $smtp_secure . '
            </p>
        </div>
    </body>
    </html>
    ';
    
    echo "<p>✅ Conteúdo do e-mail preparado</p>";
    echo "<p>📤 Enviando e-mail...</p>";
    echo "<hr>";
    
    // Enviar
    $mail->send();
    
    echo "<hr>";
    echo "<h2 style='color: green;'>✅ E-MAIL ENVIADO COM SUCESSO!</h2>";
    echo "<p>Verifique a caixa de entrada (e spam) de: <strong>$email_destino</strong></p>";
    echo "<hr>";
    echo "<p><strong>Próximo passo:</strong> Edite o arquivo <code>send-email.php</code> e configure as mesmas credenciais.</p>";
    
} catch (Exception $e) {
    echo "<hr>";
    echo "<h2 style='color: red;'>❌ ERRO AO ENVIAR E-MAIL</h2>";
    echo "<p><strong>Mensagem de erro:</strong></p>";
    echo "<pre style='background: #ffe6e6; padding: 15px; border-radius: 5px; border-left: 4px solid red;'>";
    echo $e->getMessage();
    echo "</pre>";
    
    echo "<hr>";
    echo "<h3>💡 Soluções possíveis:</h3>";
    echo "<ul>";
    echo "<li><strong>Authentication failed:</strong> Verifique usuário e senha</li>";
    echo "<li><strong>Could not connect:</strong> Verifique o host e porta SMTP</li>";
    echo "<li><strong>SSL/TLS error:</strong> Troque 'ssl' por 'tls' ou a porta 465 por 587</li>";
    echo "<li><strong>Gmail:</strong> Use 'Senha de app' (não a senha normal)</li>";
    echo "</ul>";
    
    echo "<hr>";
    echo "<h3>📝 Informações do servidor:</h3>";
    echo "<ul>";
    echo "<li>PHP Version: " . phpversion() . "</li>";
    echo "<li>OpenSSL: " . (extension_loaded('openssl') ? '✅ Habilitado' : '❌ Desabilitado') . "</li>";
    echo "<li>PHPMailer: " . (class_exists('PHPMailer\PHPMailer\PHPMailer') ? '✅ Instalado' : '❌ Não encontrado') . "</li>";
    echo "</ul>";
}
?>
