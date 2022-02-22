<?php

require("login_action.php");

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Fruity Heaven | Admin Settings</title>

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
            <h2>Admin Settings</h2>
            <form method = "POST" action = "admin_saveSettings.php" enctype = "multipart/form-data">
                <fieldset>
                    <h3>Manage Users</h3>
                    <a class = "_button" href = "admin_addUsers.php" >Add Users</a><br><br>
                    <a class = "_button" href = "admin_displayUsers.php">Edit or Delete User Details</a><br><br>

                    <h3>Fruits</h3>
                    <h4>Add Fruits</h4>
                    <label for = "add_fruits">Add Fruit: </label>
                    <input type = "text" id = "add_fruits" name = "fruit_name"><br><br>

                    <label for = "add_photo">Upload fruit image : </label>
                    <input type = "file" id = "add_photo" name = "add_photo" class = "upload_button"><br><br>

                    <label for = "fruit_price">Price: </label>
                    <input type = "number" name = "fruit_price" id = "fruit_price"><br>

                    <input type = "submit" name = "add_fruit" value = "ADD FRUIT" class = "button"><br><br>
                    
                    <h4>Edit and Remove Fruits</h4>
                    <a class = "_button" href = "admin_viewFruits.php">View Fruits</a><br><br>

                    <h3>Order History</h3>
                    <a class = "_button" href = "admin_viewOrders.php">View Orders</a><br><br>
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
