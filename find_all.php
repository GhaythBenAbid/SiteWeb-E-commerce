<?php

require_once 'connexion.php';
session_start();

if (!isset($_SESSION['id_admin'])) {
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</head>

<body class="bg-light">
    <div class="container py-3">



        <h1 class="py-3">Tous les produits</h1>

        <?php



        if (isset($_POST['delete_article'])) {
            $id = $_POST['delete_article'];
            $sql = "delete from article where id_article=$id";
            $res = $cnx->exec($sql);
        }

        if (isset($_POST['modifier_article'])) {
            $_SESSION['id_modifier'] = $_POST['modifier_article'];
            header("location:modifier_article.php");
        }


        $sql = "select * from article";
        $res = $cnx->query($sql);

        $article = $res->fetchAll(PDO::FETCH_ASSOC);







        if ($article) {
            echo "<table id='example' class='table table-striped'> <thead class='thead'> <tr> <th>Ref</th> <th>Libelle</th> <th>Detail</th> </tr> </thead> <tbody>";
            foreach ($article as $value) {
                echo "<form action='find_all.php' method='POST'";
                echo "<tr>";
                echo "<td>" . $value['id_article'] . "</td>";
                echo "<td>" . $value['libelle'] . "</td>";
                echo "<td> <button type='submit' name='delete_article' value=" . $value['id_article'] . " class='btn btn-primary'>delete</button> ";
                echo "<button type='submit' name='modifier_article' value=" . $value['id_article'] . " class='btn btn-primary'>modifier</button> </td>";
                echo "</tr>";
                echo "</form>";
            }
            echo "</tbody> </table>";
        }







        ?>
        <a href="add_product.php" role="button" class="btn btn-primary">Ajouter un article</a>
        <a href="menuAdmin.php" role="button" class="btn btn-danger">Menu</a>

    </div>
</body>

</html>