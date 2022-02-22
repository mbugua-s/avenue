<?php

require("login_action.php");

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Fruity Heaven | Dashboard</title>
        <style><?php include '../CSS/base.css'?></style>
        <style><?php include '../CSS/dashboard.css'?></style>
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

        <body>
            <h2 class = "title">Home</h2>
            <fieldset>
                <h2>Offers!</h2>

                    <h3>3 for 2!</h3>
                    <img src = "../Images/three_juices.jpg">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestiae nisi consequuntur corporis ad voluptate ex officiis,
                        fugiat culpa ratione quos similique distinctio quae neque illum ut ipsum, labore nulla cum.</p>

                    <h3>Pineapple 50% off!</h3>
                    <img src = "../Images/pineapple.jpg">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestiae nisi consequuntur corporis ad voluptate ex officiis,
                        fugiat culpa ratione quos similique distinctio quae neque illum ut ipsum, labore nulla cum.</p><br><br>
                    <a href =  "place_order.php" class = "button">Order Now!</a><br><br><br><br>

                <h2>This week's special</h2>
                    <h3>Traffic Light Smoothie</h3>
                    <img src = "../Images/traffic_light_smoothie.jpg">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestiae nisi consequuntur corporis ad voluptate ex officiis,
                        fugiat culpa ratione quos similique distinctio quae neque illum ut ipsum, labore nulla cum.</p><br><br>
                    <a href = "place_order.php" class = "button">Try It Now!</a><br><br><br><br>

                <h2>News</h2>
                    <h3>More delivery locations</h3>
                    <img src = "../Images/delivery.png">  
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestiae nisi consequuntur corporis ad voluptate ex officiis,
                        fugiat culpa ratione quos similique distinctio quae neque illum ut ipsum, labore nulla cum.</p>

                    <h3>Temporary removal of avocado</h3>
                    <img src = "../Images/avocado.jpg">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestiae nisi consequuntur corporis ad voluptate ex officiis,
                        fugiat culpa ratione quos similique distinctio quae neque illum ut ipsum, labore nulla cum.</p>
            </fieldset>
            

        </body>

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


