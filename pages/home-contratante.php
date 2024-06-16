<!DOCTYPE html>
<html lang="pt-BR">
<?php
session_start();

if(isset($_SESSION['email'])) {
  $email_usuario = $_SESSION['email'];
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
    <link rel="stylesheet" href="../styles/home-contratante/home-contratante.css"/>
    <title>Krow</title>
  </head>
  <body>
    <header>
      <img src="../imgs/Krow-index-logo.png" alt="Krow logo" />
      <div class="perfil-usuario">
        <img src="../imgs/icon-user.png" alt="" />
        <p><?php  echo $email_usuario; ?></p>
    </div>
    </header>

    <div id="content-home-contratado">
      <!-- barra lateral de ICONES -->
      <nav class="activity-bar">
        <div class="activity-icons">
          <a id="category-icon" href="javascript:void(0);"><img src="../imgs/svg/icon-category.svg" alt="Icone de categorias"></a>
          <a href="../pages/home-contratado.php"><img src="../imgs/svg/work-bag.svg" alt="Icone de Prestador de serviço"></a>
          <a href="../pages/home-contratante.php"><img src="../imgs/svg/work-contract.svg" alt="Icone de Contratante de serviço"></a>
          <a href="perfil.html"><img src="../imgs/svg/icon-profile.svg" alt="Icone de perfil"></a>
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
      
      <!-- barra lateral de CATEGORIAS -->
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

      <div class="service_creation" id="serviceCreation">
  <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
    <g id="SVGRepo_iconCarrier">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12ZM12.5 5.5C13.0523 5.5 13.5 5.94772 13.5 6.5V10.5H17.5C18.0523 10.5 18.5 10.9477 18.5 11.5V12.5C18.5 13.0523 18.0523 13.5 17.5 13.5H13.5V17.5C13.5 18.0523 13.0523 18.5 12.5 18.5H11.5C10.9477 18.5 10.5 18.0523 10.5 17.5V13.5H6.5C5.94772 13.5 5.5 13.0523 5.5 12.5V11.5C5.5 10.9477 5.94772 10.5 6.5 10.5H10.5V6.5C10.5 5.94772 10.9477 5.5 11.5 5.5H12.5Z" fill="#ffffff"></path>
    </g>
  </svg>
</div>

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form action="../src/backend/criar_servico.php" method="post">
      <img src="../imgs/text-krow.png" alt="" />

      <div class="form">
        <input class="input" id="nome_servico" name="nome_servico" placeholder="Nome do Estabelecimento/Contratante" required="" type="text" />
        <span class="input-border"></span>
      </div>

      <div class="form">
        <input class="input" id="sobre_servico" name="sobre_servico" placeholder="Fale um pouco sobre o seu negócio" required="" type="text" />
        <span class="input-border"></span>
      </div>

      <label for="data_servico">Data:</label>
      <input type="date" id="data_servico" name="data_servico" required />

      <input class="login-button" type="submit" value="Criar Serviço" />
    </form>
  </div>
</div>



<main>
  <div class="main-header">
    <h1>Lista de Serviços</h1>
  </div>
  <div class="main-body">
    <?php include('../src/backend/mostrar_servicoID.php'); ?>
  </div>
</main>
    </main>
    <script>
      document.addEventListener("DOMContentLoaded", (event) => {
        const serviceCreation = document.getElementById("serviceCreation");
        const modal = document.getElementById("myModal");
        const modalContent = document.querySelector(".modal-content");
        const closeBtn = document.querySelector(".close");

        serviceCreation.addEventListener("click", openModal);
        closeBtn.addEventListener("click", closeModal);

        function openModal() {
          modal.style.display = "flex";
          setTimeout(() => {
            modal.classList.add("show");
            modalContent.classList.add("show");
          }, 10); // Adiciona um pequeno delay para garantir a transição
        }

        function closeModal() {
          modal.classList.remove("show");
          modalContent.classList.remove("show");
          setTimeout(() => {
            modal.style.display = "none";
          }, 500); // Tempo da transição (0.5s)
        }

        window.onclick = function (event) {
          if (event.target == modal) {
            closeModal();
          }
        };
      });
      ``;
    </script>
  </body>
</html>
