<?php

require("login_action.php");
require("db_connect.php");

$fruit_details = $_SESSION['edited_fruit']['0'];
$food_ID = $fruit_details['foodID'];
$food_name = $fruit_details['food_item'];
$food_image = $fruit_details['food_image'];
$food_price = $fruit_details['price'];

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Fruits</title>
        <style><?php include '../CSS/base.css'?></style>
        <style><?php include '../CSS/register.css'?></style>
        <style><?php include '../CSS/admin_settings.css'?></style>
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
            <fieldset>
                <form method = "POST" action = "admin_saveSettings.php" enctype = "multipart/form-data">
                    <h2>Edit or Delete Fruits</h2>

                    <?php echo '<img src = "../assets/'.$food_image.'"><br><br><br>';?>
                    
                    <label class = "edit_label" for = "fruit_name">Fruit Name: </label>
                    <?php echo '<input class = "edit_input" type = "text" id = "fruit_name" name = "fruit_name" value ='.$food_name.'><br><br><br>'; ?>

                    <label class = "edit_label" for = "add_photo">Change fruit image : </label>
                    <input class = "edit_input" type = "file" id = "add_new_photo" name = "add_photo" class = "upload_button"><br><br><br>

                    <label class = "edit_label" for = "fruit_price">Price: </label>
                    <?php echo '<input class = "edit_input" type = "number" name = "fruit_price" id = "fruit_price" value = '.$food_price.'><br><br>';?>
                

                    <input type = "submit" name = "edit_fruit" value = "EDIT FRUIT" class = "button">
                    <input type = "reset" name = "reset" id = "reset_details" value = "RESET" class = "button"><br>
                    <input type = "submit" name = "delete_fruit" id = "delete_fruit" value = "DELETE FRUIT" class = "delete_button">
                    
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

            <a href = "About Us.html">About Us</a><br>
            <a href = "FAQ.html">FAQ</a>

            <p class = "copyright">2021 Fruity Heaven. All rights reserved.</p>
        </footer>
    </body>
</html>