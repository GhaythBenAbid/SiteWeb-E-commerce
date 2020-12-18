<?php

require_once 'Connexion.php';
session_start();

if (!isset($_SESSION['id_admin'])){
    header("location:d.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container my-3">
        <h1>Add a new product</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">

                <label>Email</label>
                <input type="text" class="form-control" name="email">

                <label>Password</label>
                <input type="password" class="form-control" name="password">

                <button class="btn btn-success my-3" name="Ajouter" type="submit">Ajouter</button>
                <a href="MenuAdmin.php" role="button" class="btn btn-danger">Menu</a>
            </div>
        </form>
    </div>


    <?php
    require_once 'connexion.php';


    if (isset($_POST['Ajouter'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        
        $sql = "insert into admin values(null , '$email' , '$pass')";

        
        $res = $cnx->exec($sql);

        if ($res) {
            echo ("<h1 class='text-center'>le nouveau admin a éte bien ajouté</h1>");
        } else {

            echo ("<h1 class='text-center'>il y a un probleme pendant l'insertion veuillez verifiez</h1>");
        }

        
    }
    ?>

</body>

</html>