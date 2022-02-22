<?php

require("login_action.php");
require("db_connect.php");

if(isset($_POST['continue_shopping']))
{
    $_SESSION['order_no']++;
}

else if(isset($_POST['edit_order']))
{
    $order_id = explode(" ", $_POST['order_numbers']);
    $_SESSION['edited_order_no'] = $order_id['1'];
    header("location:client_editOrder.php");
}

else if(isset($_POST['delete_order']))
{
    $order_id = explode(" ", $_POST['order_numbers']);
    unset($_SESSION['shopping_cart'][$order_id['1']]);
    header("location:client_shoppingCart.php");
}

else if(isset($_POST['process_order']))
{
    header("location:client_processOrder.php");
}

else
{
    $_SESSION['order_no'] = 1;
}

$sql_get_fruit_data = "SELECT food_item FROM food_items;";
$fruit_data = getData($sql_get_fruit_data);

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Fruity Heaven | Place Order</title>
        <style><?php include '../CSS/base.css'?></style>
        <style><?php include '../CSS/PlaceOrder.css'?></style>
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
            <h2>Place your order</h2>

            <form method = "POST" action = "client_shoppingCart.php">
                <fieldset>
                    <legend: Place Order></legend:>

                    <h3>Fruits </h3>

                    <label for = "Fruit 1">Fruit 1: </label>
                    <select id = "Fruit 1" name = "fruit_1">
                        <optgroup>
                            <?php
                                foreach($fruit_data as $key => $val)
                                {
                                    echo '<option>'.$fruit_data[$key]['food_item'].'</option>';
                                }
                            ?>
                        </optgroup>
                                           
                    </select><br><br>

                    <label for = "Fruit 2">Fruit 2: </label>
                    <select id = "Fruit 2" name = "fruit_2">
                        <optgroup>
                            <?php
                                foreach($fruit_data as $key => $val)
                                {
                                    echo '<option>'.$fruit_data[$key]['food_item'].'</option>';
                                }
                            ?>
                        </optgroup> 
                    </select><br><br>

                    <h3>Nuts, Seeds and Spices </h3>
                    <label for = "Mint">Mint: </label>
                    <input type = "checkbox" id = "Mint" name = "nuts_seeds_spices[]" value = "Mint"><br>

                    <label for = "Cinnamon">Cinnamon: </label>
                    <input type = "checkbox" id = "Cinnamon" name = "nuts_seeds_spices[]" value = "Cinnamon"><br>

                    <label for = "Almonds">Almonds: </label>
                    <input type = "checkbox" id = "Almonds" name = "nuts_seeds_spices[]" value = "Almonds"><br>

                    <label for = "Chia Seeds">Chia Seeds: </label>
                    <input type = "checkbox" id = "Chia Seeds" name = "nuts_seeds_spices[]" value = "Chia Seeds"><br>

                    <h3>Quantity </h3>

                    <label for = "300ml">300ml: </label>
                    <input type = "radio" id = "300ml" name = "juice_quantity" value = "300 ml"><br>

                    <label for = "500ml">500ml: </label>
                    <input type = "radio" id = "500ml" name = "juice_quantity" value = "500 ml"><br>

                    <h3>Thickness</h3>

                    <label for = "Smooth">Smooth: </label>
                    <input type = "radio" id = "Smooth" name = "thickness" value = "Smooth"><br>

                    <label for = "Medium">Medium: </label>
                    <input type = "radio" id = "Medium" name = "thickness" value = "Medium"><br>

                    <label for = "Thick">Thick: </label>
                    <input type = "radio" id = "Thick" name = "thickness" value = "Thick"><br>

                    <h3>Extras </h3>

                    <label for = "Milk">Milk: </label>
                    <input type = "checkbox" id = "Milk" name = "extras[]" value = "Milk"><br>

                    <label for = "Sugar">Sugar: </label>
                    <input type = "checkbox" id = "Sugar" name = "extras[]" value = "Sugar"><br>

                    <label for = "Honey">Honey: </label>
                    <input type = "checkbox" id = "Honey" name = "extras[]" value = "Honey"><br>
                    
                    <input type = "reset" name = "reset" id = "reset_details" value = "RESET" class = "button"><br>
                    <input type = "submit" name = "add_to_cart" id = "add_to_cart" value = "ADD TO CART" class = "button">
                </fieldset>    
            </form>
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