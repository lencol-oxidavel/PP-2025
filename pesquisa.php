<?php
include_once './includes/_header.php';
?>


<?php

$busca = '';
$where = "";

if (isset($_GET['busca']) && trim($_GET['busca']) !== '') {
    $busca = mysqli_real_escape_string($conn, $_GET['busca']);
    $where = " WHERE titulo LIKE '%$busca%' OR descricao LIKE '%$busca%' ";
}

// Paginação
$por_pagina = 10;
$pagina_atual = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $por_pagina;

// Contar total de resultados
$total_query = "SELECT COUNT(*) as total FROM noticias $where";
$total_result = mysqli_query($conn, $total_query);

if (!$total_result) {
    die("Erro na consulta: " . mysqli_error($conn));
}

$total_row = mysqli_fetch_assoc($total_result);
$total = $total_row['total'];
$total_paginas = ceil($total / $por_pagina);

// Buscar resultados da página atual
$sql = "SELECT noticiaID, titulo, descricao, foto
        FROM noticias
        $where
        ORDER BY data_criacao DESC
        LIMIT $por_pagina OFFSET $offset";

$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    die("Erro na consulta: " . mysqli_error($conn));
}
?>

<main>
    <a href="index.php" class="voltar">&#10229; Voltar</a>
    <div class="mainsearch">
    

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
                <?php if (!empty($dado['foto'])): ?>
                <div class="Resultado-img">
                    <?php
                        $foto = $dado['foto'];
                        $fotoURL = (filter_var($foto, FILTER_VALIDATE_URL)) ? $foto : './image/' . $foto;
                    ?>
                    <img src="<?php echo htmlspecialchars($fotoURL); ?>" alt="<?php echo htmlspecialchars($noticia['titulo']); ?>">
                </div>
                <?php endif; ?>
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

    <?php if ($total_paginas > 1): ?>
        <div class="paginacao">
            <?php
            $max_paginas_exibir = 10;

            if ($total_paginas <= $max_paginas_exibir) {
                $inicio = 1;
                $fim = $total_paginas;
            } else {
                if ($pagina_atual < 6) {
                    $inicio = 1;
                    $fim = $max_paginas_exibir;
                } else {
                    $inicio = $pagina_atual - 4;
                    $fim = $pagina_atual + 5;

                    if ($fim > $total_paginas) {
                        $fim = $total_paginas;
                        $inicio = $fim - ($max_paginas_exibir - 1);
                        if ($inicio < 1) {
                            $inicio = 1;
                        }
                    }
                }
            }

            for ($i = $inicio; $i <= $fim; $i++):
            ?>
                <a class="pagina-link <?php echo $i === $pagina_atual ? 'ativa' : ''; ?>" href="?busca=<?php echo urlencode($busca); ?>&pagina=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
    <div>

</main>
<?php
include_once './includes/_footer.php';
?>