<aside>
    <div class="sidebar">
        <div class="imgad">
            <a target="_blank" href="https://www.senacrs.com.br/home">
                <img class="imga" src="image/SenacAD.png" alt="Anuncio do senac" />
            </a>
        </div>

        <div class="imgad">
            <?php if (!empty($ads[0])): ?>
                <?php
                    $img1 = $ads[0]['foto'];
                    $img1src = (str_starts_with($img1, 'http://') || str_starts_with($img1, 'https://')) ? $img1 : "image/$img1";
                ?>
                <a href="noticia.php?noticiaID=<?php echo $ads[0]['noticiaID']; ?>" class="ad-link">
                    <img class="imga" src="<?php echo htmlspecialchars($img1src); ?>" alt="<?php echo htmlspecialchars($ads[0]['titulo']); ?>" />
                    <div class="ad-overlay">
                        <p class="ad-title"><?php echo htmlspecialchars($ads[0]['titulo']); ?></p>
                    </div>
                </a>
            <?php else: ?>
                <a target="_blank" href="">
                    <img class="imga" src="image/gago2.png" alt="Anúncio" />
                </a>
            <?php endif; ?>
        </div>

        <div class="imgad">
            <?php if (!empty($ads[1])): ?>
                <?php
                    $img2 = $ads[1]['foto'];
                    $img2src = (str_starts_with($img2, 'http://') || str_starts_with($img2, 'https://')) ? $img2 : "image/$img2";
                ?>
                <a href="noticia.php?noticiaID=<?php echo $ads[1]['noticiaID']; ?>" class="ad-link">
                    <img class="imga" src="<?php echo htmlspecialchars($img2src); ?>" alt="<?php echo htmlspecialchars($ads[1]['titulo']); ?>" />
                    <div class="ad-overlay">
                        <p class="ad-title"><?php echo htmlspecialchars($ads[1]['titulo']); ?></p>
                    </div>
                </a>
            <?php else: ?>
                <a target="_blank" href="https://www.senacrs.com.br/home">
                    <img class="imga" src="image/SenacAD.png" alt="Anúncio do senac" />
                </a>
            <?php endif; ?>
        </div>
    </div>
</aside>
</div>
