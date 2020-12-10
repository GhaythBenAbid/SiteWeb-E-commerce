<?php
try {
    $dns="mysql:host=localhost;dbname=ecommerceprojetphp";
    $user="root";
    $pw="";
    $cnx=new PDO($dns,$user,$pw); // $cnx est un objet PDO
    $cnx->exec("SET CHARACTER SET utf8 ");
} catch(Exception $e)
 {
    echo "Problème de connexion!!!".$e->getMessage();
 }