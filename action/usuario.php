<?php
session_start();
include_once '../includes/_conexao.php';

$mensagem = '';
$mensagem_tipo = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao'])) {
    $acao = $_POST['acao'];

    switch ($acao) {
        case 'cadastro':
            $nome = mysqli_real_escape_string($conn, $_POST['Nome']);
            $email = mysqli_real_escape_string($conn, $_POST['Email']);
            $senha = $_POST['Senha'];
            $conf = $_POST['Conf'];
            $sexo = mysqli_real_escape_string($conn, $_POST['Sexo']);
            $telefone = mysqli_real_escape_string($conn, $_POST['Telefone']);
            $jornalista = isset($_POST['CheckJ']) ? 1 : 0;

            if ($senha !== $conf) {
                $mensagem = "As senhas não coincidem.";
                $mensagem_tipo = 'cadastro';
                break;
            }

            $verifica = mysqli_query($conn, "SELECT usuarioID FROM usuarios WHERE email = '$email'");

            if (mysqli_num_rows($verifica) > 0) {
                $mensagem = "E-mail já cadastrado.";
                $mensagem_tipo = 'cadastro';
            } else {
                $sql = "INSERT INTO usuarios (nome, email, senha, sexo, telefone, jornalista)
                        VALUES ('$nome', '$email', '$senha', '$sexo', '$telefone', '$jornalista')";

                if (mysqli_query($conn, $sql)) {
                    $mensagem = "Cadastro realizado com sucesso.";
                    $mensagem_tipo = 'cadastro';
                } else {
                    $mensagem = "Erro ao cadastrar: " . mysqli_error($conn);
                    $mensagem_tipo = 'cadastro';
                }
            }
            break;

        case 'login':
            $email = mysqli_real_escape_string($conn, $_POST['Email']);
            $senha = $_POST['Senha'];

            $sql = "SELECT * FROM usuarios WHERE email = '$email'";
            $resultado = mysqli_query($conn, $sql);

            if (mysqli_num_rows($resultado) === 1) {
                $usuario = mysqli_fetch_assoc($resultado);

                if ($senha === $usuario['senha']) {
                    $_SESSION['usuarioID'] = $usuario['usuarioID'];
                    $_SESSION['nome'] = $usuario['nome'];
                    $_SESSION['jornalista'] = $usuario['jornalista'];

                    header("Location: ../index.php");
                    exit;
                } else {
                    $mensagem = "Senha incorreta.";
                    $mensagem_tipo = 'login';
                }
            } else {
                $mensagem = "Usuário não encontrado.";
                $mensagem_tipo = 'login';
            }
            break;
    }
}

$_SESSION['mensagem'] = $mensagem;
$_SESSION['mensagem_tipo'] = $mensagem_tipo;
header("Location: ../cadastrologin.php");
exit;
    