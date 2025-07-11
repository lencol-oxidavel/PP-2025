document.addEventListener('DOMContentLoaded', () => {
  const logoutLink = document.getElementById('logoutLink');

  if (logoutLink) {
    logoutLink.addEventListener('click', (e) => {
      e.preventDefault();

      if (confirm('Deseja realmente fazer logout?')) {
        window.location.href = './action/logout.php';
      }
    });
  }
});



function atualizarImagem() {
            const urlInput = document.getElementById('url-imagem');
            const imagem = document.getElementById('preview-imagem');

            const novaURL = urlInput.value.trim();

            if (novaURL !== '') {
                imagem.src = novaURL;
            }
        };