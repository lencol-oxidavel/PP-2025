<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/stylelogin.css">
</head>
<body>

<div class="containerr">
    <div class="cadastro">
        <h2>Cadastro</h2>
        <form class="cad-form" action="" method="">
            <input type="hidden" name="">
            <label for="Nome">Nome: </label>
            <input class="fradius input" type="text" name="Nome" placeholder="Nome" required>
            <label for="Email">Email: </label>
            <input class="fradius input" type="email" name="Email" placeholder="Email" required>
            <label for="Senha">Senha: </label>
            <input class="fradius input" type="password" name="Senha" placeholder="Senha" required>
            <label for="Conf">Confirmar senha:</label>
            <input class="fradius input" type="password" name="Conf" placeholder="Confirmar Senha" required>
            <label for="Sexo">Sexo: </label>
            <select class="fradius select" name="Sexo">
                <option value="" selected disabled>Sexo</option>
                <option value="F">Feminino</option>
                <option value="M">Masculino</option>
            </select>
            <label for="Telefone">Telefone: </label>
            <input class="fradius input" type="tel" name="Telefone" pattern="[0-9]{00}[0-9]{2}-[0-9]{4-3}-[0-9]{2}-[0-9]{3}" placeholder="00 00 999999999" required>
            <div class="check">
                <label for="CheckJ">Jornalista</label>
                <input type="checkbox" name="CheckJ" id="">
            </div>
            <button class="button" type="submit"><span>Cadastrar</span></button>
        </form>
    </div>
        
    <div class="login">
        <h2>Login</h2>
        <form class="log-form" action="" method="">
            <label for="Email">Email</label>
            <input class="fradius input" type="email" name="Email" placeholder="Email" required>
            <label for="Senha">Senha</label>
            <input class="fradius input" type="password" name="Senha" placeholder="Senha" required>
            <button class="button" type="submit"><span>Login</span></button>


        </form>
    </div>
</div>
</body>
</html>