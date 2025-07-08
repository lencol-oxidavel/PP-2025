<?php
include_once '../includes/_conexao.php';

$busca = '';
if (isset($_GET['busca'])) {
    $busca = mysqli_real_escape_string($conn, $_GET['busca']);
}

$sql = "SELECT noticiaID, titulo, descricao, foto
        FROM Noticias
        WHERE titulo LIKE '%$busca%' OR descricao LIKE '%$busca%'
        ORDER BY data_liberacao DESC
        LIMIT 10";

$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Resultados da busca por "<?php echo htmlspecialchars($busca); ?>"</title>
    <link rel="stylesheet" href="../assets/style3.css" />
    <link rel="icon" type="image/x-icon" href="../image/imageb.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<body>

<a href="../index.php" class="voltar">&#10229; Voltar</a>

<h1>Resultados para "<?php echo htmlspecialchars($busca); ?>"</h1>

<div class="resultados">
<?php
if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($dado = mysqli_fetch_assoc($resultado)) {
?>
        <div class="Resultado">
            <div class="Resultado-img">
                <img src="../image/<?php echo htmlspecialchars($dado['foto']); ?>" alt="Imagem do resultado" />
            </div>
            <div class="Resultado-Texto">
                <h2><?php echo htmlspecialchars($dado['titulo']); ?></h2>
                <p><?php echo htmlspecialchars($dado['descricao']); ?></p>
            </div>
        </div>
<?php
    }
} else {
    echo '<p class="no-results">Nenhuma notícia encontrada para: ' . htmlspecialchars($busca) . '</p>';
}
?>
</div>

</body>
</html>
