# 🔒 Guia de Configuração Segura - PHPMailer

## ✅ Sistema de Segurança Implementado

O sistema agora usa **variáveis de ambiente** e **arquivo de configuração privado** para proteger suas credenciais.

---

## 📁 Estrutura de Arquivos

```
├── config.example.php      ← Template público (SEM senhas)
├── config.php              ← Suas credenciais REAIS (PRIVADO - não vai pro GitHub)
├── send-email.php          ← Backend (usa config.php)
├── test-phpmailer.php      ← Teste (usa config.php)
├── .htaccess               ← Protege config.php de acesso web
└── .gitignore              ← Ignora config.php no Git
```

---

## 🚀 Setup Inicial (Primeira Vez)

### **Passo 1: Criar Arquivo de Configuração**

```bash
# Copie o template
cp config.example.php config.php
```

Ou manualmente:

1. Copie o arquivo `config.example.php`
2. Renomeie a cópia para `config.php`

---

### **Passo 2: Configurar Credenciais**

Edite o arquivo `config.php` e preencha suas credenciais:

#### **Opção A: E-mail do Domínio (HostGator)**

```php
define('SMTP_HOST', 'mail.gerlenmascarenhas.com.br');
define('SMTP_PORT', 465);
define('SMTP_SECURE', 'ssl');
define('SMTP_USERNAME', 'noreply@gerlenmascarenhas.com.br');
define('SMTP_PASSWORD', 'SUA_SENHA_REAL_AQUI'); // ← ALTERE AQUI
```

**Como criar e-mail no cPanel:**

1. Acesse cPanel → **Contas de E-mail**
2. Clique em **Criar**
3. E-mail: `noreply@gerlenmascarenhas.com.br`
4. Senha: Crie uma senha forte
5. Salve e use no `config.php`

---

#### **Opção B: Gmail**

```php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
define('SMTP_USERNAME', 'seu-email@gmail.com');
define('SMTP_PASSWORD', 'xxxx xxxx xxxx xxxx'); // Senha de app (16 dígitos)
```

**Como gerar Senha de App no Gmail:**

1. Acesse: https://myaccount.google.com/security
2. Ative **"Verificação em duas etapas"**
3. Procure **"Senhas de app"**
4. Selecione **"Correio"** → **"Outro"**
5. Copie a senha de 16 dígitos

---

### **Passo 3: Testar Configuração**

**No servidor local:**

```bash
php test-phpmailer.php
```

**No servidor web:**

```
https://gerlenmascarenhas.com.br/test-phpmailer.php
```

Se aparecer **"✅ E-MAIL ENVIADO COM SUCESSO!"**, está funcionando!

---

### **Passo 4: Desativar Debug em Produção**

Edite o `config.php`:

```php
define('DEBUG_MODE', false); // Altere de true para false
```

---

### **Passo 5: Deletar Arquivo de Teste**

Por segurança, delete o arquivo de teste:

```bash
rm test-phpmailer.php
```

Ou no servidor via FTP/cPanel.

---

## 🔒 Segurança Implementada

### ✅ **Proteções Ativas:**

1. **`.gitignore`** - `config.php` nunca vai para o GitHub
2. **`.htaccess`** - `config.php` não pode ser acessado via web
3. **Arquivo separado** - Credenciais isoladas do código
4. **Template público** - `config.example.php` sem senhas reais
5. **Logs protegidos** - `email-logs.txt` bloqueado via `.htaccess`

---

## 📋 Checklist de Segurança

- [ ] Arquivo `config.php` criado com credenciais reais
- [ ] Arquivo `config.php` está no `.gitignore`
- [ ] Arquivo `.htaccess` está no servidor
- [ ] Testado via `test-phpmailer.php`
- [ ] DEBUG_MODE = false em produção
- [ ] Arquivo `test-phpmailer.php` deletado após testes
- [ ] Nunca fez commit do `config.php`

---

## 🚨 O que NUNCA fazer

❌ **NUNCA** faça commit do `config.php`  
❌ **NUNCA** exponha suas senhas no código  
❌ **NUNCA** compartilhe o `config.php` publicamente  
❌ **NUNCA** deixe `DEBUG_MODE = true` em produção  
❌ **NUNCA** deixe `test-phpmailer.php` no servidor após configurar

---

## 🔄 Deploy para Servidor

### **Passo 1: Fazer Commit (SEM config.php)**

```bash
git add .
git commit -m "feat: Implementar sistema seguro de configuração"
git push origin main
```

O `config.php` **NÃO** será enviado (está no `.gitignore`)

---

### **Passo 2: Criar config.php no Servidor**

**Via cPanel File Manager:**

1. Acesse File Manager → public_html
2. Clique em **"+ File"**
3. Nome: `config.php`
4. Edite e cole o conteúdo com suas credenciais

**Via FTP:**

1. Crie `config.php` localmente
2. Faça upload via FTP
3. Não adicione ao Git

**Via SSH:**

```bash
cp config.example.php config.php
nano config.php  # Edite as credenciais
```

---

### **Passo 3: Configurar Permissões**

```bash
chmod 600 config.php  # Somente o servidor pode ler
```

Ou via cPanel File Manager:

- Clique com botão direito → Permissions
- Defina: `600` (rw-------)

---

## 🧪 Testando Diferentes Ambientes

### **Desenvolvimento Local:**

```php
// config.php (local)
define('DEBUG_MODE', true);
define('SMTP_HOST', 'smtp.gmail.com'); // Use Gmail para testes
```

### **Produção:**

```php
// config.php (servidor)
define('DEBUG_MODE', false);
define('SMTP_HOST', 'mail.gerlenmascarenhas.com.br'); // E-mail do domínio
```

---

## 🆘 Troubleshooting

### **Erro: "config.php não encontrado"**

- Certifique-se de criar o arquivo `config.php` a partir do `config.example.php`
- Verifique se o arquivo está no mesmo diretório que `send-email.php`

### **Erro: "Acesso negado ao config.php"**

- Normal! O `.htaccess` está protegendo
- O PHP consegue ler internamente, mas navegadores não

### **Erro no Git: "config.php modificado"**

- Verifique se está no `.gitignore`
- Execute: `git rm --cached config.php`

---

## 📞 Variáveis Disponíveis no config.php

```php
EMAIL_DESTINO          // E-mail principal para receber mensagens
EMAIL_COPIA            // E-mail de cópia (opcional)
NOME_REMETENTE         // Nome exibido no e-mail
DOMINIO                // Domínio do site
SMTP_HOST              // Servidor SMTP
SMTP_PORT              // Porta SMTP (465 ou 587)
SMTP_SECURE            // Segurança (ssl ou tls)
SMTP_USERNAME          // Usuário SMTP (e-mail)
SMTP_PASSWORD          // Senha SMTP
DEBUG_MODE             // true = desenvolvimento, false = produção
MAX_MESSAGE_LENGTH     // Tamanho máximo da mensagem
MIN_MESSAGE_LENGTH     // Tamanho mínimo da mensagem
ALLOWED_ORIGINS        // CORS (domínios permitidos)
```

---

## 🎯 Resumo Rápido

1. ✅ Copie `config.example.php` → `config.php`
2. ✅ Edite `config.php` com suas credenciais
3. ✅ Teste com `test-phpmailer.php`
4. ✅ Faça commit (o `config.php` não vai)
5. ✅ Crie `config.php` manualmente no servidor
6. ✅ Delete `test-phpmailer.php` após configurar

---

**Sistema criado por:** GitHub Copilot  
**Data:** 6 de novembro de 2025  
**Versão:** 4.0 - Sistema Seguro com Configuração Separada
