<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/stylelogin.css">
</head>
<body>

<a href="javascript:history.back()" class="voltar">&#10229; Voltar</a>

<div class="containerr">
    <div class="cadastro">
        <h2>Cadastro</h2>
        <form class="cad-form" action="" method="">

            <input type="hidden" name="" value="">

            <label for="CNome">Nome: </label>
            <input class="fradius input" type="text" name="Nome" placeholder="Nome" id="CNome" required>

            <label for="CEmail">Email: </label>
            <input class="fradius input" type="email" name="Email" placeholder="Email" id="CEmail" required>

            <label for="CSenha">Senha: </label>
            <input class="fradius input" type="password" name="Senha" placeholder="Senha" id="CSenha" required>

            <label for="CConf">Confirmar senha:</label>
            <input class="fradius input" type="password" name="Conf" placeholder="Confirmar Senha" id="CConf" required>

            <label for="Sexo">Sexo: </label>
            <select class="fradius select" name="Sexo" id="Sexo">
                <option value="" selected disabled>Sexo</option>
                <option value="F">Feminino</option>
                <option value="M">Masculino</option>
            </select>

            <label for="CTelefone">Telefone: </label>
            <input class="fradius input" type="tel" name="Telefone" pattern="[0-9]{00}[0-9]{2}-[0-9]{4-3}-[0-9]{2}-[0-9]{3}" placeholder="00 00 999999999" id="CTelefone" required>

            <span class="check">
                <input type="checkbox" name="CheckJ" id="CheckJ">
                <label for="CheckJ">Jornalista</label>
            </span>

            <button class="button" type="submit"><span>Cadastrar</span></button>
        </form>
    </div>
        
    <div class="login">
        <h2>Login</h2>
        <form class="log-form" action="" method="">
            <label for="LEmail">Email</label>
            <input class="fradius input" type="email" name="Email" placeholder="Email" id="LEmail" required>

            <label for="LSenha">Senha</label>
            <input class="fradius input" type="password" name="Senha" placeholder="Senha" id="LSenha" required>

            <button class="button" type="submit"><span>Login</span></button>
        </form>
    </div>
</div>
</body>
</html>