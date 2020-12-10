<?php

require_once 'Connexion.php';


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Supprimer</title>
</head>

<body class="bg-light">
    <div class="container">
        <h1>Supprimer un produit par reference</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
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

                <button class="btn btn-danger my-3" type="submit" name="Rechercher">Rechercher</button>
                <a href="menu.html" role="button" class="btn btn-danger">Menu</a>
            </div>
        </form>



        <?php

        var_dump($_POST);


        if (isset($_POST['Rechercher'])) {
            $id = $_POST['categorie'];
            $res = $cnx->query("select * from article where idcategorie=$id");
            $article = $res->fetchAll(PDO::FETCH_ASSOC);


            if (isset($_POST['supprimer'])) {
                $id = $_POST['productid'];
                $res = $cnx->exec("delete from article where id_article=$id");
                
            }


            if ($article) {

                echo "
                <table class='table table-hover'>
                <thead>
                <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Libelle</th>
                    <th scope='col'>Prix</th>
                    <th scope='col'>action</th>
                </tr>
                </thead>
                <tbody>
                ";
                foreach ($article as $value) {
                    echo "
                    <tr>
                        <form action='delete_product.php' method='POST'>
                        <td>" . $value['id_article'] . "</td>
                        <td>" . $value['libelle'] . "</td>
                        <td>" . number_format($value['prix']) . " DT</td>
                        <input type='hidden' name='productid' value=" . $value['id_article'] . ">
                        <td> <button type='submit' name='supprimer' class='btn btn-danger'>Delete</button> </td>
                        </form>
                    </tr>
                    ";
                }
            }
        }



        ?>
    </div>
</body>

</html>