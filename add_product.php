<?php

require_once 'Connexion.php';
session_start();


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
                <label>Reference</label>
                <input type="text" class="form-control" name="id">

                <label>Libelle</label>
                <input type="text" class="form-control" name="libelle">

                <label>Description</label>
                <input type="text" class="form-control" name="description">

                <label>Image</label>
                <input type="text" class="form-control" name="Image">

                <label>Prix</label>
                <input type="text" class="form-control" name="prix">

                <label>en promo</label>
                <input type="text" class="form-control" name="promo">

                <label>Categorie</label>
                <select name="categorie" class="custom-select">
                    <option selected="">Categories</option>
                    <?php

                    $res = $cnx->query("select * from categorie");
                    $article = $res->fetchall(PDO::FETCH_ASSOC);

                    foreach ($article as  $value) {
                        $nom = $value['nom_categorie'];
                        $id = $value['id_categorie'];

                        echo "<option value=$id>$nom</option>";
                    }



                    ?>
                </select>

                <button class="btn btn-success my-3" type="submit">Ajouter</button>
                <a href="menu.html" role="button" class="btn btn-danger">Menu</a>
            </div>
        </form>
    </div>


    <?php
    require_once 'connexion.php';


    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $lib = $_POST['libelle'];
        $desc = $_POST['description'];
        $img = $_POST['Image'];
        $prix = $_POST['prix'];
        $promo = $_POST['promo'];
        $cat = $_POST['categorie'];

        $idAdmin = $_SESSION['id_admin'];


        
        $sql = "insert into article values($id , '$lib' , '$desc' , '$img' , $prix , $promo , $cat , $idAdmin)";

        
        $res = $cnx->exec($sql);

        echo($res);
        if ($res) {
            echo ("<h1 class='text-center'>le produit a éte bien ajouter</h1>");
        } else {

            echo ("<h1 class='text-center'>il y a un probleme pendant l'insertion veuillez verifiez</h1>");
        }

        
    }






    ?>

</body>

</html>