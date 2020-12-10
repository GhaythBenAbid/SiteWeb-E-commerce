<?php 

require_once 'Connexion.php';
session_start();




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
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

        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-md-center text-center my-5">
            <div class="col-md-5">
                <p class="font-weight-bold">Admin Page</p>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <h3 for="exampleInputEmail1">Email address</h3>
                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <h3 for="exampleInputPassword1">Password</h3>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="progress my-3">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                    <div>
                        <button type="submit" name="login" class="btn btn-outline-primary">Login</button>
                    </div>
                    <div class="my-3">
                        <a>forget your password ?</a>
                    </div>
                </form>
            </div>

        </div>
    </div>




    <?php

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $res = $cnx->query("select * from admin where email='$email' and password='$password'");
        $connexion = $res->fetch(PDO::FETCH_ASSOC);
        
        if ($connexion){
            $_SESSION['id_admin'] = $connexion['id_admin'];
            header('location:MenuAdmin.php');
        }else{
            echo "
            <div class='alert alert-danger' role='alert'>
                  Enter the right 'Email' and 'Password'
            </div>
            ";
        }
    }   






    ?>

</body>


</html>