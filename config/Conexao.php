<?php
// Conectar ao banco de dados
$host = 'localhost'; 
$db = 'cadastro_eventos'; 
$user = 'root'; 
$pass = 'Ma020204*'; 

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}