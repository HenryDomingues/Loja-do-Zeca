<?php
try{
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=loja-do-zeca','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $now = date('Y-m-d H:i:s');
    $pdo->exec("INSERT INTO categorias (nome, created_at, updated_at) VALUES ('Tinta', '$now', '$now')");
    echo "Inserted OK\n";
}catch(Exception $e){
    echo 'ERR: '.$e->getMessage()."\n";
}
