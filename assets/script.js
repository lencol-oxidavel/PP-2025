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

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".editor-form");
    const button = document.querySelector("#buttonedit");

    function validarFormulario() {
        const camposObrigatorios = form.querySelectorAll("[required]");
        let valido = true;

        camposObrigatorios.forEach(campo => {
            if (!campo.value.trim() || !campo.checkValidity()) {
                valido = false;
            }
        });

        if (valido) {
            button.classList.remove("invalido");
            button.classList.add("valido");
            button.disabled = false;
        } else {
            button.classList.remove("valido");
            button.classList.add("invalido");
            button.disabled = true;
        }
    }

    form.addEventListener("input", validarFormulario);
    validarFormulario();
});
