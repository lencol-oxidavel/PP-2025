<?php
include_once './includes/_header.php';
include_once './includes/_conexao.php';

// Verifica se veio um ID válido
if (!isset($_GET['noticiaID']) || !is_numeric($_GET['noticiaID'])) {
    echo "<p class='no-results'>Notícia inválida.</p>";
    include_once './includes/_aside.php';
    include_once './includes/_footer.php';
    exit;
}

$noticiaID = (int) $_GET['noticiaID'];

// Busca a notícia no banco de dados
$sql = "SELECT titulo, descricao, texto, foto, data_liberacao FROM Noticias WHERE noticiaID = $noticiaID LIMIT 1";
$resultado = mysqli_query($conn, $sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    echo "<p class='no-results'>Notícia não encontrada.</p>";
    include_once './includes/_aside.php';
    include_once './includes/_footer.php';
    exit;
}

$noticia = mysqli_fetch_assoc($resultado);
?>

<div class="maincontainer">
    <main>
        <article class="noticia-completa">
            <h1><?php echo htmlspecialchars($noticia['titulo']); ?></h1>
            <p class="data">
                Publicado em <?php echo date('d/m/Y H:i', strtotime($noticia['data_liberacao'])); ?>
            </p>

            <div class="imagem-noticia">
                <img src="./image/<?php echo htmlspecialchars($noticia['foto']); ?>" alt="<?php echo htmlspecialchars($noticia['titulo']); ?>">
            </div>

            <p class="descricao">
                <?php echo nl2br(htmlspecialchars($noticia['descricao'])); ?>
            </p>

            <div class="texto-completo">
                <?php echo nl2br(htmlspecialchars($noticia['texto'])); ?>
            </div>
        </article>
    </main>

<?php
include_once './includes/_aside.php';
include_once './includes/_footer.php';
?>
