<?php

session_start();
require_once 'Connexion.php';
require 'total.php';
total();

//Connexion a la Base (pour avoir l'id de l'article)
if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $res = $cnx->query("select * from article where id_article=$id");
    $article = $res->fetch(PDO::FETCH_ASSOC);

    // l'ajout au panier (si on click sur le bouton ADD TO CART)
    if (isset($_POST['add_to_cart'])) {
        $lib = $article['libelle'];
        //Verification si le produit est deja ajouté ou non
        if (isset($_SESSION['article'][$lib])) {
            $_SESSION['article'][$lib] += 1;
        } else {
            $_SESSION['article'][$lib] = 1;
        }
    }
}

if (!isset($_SESSION['id_admin'])){
    header("location:d.php");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body class="bg-secondary">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img src="images/Logo.png" width="160" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="panier.php">Panier</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Login</a>
                </li>

            </ul>


        </div>
    </nav>

    <div class="container py-3">
        <div class="row  align-items-center">
            <div class="col-md-12">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Rechercher</div>
                    <div class="card-body">
                        <h4 class="card-title">Afficher tous les produits</h4>
                        <a href="find_all.php" class="btn btn-secondary" role="button">Afficher</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Ajouter</div>
                    <div class="card-body">
                        <h4 class="card-title">Ajouter un nouveau admin</h4>
                        <a href="AjouterAdmin.php" class="btn btn-secondary" role="button">Afficher</a>
                    </div>
                </div>
            </div>

        </div>
    </div>


</body>


</html>

