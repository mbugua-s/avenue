<?php

require("db_connect.php");
require("login_action.php");
$edited_details = $_SESSION['shopping_cart'][$_SESSION['edited_order_no']];

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
            <h2>Edit your order</h2>

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
                                    $select;
                                    if($edited_details['0'] == $fruit_data[$key]['food_item']){$select = ' selected = "selected"';}else{$select = "";};
                                    echo "<option".$select.">".$fruit_data[$key]['food_item']."</option>";
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
                                    $select;
                                    if($edited_details['1'] == $fruit_data[$key]['food_item']){$select = ' selected = "selected"';}else{$select = "";};
                                    echo "<option".$select.">".$fruit_data[$key]['food_item']."</option>";
                                }
                            ?>
                        </optgroup> 
                    </select><br><br>

                    <h3>Nuts, Seeds and Spices </h3>
                    <label for = "Mint">Mint: </label>
                    <input type = "checkbox" id = "Mint" name = "nuts_seeds_spices[]" value = "Mint" <?php foreach($edited_details['2'] as $number => $fruit){if($fruit == 'Mint'){echo 'checked = "checked"';}}?>><br>

                    <label for = "Cinnamon">Cinnamon: </label>
                    <input type = "checkbox" id = "Cinnamon" name = "nuts_seeds_spices[]" value = "Cinnamon" <?php foreach($edited_details['2'] as $number => $fruit){if($fruit == 'Cinnamon'){echo 'checked = "checked"';}}?>><br>

                    <label for = "Almonds">Almonds: </label>
                    <input type = "checkbox" id = "Almonds" name = "nuts_seeds_spices[]" value = "Almonds" <?php foreach($edited_details['2'] as $number => $fruit){if($fruit == 'Almonds'){echo 'checked = "checked"';}}?>><br>

                    <label for = "Chia Seeds">Chia Seeds: </label>
                    <input type = "checkbox" id = "Chia Seeds" name = "nuts_seeds_spices[]" value = "Chia Seeds" <?php foreach($edited_details['2'] as $number => $fruit){if($fruit == 'Chia Seeds'){echo 'checked = "checked"';}}?>><br>

                    <h3>Quantity </h3>

                    <label for = "300ml">300ml: </label>
                    <input type = "radio" id = "300ml" name = "juice_quantity" value = "300 ml" <?php if($edited_details['3'] == "30 0ml"){echo 'checked = "checked"';}?>><br>

                    <label for = "500ml">500ml: </label>
                    <input type = "radio" id = "500ml" name = "juice_quantity" value = "500 ml" <?php if($edited_details['3'] == "500 ml"){echo 'checked = "checked"';}?>><br>

                    <h3>Thickness</h3>

                    <label for = "Smooth">Smooth: </label>
                    <input type = "radio" id = "Smooth" name = "thickness" value = "Smooth" <?php if($edited_details['4'] == "Smooth"){echo 'checked = "checked"';}?>><br>

                    <label for = "Medium">Medium: </label>
                    <input type = "radio" id = "Medium" name = "thickness" value = "Medium" <?php if($edited_details['4'] == "Medium"){echo 'checked = "checked"';}?>><br>

                    <label for = "Thick">Thick: </label>
                    <input type = "radio" id = "Thick" name = "thickness" value = "Thick" <?php if($edited_details['4'] == "Thick"){echo 'checked = "checked"';}?>><br>

                    <h3>Extras </h3>

                    <label for = "Milk">Milk: </label>
                    <input type = "checkbox" id = "Milk" name = "extras[]" value = "Milk" <?php foreach($edited_details['5'] as $number => $extra){if($extra == 'Milk'){echo 'checked = "checked"';}}?>><br>

                    <label for = "Sugar">Sugar: </label>
                    <input type = "checkbox" id = "Sugar" name = "extras[]" value = "Sugar" <?php foreach($edited_details['5'] as $number => $extra){if($extra == 'Sugar'){echo 'checked = "checked"';}}?>><br>

                    <label for = "Honey">Honey: </label>
                    <input type = "checkbox" id = "Honey" name = "extras[]" value = "Honey" <?php foreach($edited_details['5'] as $number => $extra){if($extra == 'Honey'){echo 'checked = "checked"';}}?>><br>
                    
                    <input type = "reset" name = "reset" id = "reset_details" value = "RESET" class = "button"><br>
                    <input type = "submit" name = "save_edited_order" id = "save_edited_order" value = "SAVE CHANGES" class = "button">
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