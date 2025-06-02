<?php
$host = 'localhost';       
$dbname = 'cerebromaquina';          
$user = 'root';           
$pass = '';                

try {
    
    $pdo = new PDO("mysql:host=$host;charset=utf8", $user, $pass);
    
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo " Conexão bem-sucedida ao banco 'cerebromaquina'!";
} catch (PDOException $e) {
    echo " Erro na conexão: " . $e->getMessage();
}
?>