<?php

require("db_connect.php");
require("login_action.php");

$date = date('Y-m-d G:i:s');
$sql_order = "INSERT INTO fruity_heaven_db.orders(Order_ID, Order_Date, client_id) VALUES (NULL, '$date', '".$_SESSION['Client_ID']."');";
setData($sql_order);

$final_order = $_SESSION['shopping_cart'];

function nameToID($name)
{
    $sql_retrieve_fruit_data = "SELECT * from fruity_heaven_db.food_items;";
    $fruit_data = getData($sql_retrieve_fruit_data);

    foreach($fruit_data as $arr_key => $arr_val)
    {
        if($fruit_data[$arr_key]['food_item'] == $name)
        {
            return $fruit_data[$arr_key]['foodID'];
        }
    }
}

$sql_get_order_id = "SELECT MAX(Order_ID) FROM fruity_heaven_db.orders;";
$order_id = getData($sql_get_order_id)['0']['MAX(Order_ID)'];


foreach($final_order as $arr_key => $arr_val)
{   
    $final_order[$arr_key]['0'] = nameToID($final_order[$arr_key]['0']);
    $final_order[$arr_key]['1'] = nameToID($final_order[$arr_key]['1']);
    $final_order[$arr_key]['2'] = implode(",", $final_order[$arr_key]['2']);
    $final_order[$arr_key]['5'] = implode(",", $final_order[$arr_key]['5']);

    $fruit1 = $final_order[$arr_key]['0'];
    $fruit2 = $final_order[$arr_key]['1'];
    $nuts_seeds_spices = $final_order[$arr_key]['2'];
    $quantity = $final_order[$arr_key]['3'];
    $thickness = $final_order[$arr_key]['4'];
    $extras = $final_order[$arr_key]['5'];

    $sql_order_items = "INSERT INTO fruity_heaven_db.order_items (ID, Order_ID, Fruit_1, Fruit_2, Nuts_Seeds_Spices, Quantity, Thickness, Extras) 
    VALUES (NULL, '$order_id', '$fruit1', '$fruit2', '$nuts_seeds_spices', '$quantity', '$thickness', '$extras');";

    setData($sql_order_items);

}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Fruity Heaven | Checkout</title>
        <style><?php include '../CSS/base.css'?></style>
        <style><?php include '../CSS/client_processOrder.css'?></style>
    </head>

    <body>
        <header>
            <h1>Fruity Heaven</h1>
            <a href = "dashboard.php" class = "home">Home</a>
            <a href = "client_allFruits.php" class = "menu" id = "menu">Menu</a>
            <a href = "client_viewOrders.php" class = "history" id = "order_history">Order History</a>
            <a href = "client_editDetails.php" class = "user"><?php echo $_SESSION['First_Name']?></a>
            <a href = "login_action.php?logOut=true" class = "logout">Log Out</a>
            
        </header>

        <main>
            <h2>Processing your order</h2>

            <fieldset>
                <p>Your order is being processed.</p>
                <h3>Order Details: </h3>

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
            </fieldset>
            
        </main>

        <footer>
            <p>Connect with us!</p>
            <ul>
                <li><a href = "instagram.com/fruity_heaven">Instagram</a></li>
                <li><a href = "twitter.com/fruity_heaven">Twitter</a></li>
                <li><a href = "snapchat.com/fruity_heaven">Snapchat</a></li>
            </ul>
    
            <a href = "About Us.html">About Us</a><br>
            <a href = "FAQ.html">FAQ</a>
    
            <p class = "copyright">2021 Fruity Heaven. All rights reserved.</p>
        </footer>
    </body>
</html>

<?php




?>