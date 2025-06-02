<?php
include '_conexao.php'
?>

<?php
$host = 'localhost';
$dbname = 'cerebromaquina'; 
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Dados simulados (poderia vir de um formulário $_POST)
    $nome = 'Vinny';
    $email = 'vinny@email.com';
    $senha = password_hash('senha123', PASSWORD_DEFAULT); 
    $sexo = 1; 
    $telefone = 11999999999;
    $jornalista = 0; 

    $sql = "INSERT INTO Usuarios (nome, email, senha, sexo, telefone, jornalista)
            VALUES (:nome, :email, :senha, :sexo, :telefone, :jornalista)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senha,
        ':sexo' => $sexo,
        ':telefone' => $telefone,
        ':jornalista' => $jornalista
    ]);

    echo " Usuário cadastrado com sucesso!";
} catch (PDOException $e) {
    echo " Erro: " . $e->getMessage();
}
?>