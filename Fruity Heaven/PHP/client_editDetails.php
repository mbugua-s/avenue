<?php
    require("login_action.php");

    $data = retrieveData($_SESSION['User']);
    $fname = $data['first_name'];
    $sname = $data['second_name'];
    $uname = $data['username'];
    $pword = $data['pass_word'];
    $email = $data['email'];
    $phoneno = $data['phone_no'];
    $address = $data['user_address'];
    $dob = $data['date_of_birth'];
    $gender = $data['gender'];


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Fruity Heaven | Edit Details</title>
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
            <h2>Edit your profile details</h2>

            <form method = "POST" action = "login_action.php">
                <fieldset>
                    <legend: Registration Page></legend:>

                    <div class = "textboxes">
                        <label for = "Fname">First Name: </label>
                        <?php echo '<input type = "name" id = "FName" name = "f_name" value = '.$fname.' ><br><br><br>';?>

                        <label for = "SName">Second Name: </label>
                        <?php echo '<input type = "name" id = "SName" name = "s_name" value = '.$sname.' ><br><br><br>';?>

                        <label for = "UName">Username: </label>
                        <?php echo '<input type = "name" id = "UName" name = "u_name" value = '.$uname.'><br><br><br>';?>

                        <label for = "PWord">Password: </label>
                        <?php echo '<input type = "password" id = "PWord" name = "p_word" value = '.$pword.'><br><br><br>';?>

                        <label for = "email">E-Mail Address: </label>
                        <?php echo '<input type = "mail" id = "email" name = "email_address" value = '.$email.'><br><br><br>';?>

                        <label for = "phone">Phone Number: </label>
                        <?php echo '<input type = "number" id = "phone" name = "phone_no" value = "0'.$phoneno.'"><br><br><br>';?>

                        <label for = "Address">Address: </label>
                        <?php echo '<input type = "text" id = "Address" name = "user_address" value = '.$address.'><br><br><br>';?>

                        <label for = "dob">Date of Birth: </label>
                        <?php echo '<input type = "date" id = "dob" min = "1980-01-01" max = "2021-01-01" name = "date_of_birth" value = '.$dob.'><br><br><br>';?>

                    </div>
                    

                    <div class = "radio">
                        <label for = "male">Male: </label>                       
                        <?php
                        $checked;

                        if($gender == "male")
                        {
                            $checked = ' checked = "checked"';
                        }

                        else
                        {
                            $checked = "";
                        }

                        echo '<input type = "radio" id = "male" name = "user_gender" value = "male"'.$checked.'>';
                        
                        ?>

                        <label for = "female">Female: </label>

                        <?php
                        $checked;

                        if($gender == "female")
                        {
                            $checked = ' checked = "checked"';
                        }

                        else
                        {
                            $checked = "";
                        }

                        echo '<input type = "radio" id = "female" name = "user_gender" value = "female"'.$checked.'>';                       
                        ?>
                    </div>
                    

                    <input type = "submit" name = "save_details" id = "save_details" value = "SAVE" class = "button">
                    <input type = "reset" name = "reset" id = "reset_details" value = "RESET" class = "button"><br>
                    <input type = "submit" name = "client_delete_details" id = "client_delete_details" value = "DELETE PROFILE" class = "delete_button">

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
   saveChanges(); 
?>