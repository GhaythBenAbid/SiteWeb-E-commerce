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
            <ul>
                <li class="nav-item">
                    <a class="nav-link" href="panier.php">
                        <i class="fa fa-shopping-cart" style="font-size: 27px;"></i>
                        <span class='badge badge-warning' id='lblCartCount'> <?php echo $_SESSION['total']; ?> </span>
                        <span class="total text-warning"> <?php echo sommeTotal($cnx); ?> DT </span>
                    </a>
                </li>
            </ul>

        </div>
    </nav>



    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="categories.php?id=1">
                    <img src="images/banner.png" class="d-block w-100" alt="...">
                </a>
            </div>
            <div class="carousel-item">
                <a href="categories.php?id=3">
                    <img src="images/banner2.png" class="d-block w-100" alt="...">
                </a>
            </div>
            <div class="carousel-item">
                <a href="categories.php?id=4">
                    <img src="images/banner3.png" class="d-block w-100" alt="...">
                </a>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>



    <div class="container">


        <div class="row mr-auto text-center my-5">

            <?php

            require_once 'Connexion.php';

            $res = $cnx->query("select * from article order by prix");
            $article = $res->fetchall(PDO::FETCH_ASSOC);


            foreach ($article as $value) {
                echo "
                <div class='col-md-4 col-sm-12 d-flex justify-content-center'>
                    <div class='card bg-secondary mb-3' style='max-width: 20rem;'>
                        <div class='card-header'>" . $value['libelle'] . "</div>
                        <div class='card-body'>
                                <img src=" . $value['photo'] . " width=250 >
                                <p class='card-text'>" . substr($value['description'], 0, 120) . "...</p>
                                <h4><strong>" . number_format($value['prix']) . " TND</strong></h4>
                                
                                <div>
                                <form action='home.php' method='POST'>
                                    <input type='hidden' name='id' value=" . $value['id_article'] . ">
                                    <button type='submit' name='add_to_cart' class='btn btn-outline-primary'>add to cart</button>
                                    <a href='detail_article.php?id=" . $value['id_article'] . "' type='button' class='btn btn-outline-primary'>Details</a>
                                </form>
                                    </div>
                                ";
                if ($value['en_promo'] == 1) {
                    echo "<img class='my-3' src='images/promo.png' width=80>";
                }
                echo "
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

        </div>

</body>


</html>