# 🌿 Site da Dra. Gerlen Mascarenhas

> Website profissional para fisioterapeuta especializada em atendimento domiciliar, Pilates terapêutico e saúde da mulher em Manaus/AM.

[![Status](https://img.shields.io/badge/status-active-success.svg)]()
[![License](https://img.shields.io/badge/license-MIT-blue.svg)]()

## 📋 Sobre o Projeto

Site institucional desenvolvido para a Dra. Gerlen Mascarenhas, fisioterapeuta em Manaus/AM, com foco em conversão de leads, SEO otimizado e experiência mobile-first. O projeto apresenta serviços especializados, depoimentos de pacientes e integração direta com WhatsApp.

### ✨ Destaques

- 🎨 Design elegante e premium com paleta verde/dourado/bege
- 📱 Totalmente responsivo (mobile-first)
- 🚀 SEO avançado com Schema.org e Open Graph
- ♿ Acessibilidade WCAG 2.1 Level AA
- 🔄 Carrossel automático de depoimentos
- 💬 Integração WhatsApp para agendamentos
- ⚡ Performance otimizada

## 🗂️ Estrutura do Projeto

```
gerlen-mascarenhas-site/
├── index.html                      # Página principal (SPA)
├── README.md                       # Documentação do projeto
├── ANALISE-MELHORIAS.md           # Análise técnica e melhorias implementadas
├── robots.txt                      # Diretivas para crawlers
├── sitemap.xml                     # Mapa do site para SEO
│
├── src/
│   ├── css/
│   │   ├── normalize.css          # Reset CSS
│   │   ├── colors.css             # Variáveis de cores
│   │   └── styles.css             # Estilos principais
│   │
│   ├── js/
│   │   ├── main.js                # Script principal (scroll, menu, animações)
│   │   └── form-validation.js     # Validação do formulário de contato
│   │
│   └── pages/                     # Páginas internas (futuro)
│       ├── blog.html
│       ├── contato.html
│       ├── depoimentos.html
│       ├── servicos.html
│       └── sobre.html
│
└── assets/
    ├── images/                    # Imagens do site
    │   ├── logo.png
    │   ├── banner-hero-*.png
    │   ├── dra-gerlen.jpg
    │   ├── mosaic*.jpg
    │   └── favicon.png
    │
    ├── svg/                       # Ícones e gráficos vetoriais
    │   └── wave-hero.html
    │
    └── fontes/                    # Fontes locais (se necessário)
```

## 🚀 Tecnologias Utilizadas

### Frontend

- **HTML5** - Semântica e acessibilidade
- **CSS3** - Flexbox, Grid, Custom Properties
- **JavaScript (Vanilla)** - Sem dependências externas
- **Tailwind CSS 3.x** - Framework CSS via CDN

### Tipografia

- **Google Fonts** - Quicksand (300, 400, 500, 600, 700)

### SEO & Performance

- Open Graph Protocol
- Twitter Cards
- Schema.org (JSON-LD)
- Lazy Loading de imagens
- Preconnect para recursos externos

## 📱 Seções do Site

1. **Hero Section** - Apresentação principal com CTA
2. **Dores** - Cards de problemas que a fisioterapia resolve
3. **Chamada-Dores** - CTA intermediário com card destacado
4. **Sobre** - Biografia e formação da Dra. Gerlen
5. **Serviços** - Grid de 6 serviços especializados
6. **Depoimentos** - Carrossel automático de testemunhos
7. **Instagram** - Grid de posts recentes
8. **Contato** - Formulário + informações + WhatsApp
9. **Footer** - Links, especialidades e redes sociais

## 🎨 Paleta de Cores

```css
--color-verde-principal: #3f7052    /* Verde elegante */
--color-bege-secondary: #d4b483     /* Bege sofisticado */
--color-dourado: #d2a956            /* Dourado accent */
--color-rosa-perolado: #cfaeaa      /* Rosa perolado */
--color-background: #f5efe6         /* Fundo suave */
--color-background-branco: #ffffff  /* Branco puro */
```

## 💻 Instalação e Uso

### Pré-requisitos

- Navegador web moderno (Chrome, Firefox, Safari, Edge)
- Servidor local (opcional, recomendado: Live Server, Five Server)

### Instalação

1. **Clone o repositório**

```bash
git clone https://github.com/iokimdiego/gerlen-mascarenhas-site.git
cd gerlen-mascarenhas-site
```

2. **Abra com Live Server**

```bash
# Via VS Code com extensão Live Server
# Clique com botão direito em index.html > "Open with Live Server"
```

3. **Ou abra diretamente no navegador**

```bash
# Windows
start index.html

# Mac
open index.html

# Linux
xdg-open index.html
```

## 🔧 Configuração

### Integração WhatsApp

Atualize o número nos links de CTA:

```html
<!-- Trocar 5592992555753 pelo número desejado -->
<a href="https://wa.me/5592992555753?text=Mensagem"></a>
```

### Google Analytics (Futuro)

Adicionar antes do `</head>`:

```html
<!-- Global site tag (gtag.js) -->
<script
  async
  src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"
></script>
```

### Formulário de Contato

Configurar backend no arquivo `src/js/form-validation.js`:

```javascript
// Linha ~50: atualizar endpoint
const response = await fetch("SUA_API_AQUI", {
  method: "POST",
  body: formData,
});
```

## 📊 Features Implementadas

### ✅ SEO Avançado

- [x] Meta tags otimizadas com keywords locais
- [x] Open Graph para redes sociais
- [x] Twitter Cards
- [x] Schema.org (MedicalBusiness)
- [x] Canonical URL
- [x] Sitemap.xml
- [x] Robots.txt

### ✅ Responsividade

- [x] Mobile-first design
- [x] Breakpoints: 640px, 768px, 820px, 1024px
- [x] Header fixo translúcido
- [x] Hero section adaptativo
- [x] Grid responsivo de serviços
- [x] Carrossel mobile de depoimentos
- [x] Footer em coluna única (mobile)

### ✅ Acessibilidade

- [x] ARIA labels
- [x] Navegação por teclado
- [x] Contraste WCAG AA
- [x] Semântica HTML5
- [x] Alt text descritivo
- [x] Focus indicators

### ✅ Performance

- [x] Lazy loading de imagens
- [x] Preconnect para fonts
- [x] CSS otimizado
- [x] JavaScript vanilla (sem jQuery)
- [x] Scroll suave
- [x] Animações performáticas

### ✅ UX/UI

- [x] Botão flutuante WhatsApp
- [x] Carrossel automático de depoimentos
- [x] Animações de entrada
- [x] Hover effects elegantes
- [x] Menu mobile hamburger
- [x] CTAs estratégicos

## 🎯 Roadmap

### Fase 2 (Futuro)

- [ ] Blog com artigos sobre fisioterapia
- [ ] Sistema de agendamento online
- [ ] Área de pacientes (login)
- [ ] Integração com Google Calendar
- [ ] Chat ao vivo
- [ ] PWA (Progressive Web App)
- [ ] Dark mode
- [ ] Multilíngue (EN/ES)

## 📈 Métricas de Performance

### Lighthouse Score (Objetivo)

- Performance: 90+
- Accessibility: 95+
- Best Practices: 100
- SEO: 100

### Core Web Vitals

- LCP (Largest Contentful Paint): < 2.5s
- FID (First Input Delay): < 100ms
- CLS (Cumulative Layout Shift): < 0.1

## 🐛 Problemas Conhecidos

- [ ] Imagens do Instagram devem ser atualizadas via API real
- [ ] Formulário precisa de backend para envio de e-mails
- [ ] Mapa no rodapé pode ser adicionado (Google Maps Embed)

## 🤝 Contribuindo

Contribuições são bem-vindas! Para contribuir:

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 👨‍💻 Desenvolvedor

**Iokim Diego**

- Website: [iokimdiego.dev.br](https://iokimdiego.dev.br)
- GitHub: [@iokimdiego](https://github.com/iokimdiego)

## 📞 Contato do Cliente

**Dra. Gerlen Mascarenhas**

- WhatsApp: (92) 99255-5753
- Instagram: [@gerlenmascarenhas](https://www.instagram.com/gerlenmascarenhas)
- Email: contato@gerlenmascarenhas.com.br
- Local: Clínica Knesys, Manaus/AM

---

⭐ **Se este projeto foi útil, deixe uma estrela!**

**Desenvolvido com 💚 por [Iokim Diego](https://iokimdiego.dev.br)**
