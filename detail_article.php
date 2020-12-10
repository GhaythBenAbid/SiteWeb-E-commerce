<?php
session_start();

require 'total.php';



//Connexion a la Base (pour avoir l'id de l'article)
require_once 'Connexion.php';
$id = $_GET['id'];
$res = $cnx->query("select * from article where id_article=$id");
$article = $res->fetch(PDO::FETCH_ASSOC);

// l'ajout au panier (si on click sur le bouton ADD TO CART)
if (isset($_POST['add_to_cart'])) {
    $lib = $article['libelle'];
    $qte = $_POST['qte'];
    //Verification si le produit est deja ajouté ou non
    if (isset($_SESSION['article'][$lib])) {
        $_SESSION['article'][$lib] += $qte;
    } else {
        $_SESSION['article'][$lib] = $qte;
    }
}

//supprimer le produit 
if (isset($_POST['remove_from_cart'])) {
    $lib = $article['libelle'];
    unset($_SESSION['article'][$lib]);
}

if (isset($_SESSION['article'])) {
    unset($_SESSION['total']);
    $total = 0;
    foreach ($_SESSION['article'] as $key => $value) {
        $total += $value;
    }
    $_SESSION['total'] = $total;
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
    <title>Login</title>
</head>

<body class="bg-secondary">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="" width="150px">
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
                    <a class="nav-link" href="#">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="panier.php">Panier</a>
                </li>
                <li class="nav-item">
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


    <div class="container">

        <div class="row align-items-center">
            <div class="col-md-5">
                <?php

                echo "<img src='" . $article['photo'] . "' width='450'>";

                ?>
            </div>
            <div class="col-md-7 d-flex justify-content-center">
                <div class="card bg-secondary mb-3 w-100" style="max-width: 20rem;">
                    <div class="card-header">Ajouter au panier</div>
                    <div class="card-body">
                        <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . $article['id_article']; ?>" method="POST">
                            <h4 class="card-title"><?php echo $article['libelle'] ?></h4>
                            <h5 class="card-title"><?php echo $article['prix'] ?>DT</h5>
                            <?php
                            if ($article['en_promo'] == 1) {
                                echo "<img class='my-3' src='images/promo.png' width=80>";
                            }
                            ?>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm" for="inputSmall">Quantité</label>
                                <input class="form-control form-control-sm" type="text" placeholder="Quantité" value="1" name="qte">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="add_to_cart" class='btn btn-outline-warning my-1'>add to cart</button>
                                <button type='submit' name="remove_from_cart" class='btn btn-outline-danger'>remove from cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                if (isset($_GET['id'])) {
                    echo "<h1>{$article['libelle']}</h1>";
                    echo "<p>{$article['description']}</p>";
                }
                ?>
            </div>
        </div>
    </div>


</body>


</html>