<?php
include_once './includes/_conexao.php';

$busca = '';
$where = "";
if (isset($_GET['busca']) && trim($_GET['busca']) !== '') {
    $busca = mysqli_real_escape_string($conn, $_GET['busca']);
    $where = " WHERE titulo LIKE '%$busca%' OR descricao LIKE '%$busca%' ";
}

// Se não pesquisou, traz as 10 notícias mais recentes, se pesquisou traz os resultados da busca
$sql = "SELECT noticiaID, titulo, descricao, foto
        FROM Noticias
        $where
        ORDER BY data_liberacao DESC
        LIMIT 10";

$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Neuralink - Notícias</title>
    <link rel="stylesheet" href="./assets/style3.css" />
    <link rel="icon" type="image/x-icon" href="image/imageb.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<body>

<a href="index.php" class="voltar">&#10229; Voltar</a>

<!-- Formulário de busca usando GET -->
<form class="search-form" method="GET" action="">
    <div class="search">
        <span class="search-icon material-symbols-outlined">search</span>
        <input 
            class="search-input" 
            type="search" 
            name="busca" 
            placeholder="Pesquisar" 
            value="<?php echo htmlspecialchars($busca); ?>"
            autocomplete="off"
        >
    </div>
</form>

<?php
if (mysqli_num_rows($resultado) > 0) {
    while ($dado = mysqli_fetch_assoc($resultado)) {
        $id = $dado['noticiaID'];
        $titulo = htmlspecialchars($dado['titulo']);
        $descricao = htmlspecialchars($dado['descricao']);
        $foto = htmlspecialchars($dado['foto']);
?>
        <a href="noticia.php?noticiaID=<?php echo $id; ?>" class="Resultado">
            <div class="Resultado-img">
                <img src="./image/<?php echo $foto; ?>" alt="Imagem do resultado" />
            </div>
            <div class="Resultado-Texto">
                <h2><?php echo $titulo; ?></h2>
                <p><?php echo $descricao; ?></p>
            </div>
        </a>
<?php
    }
} else {
    if ($busca !== '') {
        echo '<p class="no-results">Nenhuma notícia encontrada para: ' . htmlspecialchars($busca) . '</p>';
    } else {
        echo '<p class="no-results">Nenhuma notícia disponível no momento.</p>';
    }
}
?>

</body>
</html>
