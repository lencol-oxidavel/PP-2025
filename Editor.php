<?php
session_start();
include 'Includes/_conexao.php';

// Verifica se o usuário está logado e se é jornalista
if (!isset($_SESSION['usuarioID'])) {
    die("Acesso negado. Faça login primeiro.");
}

// Verifica se o usuário é um jornalista
$usuarioID = $_SESSION['usuarioID'];
$stmt = $conn->prepare("SELECT jornalistaID FROM jornalistas WHERE usuarios_usuarioID = ?");
$stmt->bind_param("i", $usuarioID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Apenas jornalistas podem acessar esta página.");
}

$jornalista = $result->fetch_assoc();
$jornalistaID = $jornalista['jornalistaID'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editor de Notícias</title>
</head>
<body>
    <h1>Escreva uma nova notícia</h1>
    <form action="salvar_noticia.php" method="post">
        <input type="hidden" name="jornalistaID" value="<?php echo $jornalistaID; ?>">

        <label>Título:</label><br>
        <input type="text" name="titulo" required><br><br>

        <label>Texto:</label><br>
        <textarea name="texto" rows="8" cols="50" required></textarea><br><br>

        <label>Descrição:</label><br>
        <input type="text" name="descricao" required><br><br>

        <label>Foto (URL):</label><br>
        <input type="text" name="foto"><br><br>

        <input type="submit" value="Publicar">
    </form>
</body>
</html>