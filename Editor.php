<?php
include_once './includes/_conexao.php';
?>
<?php
include_once './includes/_header.php';
?>

<?php

// Verifica se o usuário está logado
if (!isset($_SESSION['usuarioID'])) {
    echo "
    <main class='acesso-negado'>
        <p class='p-negado'>Acesso negado. Faça login primeiro.</p>
    </main>
    ";
    include_once './includes/_footer.php';
    exit;
}

// Verifica se o usuário é jornalista
$usuarioID = $_SESSION['usuarioID'];

$stmt = $conn->prepare("SELECT jornalista FROM usuarios WHERE usuarioID = ? LIMIT 1");
$stmt->bind_param("i", $usuarioID);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "<p style='color: red; text-align: center;'>Usuário não encontrado.</p>";
    include_once './includes/_footer.php';
    exit;
}

$dadosUsuario = $resultado->fetch_assoc();

if ((int)$dadosUsuario['jornalista'] !== 1) {
    echo "<p style='color: red; text-align: center;'>Acesso restrito a jornalistas.</p>";
    include_once './includes/_footer.php';
    exit;
}

$stmt->close();
?>

    <div class="maincontainer">
        <main class="mainhome">
            <form method="post" action="./action/salvar_noticia.php" class="editor-form">
                <article class="noticia-completa">
                    <h1 class="hmainhome">
                        <input type="text" id="titulo" name="titulo" placeholder="Título da notícia" required>
                    </h1>

                    <input type="datetime-local" id="data_criacao" name="data_criacao" hidden>

                    <div class="imagem-noticia">
                        <img id="preview-imagem" src="https://img.freepik.com/fotos-premium/desenho-de-fundo-abstrato-hd-cor-verde-oliveira_851755-74064.jpg" alt="Imagem da notícia">
                    </div>

                    <p>Atenção: copie o endereço da imagem, não o do link</p>
                    <input type="url" id="url-imagem" name="foto" placeholder="Insira a URL da imagem" oninput="atualizarImagem()" required>

                    <p class="descricao">
                        <textarea id="descricao" name="descricao" placeholder="Descrição curta da notícia" rows="4" required></textarea>
                    </p>

                    <div class="texto-completo">
                        <textarea id="texto" name="texto" placeholder="Texto completo da notícia" rows="10" required></textarea>
                    </div>

                    <br>
                    <button id="buttonedit" type="submit">Salvar Notícia</button>
                </article>
            </form>
        </main>


<?php
include_once './includes/_aside.php';
include_once './includes/_footer.php';
?>
