<?php
session_start();
include_once './includes/_conexao.php';

// Buscar 2 notícias mais recentes para colocar no asiede
$ads = [];
$sql = "SELECT noticiaID, titulo, foto FROM noticias ORDER BY data_criacao DESC LIMIT 2";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ads[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Neuralink</title>
    <link rel="icon" type="image/x-icon" href="image/imageb.png" />
    <link rel="stylesheet" href="./assets/style.css" />
    <link rel="stylesheet" href="./assets/style3.css">
    <link rel="stylesheet" href="./assets/stylelogin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
</head>
<body>

<div class="container">
    <header>
        <div class="flexh">

            <div class="logo">
                <img src="image/imageb.png" alt="logo" />
            </div>

            <nav class="dclash">
                <a class="clash" href="./index.php"><span>Home</span></a>
                <a class="clash" href="./produto.php"><span>Produto</span></a>
                <a class="clash" href="./aplicacoes.php"><span>Aplicações</span></a>
                <a class="clash" href="./metodologia.php"><span>Metodologia</span></a>
                <a class="clash" href="./sobrenos.php"><span>Sobre Nós</span></a>
                <a class="clash pesq" href="./pesquisa.php">
                    <span class="spanpesq">
                        <img class="Solucao_da_crise_existencial_da_lupa" src="./image/Lupa_branca_maior.png" alt="" />
                        <p class="ppesq">Pesquisar</p>
                    </span>
                </a>
                <?php if (isset($_SESSION['usuarioID']) && isset($_SESSION['jornalista']) && $_SESSION['jornalista'] == 1): ?>
                    <a class="clash" href="./editor.php"><span>Escrever</span></a>
                <?php endif; ?>
            </nav>

            <div class="login">
                <?php if (isset($_SESSION['usuarioID'])): ?>
                    <span class="logincontainer">
                        <img src="./image/PersonB.png" alt="Usuário" />
                        <p class="plogin">Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?></p>
                        <a href="./action/logout.php" id="logoutLink" style="margin-left:10px; color:#f00; cursor:pointer;">Logout</a>
                    </span>
                <?php else: ?>
                    <a class="logincontainer" href="./cadastrologin.php">
                        <img src="./image/PersonB.png" alt="Login" />
                        <p class="plogin">Registrar ou fazer Login</p>
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </header>
