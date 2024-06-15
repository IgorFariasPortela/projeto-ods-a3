document.addEventListener("DOMContentLoaded", function() {
// barra de categorias===============================
const categoryIcon = document.getElementById('category-icon');
const categoryMenu = document.getElementById('category-menu');
const closeButton = document.getElementById('back-button');

categoryIcon.addEventListener('click', () => {
  categoryMenu.classList.toggle('open');
});

closeButton.addEventListener('click', () => {
  categoryMenu.classList.remove('open');
});

window.addEventListener('click', (e) => {
  if (!categoryMenu.contains(e.target) && !categoryIcon.contains(e.target)) {
    categoryMenu.classList.remove('open');
  }
});
});