<?php
    require("fruityheaven_dbconnect.php");
    //require("login_action.php");
    //require("db_connect.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Fruity Heaven | Display Users</title>
        <style><?php include '../CSS/base.css'?></style>
        <style><?php include '../CSS/register.css'?></style>
        <style><?php include '../CSS/admin_displayUsers.css'?></style>
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

        <form method = "POST" action = "admin_editUsers.php">
            <fieldset>   
                <h3>List of Users</h3>
                <?php displayUsers(); ?> 
                <h2>Select user</h2>
                    <label for = "username">Username: </label>
                    <input type = "text" name = "user_name" id = "username"><br><br>

                    <input type = "submit" name = "search_user" value = "SELECT USER" class = "button">
            </fieldset>
        </form>

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