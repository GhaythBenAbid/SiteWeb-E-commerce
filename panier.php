<?php

require_once 'Connexion.php';
require 'total.php';



session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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


    <div class="container">




        <table class="table">
            <thead>
                <tr>
                    <th scope="col">product</th>
                    <th scope="col">product name</th>
                    <th scope="col">Price</th>
                    <th scope="col">quantity</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>


                <?php


                if (isset($_SESSION['article'])) {
                    foreach ($_SESSION['article'] as $key => $value) {




                        $res = $cnx->query("select * from article where libelle='$key'");
                        $article = $res->fetch(PDO::FETCH_ASSOC);

                        $lib = $article['libelle'];
                        $id = $article['id_article'];
                        $prix = $article['prix'];
                        $photo = $article['photo'];
                        $qte = $_SESSION['article'][$lib];


                        if (isset($_POST[$id]) && isset($_POST['modify_article'])) {

                            $qte = $_POST['qte'];
                            $_SESSION['article'][$lib] = $qte;
                        }


                        if (isset($_POST[$id]) && isset($_POST['delete_article'])) {
                            unset($_SESSION['article'][$lib]);
                        } else {
                            echo "
                            <tr>
                            <form action='panier.php' method='POST'>
                                <td class='align-middle'><img src=$photo width=150></td>
                                <td class='align-middle'>$lib</td>
                                <td class='align-middle'>$prix DT</td>
                                
                                

                                <td class='align-middle'>
                                <div class='input-group'>
                                    <input class='text-center' name=qte value=$qte type='number' value='5' min='0' max='100' step='1' data-decimals='2' data-digit-grouping='false'>
                                    <div class='input-group-append'>
                                    <button type='submit' name='modify_article' class='btn btn-primary'>
                                    <i class='fa fa-pencil-square-o text-light'  style='font-size:27px'></i>
                                </button>                                    
                                </div>
                                </div>
                                </td>
                                
                                <td class='align-middle'>
                                <input type='hidden' name='$id' value='$key'>  
                                <button type='submit' name='delete_article' class='btn btn-primary'>
                                    <i class='fa fa-trash-o text-light'  style='font-size:27px'></i>
                                </button>
        
                                </td>
                            
                                </form>
                            </tr>
                        ";
                        }
                    }
                }
                total();


                echo "<tr>
                        <td colspan='4'><h3>Total TTC</h3></td>
                        <td><h3>" . sommeTotal($cnx) . " DT</h3></td>
                        </tr>
                        
                        <tr>
                        
                        <td colspan='4'></td>
                        <td>
                            <a href='home.php' class='btn btn-primary'>Payer</a>
                        </td>

                        </tr>
                        ";



                ?>
            </tbody>
        </table>
    </div>


</body>


</html>