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

    <!-- Botões para alternar entre seções -->
    <div class="resultadosALTERNAR">
        <button id="btn-pesquisa" class="botao-alternar ativo">Pesquisa</button>
        <button id="btn-neuralink" class="botao-alternar">Neuralink Oficial</button>
    </div>

    <div class="mainsearch">

        <!-- Seção de Pesquisa -->
        <div id="secao-pesquisa">
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
                            <img src="<?php echo htmlspecialchars($fotoURL); ?>" alt="<?php echo htmlspecialchars($titulo); ?>">
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
        </div>

        <!-- Seção Neuralink Oficial -->
        <div id="secao-neuralink" style="display: none;">
            <a href="https://www.sciencefocus.com/future-technology/everything-you-need-to-know-about-neuralink" target="_blank"class="Resultado">
                <div class="Resultado-img">
                    <img src="./image/image1.0.png" alt="Implante Neuralink">
                </div>
                <div class="Resultado-Texto">
                    <h2>Everything you need to know about Neuralink</h2>
                    <p>What are the ethics behind monitoring someone’s every thought, deed and emotion?</p>
                </div>
            </a>

            <a href="https://www.lifewire.com/what-is-neuralink-8631427" target="_blank" class="Resultado">
                <div class="Resultado-img">
                    <img src="./image/image2.0.png" alt="Controle com pensamento">
                </div>
                <div class="Resultado-Texto">
                    <h2>What Is Neuralink?</h2>
                    <p>This company hopes to build tech to let us talk to machines with our brains</p>
                </div>
            </a>

            <a href="https://www.mountbonnell.info/neural-nexus/mind-bending-tech-neuralinks-brain-threads-turn-thoughts-into-digital-commands#google_vignette" target="_blank" class="Resultado">
                <div class="Resultado-img">
                    <img src="./image/neuralink3.jpg" alt="Elon Musk Neuralink">
                </div>
                <div class="Resultado-Texto">
                    <h2>Mind-Bending Tech: Neuralink's Brain Threads Turn Thoughts into Digital Commands!</h2>
                    <p>Neuralink, Elon Musk's ambitious neurotechnology venture, aims to revolutionize the way humans interact with computers. The company has developed a brain-computer interface that allows direct communication between the human brain and external devices. Neuralink's system works by implanting tiny electrodes into the brain to detect and transmit neural signals, enabling users to control computers and other devices with their thoughts.</p>
                </div>
            </a>
        </div>
    </div>
</main>

<?php
include_once './includes/_footer.php';
?>
