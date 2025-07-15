<?php
include_once './includes/_header.php';
?>

<?php


$mensagem = '';
$mensagem_tipo = '';

if (isset($_SESSION['mensagem']) && isset($_SESSION['mensagem_tipo'])) {
    $mensagem = $_SESSION['mensagem'];
    $mensagem_tipo = $_SESSION['mensagem_tipo'];
    unset($_SESSION['mensagem'], $_SESSION['mensagem_tipo']);
}
?>

<main class="CLmain">
    <a href="javascript:history.back()" class="voltar">&#10229; Voltar</a>
    <div class="bodycl">
        

        <div class="containerr">
            <div class="cadastro">
                <h2 class="CLh2">Cadastro</h2>
                <form class="cad-form" action="action/usuario.php" method="POST">
                    <input type="hidden" name="acao" value="cadastro">

                    <label for="CNome">Nome: </label>
                    <input class="fradius input" type="text" name="Nome" placeholder="Nome" id="CNome" required>

                    <label for="CEmail">Email: </label>
                    <input class="fradius input" type="email" name="Email" placeholder="Email" id="CEmail" required>

                    <label for="CSenha">Senha: </label>
                    <input class="fradius input" type="password" name="Senha" placeholder="Senha" id="CSenha" required>

                    <label for="CConf">Confirmar senha:</label>
                    <input class="fradius input" type="password" name="Conf" placeholder="Confirmar Senha" id="CConf" required>

                    <label for="Sexo">Sexo: </label>
                    <select class="fradius select" name="Sexo" id="Sexo" required>
                        <option value="" selected disabled>Sexo</option>
                        <option value="F">Feminino</option>
                        <option value="M">Masculino</option>
                    </select>

                    <label for="CTelefone">Telefone: </label>
                    <input class="fradius input" type="tel" name="Telefone" placeholder="00 00 999999999" id="CTelefone" required>

                    <span class="check">
                        <input type="checkbox" name="CheckJ" id="CheckJ">
                        <label for="CheckJ">Jornalista</label>
                    </span>

                    <?php if ($mensagem && $mensagem_tipo === 'cadastro'): ?>
                        <p class="mensagem" style="color:red; margin-bottom:10px;"><?php echo htmlspecialchars($mensagem); ?></p>
                    <?php endif; ?>

                    <button class="button" type="submit"><span class="buttonspan">Cadastrar</span></button>
                </form>
            </div>
                
            <div class="logincad">
                <h2 class="CLh2">Login</h2>
                <form class="log-form" action="action/usuario.php" method="POST">
                    <input type="hidden" name="acao" value="login">

                    <label for="LEmail">Email</label>
                    <input class="fradius input" type="email" name="Email" placeholder="Email" id="LEmail" required>

                    <label for="LSenha">Senha</label>
                    <input class="fradius input" type="password" name="Senha" placeholder="Senha" id="LSenha" required>

                    <?php if ($mensagem && $mensagem_tipo === 'login'): ?>
                        <p class="mensagem" style="color:red; margin-bottom:10px;"><?php echo htmlspecialchars($mensagem); ?></p>
                    <?php endif; ?>

                    <button class="button" type="submit"><span>Login</span></button>
                </form>
            </div>
        </div> 
    </div>
</main>
<?php
include_once './includes/_footer.php';
?>
