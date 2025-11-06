<?php
/**
 * DEBUG SMTP - Diagnóstico Detalhado
 * Este arquivo ajuda a identificar problemas de autenticação SMTP
 */

// Carregar configurações
if (!file_exists('config.php')) {
    die("❌ Arquivo config.php não encontrado!");
}

require 'config.php';

echo "<h1>🔍 Diagnóstico SMTP</h1>";
echo "<hr>";

// Informações do servidor
echo "<h2>📊 Informações do Servidor</h2>";
echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
echo "<tr><th>Item</th><th>Valor</th></tr>";
echo "<tr><td>PHP Version</td><td>" . phpversion() . "</td></tr>";
echo "<tr><td>OpenSSL</td><td>" . (extension_loaded('openssl') ? '✅ Habilitado' : '❌ Desabilitado') . "</td></tr>";
echo "<tr><td>Socket</td><td>" . (function_exists('fsockopen') ? '✅ Habilitado' : '❌ Desabilitado') . "</td></tr>";
echo "</table>";
echo "<hr>";

// Configurações do config.php
echo "<h2>⚙️ Configurações Carregadas</h2>";
echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
echo "<tr><th>Configuração</th><th>Valor</th></tr>";
echo "<tr><td>SMTP_HOST</td><td>" . SMTP_HOST . "</td></tr>";
echo "<tr><td>SMTP_PORT</td><td>" . SMTP_PORT . "</td></tr>";
echo "<tr><td>SMTP_SECURE</td><td>" . SMTP_SECURE . "</td></tr>";
echo "<tr><td>SMTP_USERNAME</td><td>" . SMTP_USERNAME . "</td></tr>";
echo "<tr><td>SMTP_PASSWORD</td><td>" . (empty(SMTP_PASSWORD) ? '❌ VAZIA' : '✅ Configurada (' . strlen(SMTP_PASSWORD) . ' caracteres)') . "</td></tr>";
echo "</table>";
echo "<hr>";

// Teste de conexão
echo "<h2>🔌 Teste de Conexão</h2>";

$host = SMTP_HOST;
$port = SMTP_PORT;

echo "<p>Tentando conectar em <strong>$host:$port</strong>...</p>";

$timeout = 10;
$errno = 0;
$errstr = '';

$fp = @fsockopen($host, $port, $errno, $errstr, $timeout);

if ($fp) {
    echo "<p style='color: green;'>✅ <strong>Conexão bem-sucedida!</strong></p>";
    fclose($fp);
} else {
    echo "<p style='color: red;'>❌ <strong>Falha na conexão</strong></p>";
    echo "<p>Erro: $errstr ($errno)</p>";
    echo "<hr>";
    echo "<h3>💡 Soluções:</h3>";
    echo "<ul>";
    echo "<li>Verifique se o host está correto</li>";
    echo "<li>Tente trocar a porta (465 ↔ 587)</li>";
    echo "<li>Verifique se o firewall não está bloqueando</li>";
    echo "</ul>";
    exit;
}

echo "<hr>";

// Sugestões de configuração
echo "<h2>💡 Configurações Alternativas para Testar</h2>";

echo "<h3>HostGator Titan Email - Opção 1 (RECOMENDADO):</h3>";
echo "<pre>";
echo "SMTP_HOST = smtp.titan.email\n";
echo "SMTP_PORT = 587\n";
echo "SMTP_SECURE = tls\n";
echo "SMTP_USERNAME = noreply@gerlenmascarenhas.com.br\n";
echo "SMTP_PASSWORD = [senha do e-mail criado no cPanel]\n";
echo "</pre>";

echo "<h3>HostGator Titan Email - Opção 2 (SSL):</h3>";
echo "<pre>";
echo "SMTP_HOST = smtp.titan.email\n";
echo "SMTP_PORT = 465\n";
echo "SMTP_SECURE = ssl\n";
echo "SMTP_USERNAME = noreply@gerlenmascarenhas.com.br\n";
echo "SMTP_PASSWORD = [senha do e-mail criado no cPanel]\n";
echo "</pre>";

echo "<h3>Servidor Antigo (pode não funcionar):</h3>";
echo "<pre>";
echo "SMTP_HOST = mail.gerlenmascarenhas.com.br\n";
echo "SMTP_PORT = 587\n";
echo "SMTP_SECURE = tls\n";
echo "SMTP_USERNAME = noreply@gerlenmascarenhas.com.br\n";
echo "SMTP_PASSWORD = [senha do e-mail criado no cPanel]\n";
echo "</pre>";

echo "<h3>Gmail:</h3>";
echo "<pre>";
echo "SMTP_HOST = smtp.gmail.com\n";
echo "SMTP_PORT = 587\n";
echo "SMTP_SECURE = tls\n";
echo "SMTP_USERNAME = seu-email@gmail.com\n";
echo "SMTP_PASSWORD = [senha de app de 16 dígitos]\n";
echo "</pre>";

echo "<hr>";

// Verificações adicionais
echo "<h2>🔍 Verificações Importantes</h2>";
echo "<ul>";

// Verificar se o e-mail existe
if (SMTP_USERNAME && filter_var(SMTP_USERNAME, FILTER_VALIDATE_EMAIL)) {
    echo "<li>✅ SMTP_USERNAME é um e-mail válido</li>";
} else {
    echo "<li>❌ SMTP_USERNAME não é um e-mail válido</li>";
}

// Verificar senha
if (!empty(SMTP_PASSWORD) && SMTP_PASSWORD != 'SUA_SENHA_AQUI') {
    echo "<li>✅ SMTP_PASSWORD está configurada</li>";
} else {
    echo "<li>❌ SMTP_PASSWORD não está configurada ou usa valor padrão</li>";
}

// Verificar combinação porta/segurança
if ((SMTP_PORT == 465 && SMTP_SECURE == 'ssl') || (SMTP_PORT == 587 && SMTP_SECURE == 'tls')) {
    echo "<li>✅ Combinação porta/segurança está correta</li>";
} else {
    echo "<li>⚠️ Combinação porta/segurança pode estar incorreta</li>";
    echo "<ul>";
    echo "<li>Porta 465 deve usar SSL</li>";
    echo "<li>Porta 587 deve usar TLS</li>";
    echo "</ul>";
}

echo "</ul>";
echo "<hr>";

// Checklist
echo "<h2>✅ Checklist de Verificação</h2>";
echo "<ol>";
echo "<li>O e-mail <code>" . SMTP_USERNAME . "</code> existe no cPanel?</li>";
echo "<li>A senha está correta?</li>";
echo "<li>Se usar Gmail, está usando 'Senha de app' (não a senha normal)?</li>";
echo "<li>Tentou trocar porta 465 ↔ 587?</li>";
echo "<li>Tentou trocar segurança ssl ↔ tls?</li>";
echo "<li>O servidor permite conexões SMTP externas?</li>";
echo "</ol>";

echo "<hr>";
echo "<p><strong>📞 Se continuar com erro, entre em contato com o suporte do HostGator e informe:</strong></p>";
echo "<p>\"Preciso configurar SMTP para envio de e-mails via PHPMailer. Meu e-mail é " . SMTP_USERNAME . " e estou recebendo erro de autenticação.\"</p>";
?>
