<?php

require("login_action.php");
require("db_connect.php");



if(isset($_POST['add_to_cart']) || isset($_POST['save_edited_order']))
{
    $order_details = array($_POST['fruit_1'], $_POST['fruit_2'], $_POST['nuts_seeds_spices'], $_POST['juice_quantity'], $_POST['thickness'], $_POST['extras']);

    if(isset($_POST['save_edited_order']))
    {
        $_SESSION['shopping_cart'][$_SESSION['edited_order_no']] = $order_details;
    }

    else
    {
        $_SESSION['shopping_cart'][$_SESSION['order_no']] = $order_details;
    }
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
        <style><?php include '../CSS/base.css'?></style>
        <style><?php include '../CSS/register.css'?></style>
        <style><?php include '../CSS/client_processOrder.css'?></style>
        
    </head>

    <body>
        <header>
            <h1>Fruity Heaven</h1>
            <a href = "dashboard.php" class = "home">Home</a>
            <a href = "client_allFruits.php" class = "menu" id = "menu">Menu</a>
            <a href = "client_viewOrders.php" class = "history" id = "order_history">Order History</a>
            <a href = "client_editDetails.php" class = "user"><?php echo $_SESSION['First_Name'];?></a>            
            <a href = "login_action.php?logOut=true" class = "logout">Log Out</a>
        </header>

        <main>
            <h2>Shopping Cart</h2>
            <fieldset>
                <form method = "POST" action = "place_order.php">
                    
                    <?php
                    $counter = 1;

                    foreach($_SESSION['shopping_cart'] as $arr_key => $arr_val)
                    {
                        echo '<p class = "Order_No">Order '.$counter,'</p>';
                        $counter++;
                        echo '<h4>Fruit 1: </h4><p>'.$_SESSION['shopping_cart'][$arr_key]['0'].'</p>';
                        echo '<h4>Fruit 2: </h4><p>'.$_SESSION['shopping_cart'][$arr_key]['1'].'</p>';
                        echo '<h4>Nuts, Seeds and Spices:</h4>';

                        foreach($_SESSION['shopping_cart'][$arr_key]['2'] as $arr_key1 => $arr_val1)
                        {
                            echo '<p>'.$_SESSION['shopping_cart'][$arr_key]['2'][$arr_key1].'</p>';
                        }

                        echo '<h4>Quantity: </h4><p>'.$_SESSION['shopping_cart'][$arr_key]['3'].'</p>';
                        echo '<h4>Thickness: </h4><p>'.$_SESSION['shopping_cart'][$arr_key]['4'].'</p>';
                        echo '<h4>Extras: </h4>';

                        foreach($_SESSION['shopping_cart'][$arr_key]['5'] as $arr_key1 => $arr_val1)
                        {
                            echo '<p>'.$_SESSION['shopping_cart'][$arr_key]['5'][$arr_key1].'</p>';
                        }
                    }

                    ?>
                    <br><br><br><p>Want to add another drink to your cart?</p>
                    <input type = "submit" name = "continue_shopping" value = "CONTINUE SHOPPING" class = "button">

                    <h3>Edit or Delete Order</h3>
                    <select id = "order_numbers" name = "order_numbers">
                        <optgroup>
                            <?php
                            foreach($_SESSION['shopping_cart'] as $order_no => $order_details)
                            {
                                echo '<option>Order '.$order_no.'</option>';
                            }
                            ?>
                        </optgroup>
                    </select><br><br>

                    <input type = "submit" name = "edit_order" value = "EDIT ORDER" class = "button">
                    <input type = "submit" name = "delete_order" value = "DELETE ORDER" class = "button"><br>

                    <input type = "submit" name = "process_order" value = "PROCEED TO CHECKOUT" class = "button">
                </form>
                
            </fieldset>
        </main>
        
        <footer>
            <p>Connect with us!</p>
            <ul>
                <li><a href = "instagram.com/fruity_heaven">Instagram</a></li>
                <li><a href = "twitter.com/fruity_heaven">Twitter</a></li>
                <li><a href = "snapchat.com/fruity_heaven">Snapchat</a></li>
            </ul>

            <a href = "About Us.php">About Us</a><br>
            <a href = "FAQ.php">FAQ</a>

            <p class = "copyright">2021 Fruity Heaven. All rights reserved.</p>
        </footer>
    </body>
</html>
