<?php
session_start();
include_once '../includes/_conexao.php';

if (!isset($_SESSION['usuarioID'])) {
    die('Você precisa estar logado.');
}

$usuarioID = $_SESSION['usuarioID'];

$titulo = trim($_POST['titulo']);
$descricao = trim($_POST['descricao']);
$texto = trim($_POST['texto']);
$foto = trim($_POST['foto']);
$data_criacao = $_POST['data_criacao'] ?: date('Y-m-d H:i:s');

if (empty($titulo) || empty($descricao) || empty($texto) || empty($foto)) {
    die('Todos os campos devem ser preenchidos.');
}

$stmt = $conn->prepare("INSERT INTO noticias (titulo, descricao, texto, foto, usuarioID, data_criacao) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssis", $titulo, $descricao, $texto, $foto, $usuarioID, $data_criacao);

if ($stmt->execute()) {
    header('Location: ../index.php');
    exit;
} else {
    echo "Erro ao salvar notícia: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
