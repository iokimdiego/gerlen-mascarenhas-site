# 🚀 Instruções de Deploy - HostGator

## 📌 Problema Atual

```
FTPError: 4*** Home directory not available - aborting
```

Este erro indica que o servidor FTP não consegue acessar o diretório home especificado.

## ✅ Solução: Configurar Corretamente o FTP

### **Passo 1: Obter Credenciais Corretas do HostGator**

1. Acesse o **cPanel do HostGator**
2. Vá em **Arquivos** → **Contas FTP**
3. Anote as informações:
   - **Servidor:** `ftp.gerlenmascarenhas.com.br` (ou similar)
   - **Usuário:** `usuario@gerlenmascarenhas.com.br`
   - **Porta:** `21` (FTP padrão)
   - **Diretório Home:** Geralmente `/public_html/` ou `/home/usuario/public_html/`

### **Passo 2: Testar Conexão FTP**

Use o **FileZilla** para testar:

```
Host: ftp.gerlenmascarenhas.com.br
Usuário: seu_usuario@gerlenmascarenhas.com.br
Senha: sua_senha
Porta: 21
```

**Observação:** Anote o caminho completo onde você é direcionado ao conectar (ex: `/home/gerlenma/public_html/`)

### **Passo 3: Atualizar GitHub Secrets**

No GitHub, vá em: **Settings** → **Secrets and variables** → **Actions**

Crie/Atualize os seguintes secrets:

```
FTP_SERVER = ftp.gerlenmascarenhas.com.br
FTP_USERNAME = usuario@gerlenmascarenhas.com.br  
FTP_PASSWORD = sua_senha_ftp
```

**⚠️ REMOVA:** O secret `FTP_PORT` (agora está fixo no workflow)

### **Passo 4: Ajustar o Workflow (se necessário)**

Se após conectar no FileZilla você ver um caminho como `/home/usuario/public_html/`, edite o `deploy.yml`:

```yaml
server-dir: /home/gerlenma/public_html/
```

## 🔄 Alternativa: Deploy Manual via FTP

Se o GitHub Actions continuar falhando, você pode fazer deploy manual:

### **Opção A: FileZilla (Recomendado)**

1. Baixe e instale o [FileZilla](https://filezilla-project.org/)
2. Conecte usando as credenciais do HostGator
3. Arraste os arquivos do projeto para `/public_html/`

### **Opção B: FTP via PowerShell**

```powershell
# Instalar módulo PSFTP
Install-Module -Name Posh-FTP

# Conectar e fazer upload
$FTPServer = "ftp.gerlenmascarenhas.com.br"
$FTPUser = "usuario@gerlenmascarenhas.com.br"
$FTPPass = "senha"

# Upload de arquivos
Set-FTPConnection -Server $FTPServer -User $FTPUser -Password $FTPPass -Session MySession
Send-FTPItem -Path "./index.html" -RemotePath "/public_html/" -Session MySession
```

## 🧪 Teste de E-mail no Servidor

Após o deploy, teste o formulário de contato:

1. Acesse: `https://gerlenmascarenhas.com.br`
2. Preencha o formulário de contato
3. Verifique se o e-mail foi recebido

### **Se o e-mail não funcionar:**

Adicione este arquivo `test-email.php` na raiz:

```php
<?php
$to = 'seu_email@gmail.com';
$subject = 'Teste de Email - HostGator';
$message = 'Se você recebeu este email, o sistema está funcionando!';
$headers = 'From: noreply@gerlenmascarenhas.com.br';

if (mail($to, $subject, $message, $headers)) {
    echo 'Email enviado com sucesso!';
} else {
    echo 'Erro ao enviar email.';
}
?>
```

Acesse: `https://gerlenmascarenhas.com.br/test-email.php`

## 📞 Suporte HostGator

Se os problemas persistirem, entre em contato:

- **Chat:** [hostgator.com.br/suporte](https://www.hostgator.com.br/suporte)
- **Telefone:** 0800 591 5592
- **Ticket:** Via cPanel

Pergunte sobre:
1. Caminho correto do diretório FTP
2. Configurações de porta e protocolo
3. Permissões de envio de e-mail PHP

## ✅ Checklist Final

- [ ] Credenciais FTP corretas no GitHub Secrets
- [ ] Testado conexão no FileZilla
- [ ] Caminho `server-dir` correto no `deploy.yml`
- [ ] Arquivo `send-email.php` presente na raiz
- [ ] E-mails de destino configurados em `send-email.php`
- [ ] Formulário testado após deploy
- [ ] E-mails sendo recebidos corretamente

---

**Última Atualização:** 6 de novembro de 2025
