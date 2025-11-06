# 🔧 Solução: Problema de Autenticação SMTP

## ✅ Diagnóstico Confirmado

**Conexão:** ✅ Funcionando (debug-smtp.php passou)  
**Autenticação:** ❌ Falhando (senha incorreta ou e-mail não existe)

---

## 🎯 Solução: Resetar Credenciais

### **Passo 1: Verificar/Criar E-mail no cPanel**

1. Acesse o **cPanel do HostGator**
2. Procure por **"Contas de E-mail"** ou **"Email Accounts"**
3. Verifique se `noreply@gerlenmascarenhas.com.br` existe na lista

#### **Se o e-mail NÃO existir:**

Crie agora:

```
E-mail: noreply
Domínio: @gerlenmascarenhas.com.br
Senha: [Crie uma senha FORTE - anote!]
Cota: 250 MB (ou ilimitado)
```

**Exemplo de senha forte:**

```
GerlenEmail2024!
NaoResponda@2024
NoReply#Titan25
```

#### **Se o e-mail JÁ existir:**

Redefina a senha:

1. Clique nos **3 pontinhos** ou **"Gerenciar"** ao lado do e-mail
2. Clique em **"Alterar Senha"** ou **"Change Password"**
3. Crie uma nova senha forte (anote!)
4. Salve

---

### **Passo 2: Atualizar GitHub Secrets**

Acesse:

```
https://github.com/iokimdiego/gerlen-mascarenhas-site/settings/secrets/actions
```

**Atualize APENAS este Secret:**

```
Nome: SMTP_PASSWORD
Valor: [SENHA_QUE_VOCE_CRIOU_NO_CPANEL]
```

**Como atualizar:**

1. Clique em `SMTP_PASSWORD`
2. Clique em **"Update secret"**
3. Cole a SENHA EXATA do cPanel (sem espaços extras)
4. Clique em **"Update secret"** novamente

---

### **Passo 3: Forçar Novo Deploy**

Agora vamos forçar o GitHub Actions a rodar novamente e atualizar o servidor:

**Opção A - Fazer um commit vazio:**

```bash
git commit --allow-empty -m "Trigger: Force redeploy with updated SMTP_PASSWORD"
git push origin main
```

**Opção B - Rodar workflow manualmente:**

1. Acesse: https://github.com/iokimdiego/gerlen-mascarenhas-site/actions
2. Clique no workflow **"Deploy to HostGator"**
3. Clique em **"Run workflow"** → **"Run workflow"**

---

### **Passo 4: Aguardar Deploy (1-2 minutos)**

Acompanhe em:

```
https://github.com/iokimdiego/gerlen-mascarenhas-site/actions
```

Aguarde até o workflow ficar **verde ✅**

---

### **Passo 5: Testar Novamente**

Após o deploy, acesse:

**Teste 1:**

```
https://gerlenmascarenhas.com.br/test-phpmailer.php
```

**Resultado esperado:**

```
✅ Configuração OK!
✅ E-mail enviado com sucesso!
```

**Teste 2:**

```
https://gerlenmascarenhas.com.br
```

Preencha o formulário de contato e envie.

**Resultado esperado:**

```
Mensagem enviada com sucesso! Em breve entraremos em contato.
```

---

## 🚨 Se Ainda Não Funcionar

### **Problema 1: Senha com caracteres especiais**

Alguns servidores têm problema com certos caracteres. Tente uma senha sem:

- Aspas: `"` ou `'`
- Barra invertida: `\`
- Cifrão: `$`
- Acento: `á`, `é`, `ç`

**Senha recomendada:**

```
Use apenas: A-Z, a-z, 0-9, @, #, !, %
Exemplo: GerlenEmail2024!
```

### **Problema 2: E-mail não está ativo**

No cPanel, verifique se o e-mail tem:

- ✅ Status "Ativo"
- ✅ Cota disponível (não está cheio)
- ✅ Sem suspenso

### **Problema 3: Titan Email não ativado**

Entre em contato com suporte HostGator:

**Mensagem para enviar:**

```
Olá,

Estou tentando enviar e-mails via SMTP usando:
- Servidor: smtp.titan.email
- Porta: 587 (TLS)
- E-mail: noreply@gerlenmascarenhas.com.br

Recebo erro "Could not authenticate".

Perguntas:
1. O Titan Email está ativado para meu domínio?
2. Existe alguma restrição no e-mail noreply@gerlenmascarenhas.com.br?
3. Preciso ativar SMTP externamente?

Obrigado!
```

---

## 🔄 Fluxo Completo de Correção

```
1. cPanel → Criar/Resetar senha do e-mail noreply@gerlenmascarenhas.com.br
   ↓
2. GitHub → Atualizar Secret SMTP_PASSWORD
   ↓
3. Terminal → git commit + git push (ou rodar workflow manualmente)
   ↓
4. Aguardar → Deploy concluir (1-2 min)
   ↓
5. Testar → test-phpmailer.php e formulário do site
   ↓
6. Sucesso! ✅
```

---

## 📋 Checklist de Verificação

- [ ] E-mail `noreply@gerlenmascarenhas.com.br` existe no cPanel?
- [ ] Senha do e-mail foi criada/resetada?
- [ ] Senha anotada em local seguro?
- [ ] GitHub Secret `SMTP_PASSWORD` atualizado?
- [ ] Deploy foi executado após atualizar Secret?
- [ ] Aguardou deploy concluir (workflow verde)?
- [ ] Testou `test-phpmailer.php`?
- [ ] Testou formulário do site?

---

## 💡 Dicas Importantes

### **Senha forte mas simples:**

```
✅ BOM: GerlenEmail2024!
✅ BOM: NoReply@Titan25
❌ RUIM: 123456
❌ RUIM: senha
```

### **Copiar/Colar senha:**

- Use CTRL+C / CTRL+V
- Evite digitar manualmente
- Não deixe espaços no início/fim

### **GitHub Secret:**

- Cole exatamente como está no cPanel
- Sem espaços antes ou depois
- Case sensitive (maiúsculas/minúsculas importam)

---

## 🎯 Comandos Prontos

```bash
# 1. Forçar novo deploy
git commit --allow-empty -m "Trigger: Update SMTP credentials"
git push origin main

# 2. Ver status do deploy
# Abra: https://github.com/iokimdiego/gerlen-mascarenhas-site/actions
```

---

## ✅ Após Funcionar

1. **Desativar DEBUG_MODE:**

   - Atualize Secret: `DEBUG_MODE` → `false`
   - Faça novo deploy

2. **Remover arquivos de teste:**

   ```bash
   # Não delete localmente, delete no servidor via FTP/cPanel
   # Ou adicione ao .github/workflows/deploy.yml na exclusão
   ```

3. **Testar envio completo:**
   - Preencha formulário
   - Verifique se chegou em `contato@gerlenmascarenhas.com.br`
   - Verifique se chegou em `iokimdiego@hotmail.com`
   - Verifique se confirmação chegou para quem enviou

---

## 📞 Precisa de Ajuda?

Se após seguir todos os passos ainda não funcionar, me informe:

1. ✅ E-mail existe no cPanel? (sim/não)
2. ✅ Resetou a senha? (sim/não)
3. ✅ Atualizou GitHub Secret? (sim/não)
4. ✅ Fez novo deploy? (sim/não)
5. ❌ Qual erro aparece agora?

---

**Boa sorte! 🚀**

A autenticação vai funcionar assim que as credenciais estiverem corretas.
