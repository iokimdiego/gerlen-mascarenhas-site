# 🚀 Atualização: Configuração Titan Email (HostGator)

## ✅ Nova Configuração Oficial

A HostGator informou que o servidor SMTP correto é o **Titan Email**:

```
Servidor: smtp.titan.email
Porta: 587 (TLS) ou 465 (SSL)
Usuário: endereço de e-mail completo
Senha: senha do e-mail do cPanel
```

---

## 📝 Passo a Passo de Atualização

### **1. Verificar se o E-mail Existe no cPanel**

Antes de tudo, certifique-se de que o e-mail existe:

1. Acesse o **cPanel do HostGator**
2. Vá em **"Contas de E-mail"** ou **"Email Accounts"**
3. Procure por: `noreply@gerlenmascarenhas.com.br`

**Se NÃO existir:**

- Clique em **"Criar"** ou **"Create"**
- E-mail: `noreply`
- Domínio: `@gerlenmascarenhas.com.br`
- Senha: Crie uma senha forte (anote!)

**Se JÁ existir:**

- Verifique se você tem a senha correta
- Se não tiver, redefina a senha

---

### **2. Atualizar os GitHub Secrets**

Vá para o repositório no GitHub:

```
https://github.com/iokimdiego/gerlen-mascarenhas-site/settings/secrets/actions
```

**Atualize os seguintes Secrets:**

| Secret          | Valor Antigo                       | ✅ Novo Valor                              |
| --------------- | ---------------------------------- | ------------------------------------------ |
| `SMTP_HOST`     | `mail.gerlenmascarenhas.com.br`    | `smtp.titan.email`                         |
| `SMTP_PORT`     | `465`                              | `587`                                      |
| `SMTP_SECURE`   | `ssl`                              | `tls`                                      |
| `SMTP_USERNAME` | `noreply@gerlenmascarenhas.com.br` | `noreply@gerlenmascarenhas.com.br` (mesmo) |
| `SMTP_PASSWORD` | (valor anterior)                   | **Senha do cPanel**                        |

**Como atualizar:**

1. Clique em cada Secret
2. Clique em **"Update secret"**
3. Cole o novo valor
4. Clique em **"Update secret"** novamente

---

### **3. Fazer o Deploy**

Após atualizar os Secrets, faça o commit e push:

```bash
git add .
git commit -m "Update: SMTP configuration for Titan Email (HostGator official)"
git push origin main
```

O GitHub Actions rodará automaticamente e criará o `config.php` com as novas configurações.

---

### **4. Testar**

Após o deploy (aguarde 1-2 minutos), acesse:

```
https://gerlenmascarenhas.com.br/test-phpmailer.php
```

**Resultado esperado:**

```
✅ Configuração OK!
✅ E-mail enviado com sucesso!
```

Se ainda der erro, acesse o diagnóstico:

```
https://gerlenmascarenhas.com.br/debug-smtp.php
```

---

## 🎯 Configuração Final (config.php local)

Se você também tem um `config.php` local, atualize assim:

```php
<?php
// E-mails de destino
define('EMAIL_DESTINO', 'contato@gerlenmascarenhas.com.br');
define('EMAIL_COPIA', 'iokimdiego@hotmail.com');
define('NOME_REMETENTE', 'Site Dra. Gerlen Mascarenhas');
define('DOMINIO', 'gerlenmascarenhas.com.br');

// CONFIGURAÇÃO TITAN EMAIL (HOSTGATOR)
define('SMTP_HOST', 'smtp.titan.email');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
define('SMTP_USERNAME', 'noreply@gerlenmascarenhas.com.br');
define('SMTP_PASSWORD', 'SUA_SENHA_DO_CPANEL_AQUI');

// Configurações adicionais
define('DEBUG_MODE', true);
define('MAX_MESSAGE_LENGTH', 5000);
define('MIN_MESSAGE_LENGTH', 10);
define('ALLOWED_ORIGINS', '*');
?>
```

---

## 🔍 Solução de Problemas

### **Se ainda der erro de autenticação:**

1. **Verifique a senha:**

   - Acesse cPanel → Contas de E-mail
   - Redefina a senha do e-mail `noreply@gerlenmascarenhas.com.br`
   - Use apenas letras, números e símbolos simples (@#$%)
   - Atualize o Secret `SMTP_PASSWORD` no GitHub
   - Faça novo deploy

2. **Teste com SSL em vez de TLS:**

   - SMTP_PORT = `465`
   - SMTP_SECURE = `ssl`
   - Atualize os Secrets e faça deploy

3. **Entre em contato com o Suporte:**
   - Se nada funcionar, peça para o suporte verificar se:
     - A conta de e-mail está ativa
     - Não há bloqueio de firewall
     - As configurações SMTP estão corretas

---

## ✅ Checklist Final

- [ ] E-mail `noreply@gerlenmascarenhas.com.br` existe no cPanel
- [ ] Senha do e-mail anotada e confirmada
- [ ] GitHub Secrets atualizados:
  - [ ] SMTP_HOST = `smtp.titan.email`
  - [ ] SMTP_PORT = `587`
  - [ ] SMTP_SECURE = `tls`
  - [ ] SMTP_USERNAME = `noreply@gerlenmascarenhas.com.br`
  - [ ] SMTP_PASSWORD = (senha do cPanel)
- [ ] Commit e push feitos
- [ ] GitHub Actions executou com sucesso
- [ ] Teste em `test-phpmailer.php` passou
- [ ] Formulário de contato funcionando

---

## 🎉 Após Funcionar

1. Desative o DEBUG_MODE:

   - Atualize Secret: `DEBUG_MODE` = `false`
   - Faça novo deploy

2. Delete arquivos de teste (opcional):

   - `test-phpmailer.php`
   - `debug-smtp.php`

3. Teste o formulário completo do site

---

**Boa sorte! 🚀**
