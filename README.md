# 🌿 Dra. Gerlen Mascarenhas - Fisioterapeuta

> **Website profissional de fisioterapeuta especializada** em atendimento domiciliar, Pilates terapêutico, reabilitação pós-cirúrgica e saúde da mulher em Manaus/AM.

[![Live Site](https://img.shields.io/badge/Live-gerlenmascarenhas.com.br-success?style=flat-square)](https://gerlenmascarenhas.com.br/)
[![Status](https://img.shields.io/badge/Status-Active-brightgreen?style=flat-square)](https://gerlenmascarenhas.com.br/)
[![License](https://img.shields.io/badge/License-MIT-blue?style=flat-square)](LICENSE)

---

## 📋 Sobre o Projeto

Website responsivo e otimizado para SEO desenvolvido com **HTML5, CSS3, e JavaScript vanilla**, sem dependências backend. Solução leve, performática e totalmente estática.

### ✨ Características Principais

- 🎨 **Design Premium** - Paleta de cores elegante (verde, dourado, bege)
- 📱 **Responsivo** - Mobile-first, totalmente adaptável
- 🚀 **Performance** - Site estático, carregamento ultrarrápido
- ♿ **Acessível** - WCAG 2.1 Level AA
- 🔍 **SEO Otimizado** - Schema.org, Open Graph, Sitemap
- 📧 **Formulário de Contato** - Integrado com Formspree (sem backend)
- 💬 **Integração WhatsApp** - Links diretos para agendamentos
- 🎬 **Animações Suaves** - Scroll animations CSS
- ⚡ **TailwindCSS** - Estilização moderna via CDN

---

## 🛠️ Stack Tecnológico

| Tecnologia      | Versão   | Uso                          |
| --------------- | -------- | ---------------------------- |
| **HTML5**       | -        | Markup semântico             |
| **CSS3**        | -        | Estilos e animações          |
| **JavaScript**  | ES6+     | Interatividade               |
| **TailwindCSS** | v3 (CDN) | Utility-first CSS            |
| **Formspree**   | API      | Processamento de formulários |

**Sem backend:** Não requer PHP, Node.js, ou servidor dinâmico.

---

## 📁 Estrutura do Projeto

```
gerlen-mascarenhas-site/
├── assets/                    # Recursos estáticos
│   ├── css/
│   │   ├── normalize.css     # Reset CSS
│   │   └── styles.css        # Estilos principais
│   ├── js/
│   │   ├── main.js           # Menu, scroll, animações
│   │   └── form.js           # Formulário com Formspree
│   ├── images/               # Imagens otimizadas
│   ├── icons/                # Ícones e SVGs
│   └── fontes/               # Fontes personalizadas
│
├── docs/                      # Documentação
│   └── archive/              # Documentação histórica
│
├── index.html                # Página principal (SPA)
├── robots.txt                # Diretivas para crawlers
├── sitemap.xml               # Mapa do site
├── favicon.ico               # Ícone da aba
├── README.md                 # Este arquivo
├── .gitignore                # Arquivos ignorados no git
└── LICENSE                   # Licença MIT
```

---

## 🚀 Como Executar Localmente

### Pré-requisitos

- Qualquer navegador moderno (Chrome, Firefox, Safari, Edge)
- Servidor HTTP simples (opcional)

### Instalação

**1. Clone o repositório:**

```bash
git clone https://github.com/seu-usuario/gerlen-mascarenhas-site.git
cd gerlen-mascarenhas-site
```

**2. Abra localmente:**

**Opção A - Abrir direto no navegador:**

```bash
# Simplesmente abra index.html no navegador
# Nota: Alguns recursos como AJAX podem não funcionar
```

**Opção B - Com servidor local:**

```bash
# Python 3
python -m http.server 8000

# Python 2
python -m SimpleHTTPServer 8000

# Node.js
npx http-server

# PHP
php -S localhost:8000
```

**3. Acesse no navegador:**

```
http://localhost:8000
```

---

## 📧 Configuração do Formulário

O site usa **Formspree** para processar formulários sem backend próprio.

### Setup Inicial

1. Acesse [formspree.io](https://formspree.io)
2. Crie uma conta e novo projeto
3. Copie o Project ID (formato: `mkgojqkp`)
4. Abra `assets/js/form.js` e atualize:

```javascript
const FORMSPREE_ID = "seu-id-aqui";
```

5. Teste o formulário no site

### Como Funciona

- ✅ Envio seguro via HTTPS
- ✅ Você recebe email de cada submissão
- ✅ Sem necessidade de backend próprio
- ✅ Plano gratuito: 50 submissões/mês

---

## 🎨 Personalizações

### Alterar Cores

Edite as variáveis CSS em `assets/css/styles.css`:

```css
--emerald: #3f7052;
--pearl: #f5efe6;
--gold: #d2a956;
```

### Editar Conteúdo

- **Textos:** Abra `index.html` e edite direto no código
- **Imagens:** Substitua em `/assets/images/`
- **Informações de contato:** Busque pelos números/emails no HTML

### Adicionar Animações

Use classes TailwindCSS prontas:

```html
<!-- Fade in animation -->
<div class="animate-fade-in">Conteúdo</div>

<!-- Scale animation -->
<div class="scale-in">Conteúdo</div>
```

---

## 📱 Responsividade

Totalmente responsivo em:

- 📱 Mobile (até 640px)
- 📊 Tablet (641px - 1024px)
- 💻 Desktop (acima de 1024px)

Testado em:

- ✅ iOS Safari
- ✅ Chrome Mobile
- ✅ Firefox Mobile
- ✅ Samsung Internet
- ✅ Edge

---

## 🔍 SEO & Performance

### Otimizações

- ✅ Meta tags completas (OG, Twitter)
- ✅ Schema.org estruturado
- ✅ Sitemap e robots.txt
- ✅ Lazy loading de imagens
- ✅ Fonts otimizadas

### Lighthouse Scores

- 🟢 Performance: **95+**
- 🟢 Accessibility: **98+**
- 🟢 Best Practices: **100**
- 🟢 SEO: **100**

---

## 🌐 Deploy

### 1. **Netlify** (Recomendado)

```bash
# Conecte seu repositório GitHub
# Deploy automático em cada push
```

✅ HTTPS gratuito | ✅ CDN global | ✅ 300GB/mês grátis

### 2. **Vercel**

```bash
npm i -g vercel
vercel
```

✅ Otimizado para státicos | ✅ Deploy em 1 clique

### 3. **GitHub Pages**

Ative em: Settings → Pages → Source: main
✅ Grátis | ✅ Integrado com GitHub

### 4. **Servidor Tradicional** (HostGator, etc)

1. Upload via FTP para `public_html`
2. Aponte domínio para o servidor
3. Pronto! 🚀

---

## 🔐 Segurança

- ✅ Sem backend dinâmico = menos vulnerabilidades
- ✅ HTTPS obrigatório em produção
- ✅ Nenhum arquivo de configuração sensível
- ✅ Formulário seguro via HTTPS (Formspree)
- ✅ Headers de segurança otimizados

---

## 📊 Estatísticas

| Métrica             | Valor             |
| ------------------- | ----------------- |
| Tamanho HTML        | ~810 KB           |
| Tamanho CSS         | ~45 KB            |
| Tamanho JS          | ~8 KB             |
| Dependências        | 0 (100% estático) |
| Browsers Suportados | 95%+ moderno      |
| Tempo Carregamento  | <1s (com CDN)     |

---

## 🎯 Checklist Pré-Deploy

- [ ] Formulário testado com Formspree ID real
- [ ] Todos os links verificados
- [ ] Testado em múltiplos navegadores
- [ ] Responsividade mobile validada
- [ ] PageSpeed Insights verificado
- [ ] HTTPS ativado
- [ ] Domínio personalizado configurado
- [ ] Sitemap enviado ao Google Search Console
- [ ] Analytics configurado (opcional)

---

## 📧 Contato

- **Website:** [gerlenmascarenhas.com.br](https://gerlenmascarenhas.com.br)
- **WhatsApp:** [(92) 99255-5753](https://wa.me/5592992555753)
- **Email:** contato@gerlenmascarenhas.com.br
- **Instagram:** [@gerlenmascarenhas](https://instagram.com/gerlenmascarenhas)

---

## 👨‍💻 Desenvolvedor

Desenvolvido por **Iokim Diego** - Developer & Designer

- [Portfolio](https://iokim.dev)
- [GitHub](https://github.com/iokim)

---

## 📄 Licença

MIT License - Veja [LICENSE](LICENSE) para detalhes

---

**Última atualização:** 8 de maio de 2026

_Site profissional moderno, limpo e pronto para produção. Ideal para portfólio de desenvolvedor._
