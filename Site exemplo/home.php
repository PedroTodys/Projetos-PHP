<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['ok'])) {
  header("Location: login.php");
  exit();
}
$usuario = htmlspecialchars($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Portal Econômico - Bem-vindo, <?php echo $usuario; ?></title>
  <style>
    /* Reset */
    * {
      margin: 0; padding: 0; box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #0f2027, #203a43, #1E3A8A);
      color: #cfe8ff;
      scroll-behavior: smooth;
      min-height: 100vh;
    }
    a {
      color: #3B82F6;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    a:hover {
      color: #82aaff;
    }
    header {
      position: fixed;
      top: 0; left: 0; right: 0;
      background: linear-gradient(90deg, #1E3A8A, #3B82F6);
      box-shadow: 0 3px 8px rgba(0,0,0,0.7);
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 1000;
    }
    header .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      user-select: none;
    }
    header .logo img {
      height: 36px;
      width: auto;
      border-radius: 5px;
      box-shadow: 0 0 10px #3B82F6;
    }
    header .logo span {
      font-weight: 700;
      font-size: 1.6rem;
      color: #cfe8ff;
    }
    nav {
      display: flex;
      gap: 25px;
      align-items: center;
    }
    nav a {
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
    }
    nav a.active {
      border-bottom: 2px solid #3B82F6;
      padding-bottom: 2px;
    }
    /* Hamburger */
    .hamburger {
      display: none;
      flex-direction: column;
      cursor: pointer;
      gap: 5px;
    }
    .hamburger div {
      width: 25px;
      height: 3px;
      background: #cfe8ff;
      border-radius: 2px;
      transition: 0.3s;
    }

    /* Mobile menu */
    @media(max-width: 768px) {
      nav {
        position: fixed;
        top: 60px;
        right: 0;
        background: #203a43cc;
        height: calc(100vh - 60px);
        width: 220px;
        flex-direction: column;
        padding: 20px;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        gap: 15px;
        border-radius: 8px 0 0 8px;
      }
      nav.open {
        transform: translateX(0);
      }
      .hamburger {
        display: flex;
      }
    }

    /* Sections */
    section {
      padding: 100px 20px 60px;
      max-width: 900px;
      margin: 0 auto 60px;
      background: rgba(30, 58, 138, 0.8);
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(59, 130, 246, 0.6);
      opacity: 0;
      transform: translateY(50px);
      transition: all 0.7s ease-out;
    }
    section.visible {
      opacity: 1;
      transform: translateY(0);
    }
    section h2 {
      color: #cfe8ff;
      margin-bottom: 20px;
      border-left: 6px solid #3B82F6;
      padding-left: 15px;
      font-size: 1.8rem;
      user-select: none;
    }
    section p {
      font-size: 1.1rem;
      line-height: 1.5;
      color: #d0e7ffcc;
    }
    /* Buttons */
    .btn {
      background: #3B82F6;
      color: #fff;
      padding: 12px 25px;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      font-weight: 700;
      font-size: 1rem;
      box-shadow: 0 0 15px #3B82F6aa;
      transition: background 0.3s ease;
      margin-top: 20px;
      user-select: none;
    }
    .btn:hover {
      background: #6ea4ff;
      box-shadow: 0 0 25px #6ea4ffcc;
    }

    /* Welcome and logout */
    .user-info {
      color: #cfe8ff;
      font-weight: 600;
      font-size: 1.1rem;
      user-select: none;
      align-self: center;
      margin-right: 20px;
    }
    .logout-btn {
      background: transparent;
      border: 2px solid #3B82F6;
      color: #3B82F6;
      padding: 8px 18px;
      border-radius: 20px;
      cursor: pointer;
      font-weight: 700;
      font-size: 0.9rem;
      box-shadow: 0 0 10px #3B82F6;
      transition: background 0.3s ease, color 0.3s ease;
      user-select: none;
    }
    .logout-btn:hover {
      background: #3B82F6;
      color: #1E3A8A;
      box-shadow: 0 0 20px #3B82F6;
    }

    footer {
      text-align: center;
      color: #93c5fd;
      border-top: 1px solid #2563eb;
      padding: 15px 10px;
      font-size: 0.85rem;
      text-shadow: 0 0 3px #000a;
      user-select: none;
    }
    footer span {
      display: block;
      margin-top: 6px;
      font-style: italic;
      color: #cfe8ffcc;
    }
  </style>
</head>
<body>

<header>
  <div class="logo">
    <img src="logodaempresa.png" alt="Logo Portal Econômico" />
    <span>Portal Econômico</span>
  </div>
  <nav id="nav-menu">
    <a href="#inicio" class="active">Início</a>
    <a href="#noticias">Notícias</a>
    <a href="#sobre">Sobre</a>
    <a href="#contato">Contato</a>
    <span class="user-info">Olá, <?php echo $usuario; ?>!</span>
    <button class="logout-btn" onclick="location.href='logout.php'">Sair</button>
  </nav>
  <div class="hamburger" id="hamburger" aria-label="Menu">
    <div></div>
    <div></div>
    <div></div>
  </div>
</header>

<main>
  <section id="inicio" class="visible">
    <h2>Bem-vindo ao Portal Econômico</h2>
    <p>Este é um espaço para você acompanhar as últimas notícias, análises e dados econômicos relevantes.</p>
    <button class="btn" onclick="alert('Funcionalidade fictícia')">Veja mais</button>
  </section>

  <section id="noticias">
    <h2>Notícias em Destaque</h2>
    <p>Mercado de ações em alta após anúncio de novas políticas econômicas.</p>
    <p>PIB apresenta crescimento estável no último trimestre.</p>
    <p>Inflação mantém-se dentro da meta projetada pelo Banco Central.</p>
  </section>

  <section id="sobre">
    <h2>Sobre Nós</h2>
    <p>Somos um portal fictício criado para demonstrar layouts modernos e funcionais com foco em economia.</p>
    <p>Nosso objetivo é entregar informações claras e confiáveis para nossos usuários.</p>
  </section>

  <section id="contato">
    <h2>Contato</h2>
    <p>Quer saber mais? Envie um e-mail para contato@portaleconomico.com (fictício).</p>
    <p>Ou siga nossas redes sociais para ficar por dentro das atualizações.</p>
  </section>
</main>

<footer>
  &copy; 2025 Portal Econômico | Projeto de demonstração
  <span>Este é um site para demonstração - <?php echo date('d/m/Y'); ?></span>
</footer>

<script>
  // Scroll suave para links da nav
  document.querySelectorAll('nav a').forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      const href = link.getAttribute('href');
      document.querySelector(href).scrollIntoView({behavior: 'smooth'});

      // Atualiza active
      document.querySelectorAll('nav a').forEach(a => a.classList.remove('active'));
      link.classList.add('active');

      // Fecha menu mobile se aberto
      if(window.innerWidth <= 768){
        navMenu.classList.remove('open');
      }
    });
  });

  // Animação seções ao aparecer usando IntersectionObserver
  const sections = document.querySelectorAll('main section');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if(entry.isIntersecting){
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.2 });

  sections.forEach(section => observer.observe(section));

  // Menu hamburguer toggle
  const hamburger = document.getElementById('hamburger');
  const navMenu = document.getElementById('nav-menu');

  hamburger.addEventListener('click', () => {
    navMenu.classList.toggle('open');
  });

  // Fecha menu ao clicar fora (mobile)
  document.addEventListener('click', e => {
    if(!navMenu.contains(e.target) && !hamburger.contains(e.target)){
      navMenu.classList.remove('open');
    }
  });
</script>

</body>
</html>
