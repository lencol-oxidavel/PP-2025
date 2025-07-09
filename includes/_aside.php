<aside>
    <div class="sidebar">
        <div class="imgad">
            <a target="_blank" href="https://www.senacrs.com.br/home">
                <img class="imga" src="image/SenacAD.png" alt="Anuncio do senac" />
            </a>
        </div>

        <div class="imgad">
            <?php if (!empty($ads[0])): ?>
                <a href="noticia.php?noticiaID=<?php echo $ads[0]['noticiaID']; ?>">
                    <img class="imga" src="image/<?php echo htmlspecialchars($ads[0]['foto']); ?>" alt="<?php echo htmlspecialchars($ads[0]['titulo']); ?>" />
                </a>
            <?php else: ?>
                <a target="_blank" href="">
                    <img class="imga" src="image/gago2.png" alt="Anuncio do senac" />
                </a>
            <?php endif; ?>
        </div>

        <div class="imgad">
            <?php if (!empty($ads[1])): ?>
                <a href="noticia.php?noticiaID=<?php echo $ads[1]['noticiaID']; ?>">
                    <img class="imga" src="image/<?php echo htmlspecialchars($ads[1]['foto']); ?>" alt="<?php echo htmlspecialchars($ads[1]['titulo']); ?>" />
                </a>
            <?php else: ?>
                <a target="_blank" href="https://www.senacrs.com.br/home">
                    <img class="imga" src="image/SenacAD.png" alt="Anuncio do senac" />
                </a>
            <?php endif; ?>
        </div>
    </div>
</aside>
</div>
