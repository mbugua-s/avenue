<?php
    require("db_connect.php");
    require("login_action.php");
    $sql = "SELECT * FROM fruity_heaven_db.food_items;";
    $fruits = getData($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Fruits</title>
        <style><?php include '../CSS/base.css'?></style>
        <style><?php include '../CSS/PlaceOrder.css'?></style>
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
                <h2>All fruits</h2>

                <?php

                foreach($fruits as $values)
                {
                    echo '<h3>'.$values['food_item'].'</h3><br>';
                    echo '<img src = "../assets/'.$values['food_image'].'">';
                    echo '<p>Food ID: '.$values['foodID'].'</p>
                            <p>Price: '.$values['price'].'</p><br>';
                }
                ?>
                
                <form method = "POST" action = "admin_saveSettings.php">
                    <h2>Select Fruit to Edit</h2>
                    <label for = "search_fruit">Fruit Name: </label>
                    <input type = "text" name = "search_fruit" id = "search_fruit"><br><br>

                    <input type = "submit" value = "SEARCH" name = "SEARCH_FRUIT_TABLE" class = "button">
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