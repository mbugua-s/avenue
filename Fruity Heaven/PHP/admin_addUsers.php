<!DOCTYPE html>

<?php
    require("login_action.php");
    require("db_connect.php");
        
    $conn = new mysqli("localhost", "root", "");

    if($conn -> connect_error)
    {
        die("Not Connected".$conn -> connect_error);
    }

    else
    {
        echo "Connected"."<br>";
    }
?>

<html>
    <head>
        <title>Fruity Heaven | Add Users</title>
        <style><?php include '../CSS/base.css'?></style>
        <style><?php include '../CSS/register.css'?></style>

        
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
        
        <div id = main>
            <h2>Create a new account</h2>

            <form method = "POST" action = "fruityheaven_dbconnect.php">
                <fieldset>
                    <legend: Registration Page></legend:>

                    <div class = "textboxes">
                        <label for = "Fname">First Name: </label>
                        <input type = "name" id = "FName" name = "f_name"><br><br><br>

                        <label for = "SName">Second Name: </label>
                        <input type = "name" id = "SName" name = "s_name"><br><br><br>

                        <label for = "UName">Username: </label>
                        <input type = "name" id = "UName" name = "u_name"><br><br><br>

                        <label for = "PWord">Password: </label>
                        <input type = "password" id = "PWord" name = "p_word"><br><br><br>

                        <label for = "email">E-Mail Address: </label>
                        <input type = "mail" id = "email" name = "email_address"><br><br><br>

                        <label for = "phone">Phone Number: </label>
                        <input type = "number" id = "phone" name = "phone_no"><br><br><br>

                        <label for = "Address">Address: </label>
                        <input type = "text" id = "Address" name = "user_address"><br><br><br>

                        <label for = "dob">Date of Birth: </label>
                        <input type = "date" id = "dob" min = "1980-01-01" max = "2021-01-01" name = "date_of_birth"><br><br><br>

                    </div>
                    
                    <h3>Gender</h3>
                    <div class = "radio">
                        <label for = "male">Male: </label>
                        <input type = "radio" id = "male" name = "user_gender" value = "male">

                        <label for = "female">Female: </label>
                        <input type = "radio" id = "female" name = "user_gender" value = "female"><br><br><br>
                    </div>

                    <h3>User Type</h3>
                    <div class = "radio">
                        <label for = "Admin">Admin: </label>
                        <input type = "radio" id = "Admin" name = "user_type" value = "Admin">

                        <label for = "Chef">Chef: </label>
                        <input type = "radio" id = "Chef" name = "user_type" value = "Chef">

                        <label for = "Client">Client: </label>
                        <input type = "radio" id = "Client" name = "user_type" value = "Client"><br><br><br>
                    
                    </div>
                    <input type = "submit" name = "register_special" id = "register_details" value = "REGISTER" class = "button">
                    <input type = "reset" name = "reset" id = "reset_details" value = "RESET" class = "button">


                </fieldset>

                
            </form>
        </div>

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