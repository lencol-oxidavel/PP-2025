<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/style2.css">
</head>
<body>

<div class="containerr">
    <div class="cadastro">
        <h2>cadastro</h2>
        <form class="cad-form" action="">
            <input type="hidden" name="">
            <label for="Nome">Nome: </label>
            <input type="text" name="Nome" required>
            <label for="Email">Email: </label>
            <input type="email" name="Email" required>
            <label for="Senha">Senha: </label>
            <input type="password" name="Senha" required>
            <label for="Conf">Confirmar senha:</label>
            <input type="password" name="Conf" required>
            <select name="">
                <option value="" selected disabled>Sexo</option>
                <option value="F">Feminino</option>
                <option value="M">Masculino</option>
            </select>
            <button class="button" type="submit"><span>Cadastrar</span></button>
        </form>
    </div>
        
    <div class="login">
        <form class="log-form" action=""></form>
    </div>
</div>
</body>
</html>