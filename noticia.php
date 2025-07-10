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

// Usando prepared statements para evitar SQL Injection
$stmt = $conn->prepare("SELECT titulo, descricao, texto, foto, data_criacao FROM noticias WHERE noticiaID = ? LIMIT 1");
$stmt->bind_param("i", $noticiaID);
$stmt->execute();
$resultado = $stmt->get_result();

if (!$resultado || $resultado->num_rows === 0) {
    echo "<p class='no-results'>Notícia não encontrada.</p>";
    include_once './includes/_aside.php';
    include_once './includes/_footer.php';
    exit;
}

$noticia = $resultado->fetch_assoc();

$stmt->close();
?>

<div class="maincontainer">
    <main>
        <article class="noticia-completa">
            <h1><?php echo htmlspecialchars($noticia['titulo']); ?></h1>
            <p class="data">
                Publicado em <?php echo date('d/m/Y H:i', strtotime($noticia['data_criacao'])); ?>
            </p>

            <?php if (!empty($noticia['foto'])): ?>
            <div class="imagem-noticia">
                <?php
                    $foto = $noticia['foto'];
                    $fotoURL = (filter_var($foto, FILTER_VALIDATE_URL)) ? $foto : './image/' . $foto;
                ?>
                <img src="<?php echo htmlspecialchars($fotoURL); ?>" alt="<?php echo htmlspecialchars($noticia['titulo']); ?>">
            </div>
            <?php endif; ?>

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
