<!DOCTYPE html>
<html lang="pt-BR">
<?php
session_start();

if(isset($_SESSION['email']) && isset($_SESSION['nome'])) {
  $email_usuario = $_SESSION['email'];
  $nome_usuario = $_SESSION['nome'];
} else {
  // Caso não esteja logado, redirecione para a página de login
  header('Location: login.html');
  exit(); // Encerra o script após redirecionar
}
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../imgs/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="../styles/global.css" />
  <link rel="stylesheet" href="../styles/component-navegacao/component-navegacao.css">
  <link rel="stylesheet" href="../styles/home-contratado/home-contratado.css" />
  <title>Krow</title>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // cards de serviços
      document.querySelectorAll(".card").forEach((box) => {
        box.addEventListener("click", function(e) {
          if (!e.target.classList.contains('interest-btn')) {
            this.classList.toggle("active");
          }
        });
      });

      document.querySelectorAll('.interest-btn').forEach((btn) => {
        btn.addEventListener('click', function(e) {
          e.stopPropagation();
          document.getElementById('confirmationModal').style.display = 'block';
        });
      });

      document.getElementById('confirmYes').addEventListener('click', function() {
        document.getElementById('confirmationModal').style.display = 'none';
        alert('Ação confirmada!');
      });

      document.getElementById('confirmNo').addEventListener('click', function() {
        document.getElementById('confirmationModal').style.display = 'none';
      });
    });
  </script>
</head>

<body>
  <header>
    <img src="../imgs/Krow-index-logo.png" alt="Krow logo" />
    <div class="perfil-usuario">
      <img src="../imgs/icon-user.png" alt="" />
      <p><?php echo $email_usuario; ?></p>
    </div>
  </header>

  <div id="content-home-contratado">
    <!-- BARRA LATERAL ESQUERDA DE ICONES -->
    <nav class="activity-bar">
      <div class="activity-icons">
        <a id="category-icon" href="javascript:void(0);"><img src="../imgs/svg/icon-category.svg" alt="Icone de categorias"></a>
        <a href="../pages/home-contratado.php"><img src="../imgs/svg/work-bag.svg" alt="Icone de Prestador de serviço"></a>
        <a href="../pages/home-contratante.php"><img src="../imgs/svg/work-contract.svg" alt="Icone de Contratante de serviço"></a>
        <a href="../pages/perfil.php"><img src="../imgs/svg/icon-profile.svg" alt="Icone de perfil"></a>
      </div>

      <form method="POST" action="../src/backend/loginpaginaanterior.php">
        <input type="hidden" name="redirect" value="<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">
        <button class="Btn" type="submit" name="sair">
          <div class="sign">
            <svg viewBox="0 0 512 512">
              <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
            </svg>
          </div>
          <div class="text">Desconectar</div>
        </button>
      </form>
    </nav>

    <!-- barra lateral de categorias -->
    <nav id="category-menu" class="category-menu">
      <button id="back-button" class="back-button"><img src="../imgs/svg/back.svg" alt="Voltar"></button>
      <h3>Categorias</h3>
      <ul>
        <li><a href="#">Todos</a></li>
        <li><a href="#">Musical</a></li>
        <li><a href="#">Desenho</a></li>
        <li><a href="#">Edição de Vídeo</a></li>
        <li><a href="#">Edição de Foto</a></li>
        <li><a href="#">Dublagem</a></li>
        <li><a href="#">Cozinheiro</a></li>
        <li><a href="#">Garçom</a></li>
        <li><a href="#">Barista</a></li>
        <li><a href="#">Doméstico</a></li>
        <li><a href="#">Babá</a></li>
        <li><a href="#">Motorista</a></li>
        <li><a href="#">Entregador</a></li>
        <li><a href="#">Acompanhante</a></li>
        <li><a href="#">Atuação</a></li>
        <li><a href="#">Didático</a></li>
        <li><a href="#">Outros</a></li>
      </ul>
    </nav>

    <main>
      <div class="main-header">
        <!-- BARRA DE PESQUISA -->
        <div class="group">
          <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
            <g>
              <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
            </g>
          </svg>
          <input class="input" type="search" id="search" placeholder="Search" onkeyup="searchServices()" />
        </div>
      </div>
      <div id="search-results"></div>

      <div class="main-body">
        <!-- CARD PRINCIPAL DE EXEMPLO -->
        <main>
          <div class="main-header">
            <h1>Lista de Serviços</h1>
          </div>
          <div class="main-body">
            <?php include('../src/backend/mostrar_servicos.php'); ?>
          </div>
        </main>
        <!-- Continue adicionando outros cards conforme necessário -->


        <!-- Modal de Confirmação -->
        <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <p>Tem certeza que deseja completar essa ação?</p>
            <button id="confirmYes">Sim</button>
            <button id="confirmNo">Não</button>
        </div>
    </div>
        <script src="../src/frontend/category-bar.js"></script>
        <script src="../src/frontend/search-bar.js"></script>
        <script src="../src/frontend/interesse.js"></script>
</body>
</html>