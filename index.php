<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300;500;600;700&display=swap" rel="stylesheet">
    <title>Application_Cart_PHP</title>
</head>
<body>

    <?php  
    // spl_autoload_register(function ($_className){
    //     require $_className . ".php";
    // });
    session_start();
    // var_dump($_SESSION);
    // var_dump($_SESSION['products']);
    ?>

        <nav>
            <div><a href="recap.php">Panier&nbsp;</a><?php 
                                                            if (isset($_SESSION['products']) && !empty($_SESSION['products'])){
                                                                $plurielSingle = (count($_SESSION['products'])>1) ? "articles" : "article";
                                                                echo "<span id='nbArticles'>" . count($_SESSION['products']) ." $plurielSingle</span></div>";
                                                            }
                                                        ?>              
        </nav>

    <section>
        


        <h1>Ajouter un produit</h1>
        <form action="traitement.php?action=ajouter" method="post">
            <p>
                <label>
                    <span>Nom du produit : &nbsp;</span>
                    <input type="text" name="name" required>
                </label>
            </p>
            <p>
                <label>
                    <span>Prix du produit : &nbsp;</span>
                    <input type="number" step="any" name="price" min = "0" required>
                </label>
            </p>
            <p>
                <label>
                    <span>Quantité désiré : &nbsp;</span>
                    <input type="number" name="qtt" value="1" min = "0" required>
                </label>
            </p>
            <p id="submit">
                <input type="submit" name="submit" value="AJOUTER">
            </p>
        </form>

        <p id="validation"><?php 

                                if (isset($_SESSION['message']) && !empty($_SESSION['message'])){

                                    // $message = implode($_SESSION['message']);
                                    // foreach($_SESSION['message'] as $message){
                                    //     echo $message;
                                    // }
                                    echo $_SESSION['message']; //? The value is not an array because I didn't use Square brackets in the "traitement.php" file. 
                                    unset($_SESSION['message']);
                                    
                                }
                        
                            ?>
        </p>
    </section>

</body>
</html>