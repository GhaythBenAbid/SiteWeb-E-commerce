<?php



function total()
{
    if (!isset($_SESSION['total'])) {
        $_SESSION['total'] = 0;
    } else if (isset($_SESSION['article'])) {

        unset($_SESSION['total']);
        $total = 0;
        foreach ($_SESSION['article'] as $key => $value) {
            $total += $value;
        }
        $_SESSION['total'] = $total;
    }
}


function sommeTotal($cnx)
{


    $somme = 0;


    if (isset($_SESSION['article'])) {
        foreach ($_SESSION['article'] as $key => $value) {
            $res = $cnx->query("select prix from article where libelle='$key'");
            $article = $res->fetch(PDO::FETCH_ASSOC);

            $prix = $article['prix'];
            $qte =  $value;
            $somme += $prix * $qte;
        }
    }

    return number_format($somme);
}
