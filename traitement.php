<?php
    session_start();

    if(isset($_GET['action'])) {

        switch($_GET['action']) {

            case "ajouter" : 
                if(isset($_POST['submit'])) { // isset() to verify the existance of something
              
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $qtt = filter_input(INPUT_POST,"qtt", FILTER_VALIDATE_INT);
                    
                    if($name && $price && $qtt) { // to read codes if the filtered variables are true
            
                        $product = [
                            "name" => $name,
                            "price" => $price,
                            "qtt" => $qtt,
                            "total" => $price*$qtt
                        ];
            
                        $_SESSION['products'][] = $product; // to add produts from "form"

                        $_SESSION['message'] = "$name --> ajouté";   

                    }
                    else{
                        $_SESSION['message'] = "<span style='color:red'>La quantité et le prix ne peuvent pas être zéro !</span>";
                    }

                    header("Location: index.php");
                }
            break;
            
            case "vider" :
                //! to clear the session
                unset($_SESSION['products']);
                header("Location: recap.php"); 
                // die; to stop code reading here
            break;    // arraySESSION(arrayProduits(a,b,c))

            case "supprimerProduit":
                unset($_SESSION['products'][$_GET['id']]);
                header("Location: recap.php"); 
            break;

            case "upQuantity":
                $_SESSION['products'][$_GET['id']]['qtt']++;
                $_SESSION['products'][$_GET['id']]['total'] =
                $_SESSION['products'][$_GET['id']]['price'] * $_SESSION['products'][$_GET['id']]['qtt'];
                header("Location: recap.php"); 
            break;
            
            case "downQuantity":
                if ($_SESSION['products'][$_GET['id']]['qtt'] > 1){
                    $_SESSION['products'][$_GET['id']]['qtt']--; 
                    $_SESSION['products'][$_GET['id']]['total'] =
                    $_SESSION['products'][$_GET['id']]['price'] * $_SESSION['products'][$_GET['id']]['qtt'];
                }
                else {
                    unset($_SESSION['products'][$_GET['id']]); 
                }
                header("Location: recap.php"); 
            break;

            default :
                header("Location:index.php");
        }
    } 
    
    else {
        header("Location:index.php");
    }

?>