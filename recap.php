<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Récapitulatif des produits</title>
</head>
<body>

    <nav>
        <a href="index.php">Accueil</a>
    </nav>

    <section>
        
        <?php 
        // var_dump($_SESSION); // To test the functionnality and security(by filters in "traitement.php") of form(created in "index.php") before and after adding products.

        if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
            echo "<p>Aucun produit dans le panier.</p>";
        }
        else{
            // var_dump($_SESSION['products']); // to verify session values
            echo "<table>",
                    "<thead>",
                        "<tr>",
                            "<th>#</th>",
                            "<th>Nom</th>",
                            "<th>Prix</th>",
                            "<th>Quantité</th>",
                            "<th>Total</th>",
                        "</tr>",
                    "</thead>",
                   "<tbody>";
            $totalGeneral = 0;
            // var_dump($_SESSION['products']);
            foreach($_SESSION['products'] as $index => $product){
                // var_dump($product);
                echo "<tr>",
                        "<td>".$index."</td>",
                        "<td>".$product['name']."</td>",
                        "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td><a id='diminuer' href='traitement.php?action=downQuantity&id=$index'>-</a>&nbsp;&nbsp;".$product['qtt']."&nbsp;&nbsp;<a id='augmenter' href='traitement.php?action=upQuantity&id=$index'>+</a></td>",
                        "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                        "<td><a id='supprimer' href='traitement.php?action=supprimerProduit&id=$index'>Supprimer</a></td>",
                     "</tr>";
            $totalGeneral += $product['total'];
            }

                echo "<tr>
                        <td class='padding' colspan=4><span class='total'> Total général:</span> </td>
                        <td class='padding' colspan=1><strong><span class='total'>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</span></strong></td>
                     </tr>";
            
            echo   "</tbody>",
                 "</table>";
        }

        if(isset($_SESSION['products']) && !empty($_SESSION['products'])) {
            echo "<a id='vider' href='traitement.php?action=vider'>Vider le panier</a>";
        }
        ?>
    </section>

</body>
</html>