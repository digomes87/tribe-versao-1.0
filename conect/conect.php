<?php
//Configure os dados para conexão com o banco
$servidor_mysql = "localhost";
$nome_banco = "tribe";
$usuario ="root";
$senha = "";

//Não altere o código abaixo
$conn = new PDO("mysql:host=$servidor_mysql;dbname=$nome_banco","$usuario","$senha");