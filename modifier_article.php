<?php

require_once 'connexion.php';
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
    <title>Rechercher</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>

<body class="bg-light">
    <div class="container py-3">
        <h1 class="py-3">Tous les produits</h1>
        <form action="modifier_article.php" method="POST">
            <?php



            $id = $_SESSION['id_modifier'];

            $sql = "select * from article where id_article=$id";
            $res = $cnx->query($sql);

            $article = $res->fetch(PDO::FETCH_ASSOC);

            foreach ($article as $key => $value) {
                echo "
            <label>$key</label>
            <input type='text' class='form-control' name='article[]' value='$value'>
            ";
            }

            echo "
            <button type='submit' name='modifier' class='btn btn-primary'>Modifier</button>
        
            ";







            ?>
        </form>

        <?php

            if(isset($_POST['modifier'])){
                
                $article = $_POST['article'];
                
                $res = $cnx->exec("update article set libelle = '$article[1]' , description = '$article[2]' , photo = '$article[3]' , prix = $article[4] , en_promo = $article[5] , idcategorie = $article[6] , id_admin = $article[7] where id_article = $article[0]");
                echo $res;
            }


        ?>



    </div>
</body>

</html>