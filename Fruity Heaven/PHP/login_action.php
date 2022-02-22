<?php

$conn = new mysqli("localhost", "root", "");

if($conn -> connect_error)
{
    die("Not Connected".$conn -> connect_error);
}

else
{
    echo "Connected"."<br>";
}

session_start();

if(isset($_POST["login"]))
{
    if(empty($_POST["u_name"]) || empty($_POST["p_word"]))
    {
        header("location:login.php?error=Emptyinput");
        exit();
    }

    else
    {

        $_SESSION['shopping_cart'] = [];
        
        $sql = "Select * from fruity_heaven_db.user_details where username = '".$_POST['u_name']."' 
        and pass_word = '".$_POST['p_word']."'";
        $result = $conn -> query($sql) or die($conn->error);

        if($row = $result -> fetch_assoc())
        {
            $_SESSION['User'] = $_POST['u_name'];
            $_SESSION['First_Name'] = $row['first_name'];
            $_SESSION['Client_ID'] = $row['client_id'];
            $_SESSION['User_Type'] = $row['User_Type'];

            if($_SESSION['User_Type'] == "Admin")
            {
                header("location:admin_settings.php");
            }

            else
            {
                header("location:dashboard.php");
            }
            
        }
    }
}

if(isset($_GET['logOut']))
{
    header("location:login.php");
}

function retrieveData($username)
{
    global $conn;

    $sql = "Select * from fruity_heaven_db.user_details where username = '".$username."'";
    $result = $conn -> query($sql) or die($conn->error);
    

    if($row = $result -> fetch_assoc())
    {
        return $row;
    }

    else
    {
        echo "Not set";
    }
}

function saveChanges()
{
    global $conn;

    if(isset($_POST["save_details"]))
    {
        $user_id = $_SESSION['Client_ID'];
        $f_name = $_POST['f_name'];
        $s_name = $_POST['s_name'];
        $u_name = $_POST['u_name'];
        $p_word = $_POST['p_word'];
        $email_address = $_POST['email_address'];
        $phone_no = $_POST['phone_no'];
        $user_address = $_POST['user_address'];
        $date_of_birth = $_POST['date_of_birth'];
        $user_gender = $_POST['user_gender'];
        
        $sql = "UPDATE fruity_heaven_db.user_details SET first_name = '$f_name', second_name = '$s_name', username = '$u_name', 
        pass_word = '$p_word', email = '$email_address', phone_no = '$phone_no', user_address = '$user_address', 
        date_of_birth = '$date_of_birth', gender = '$user_gender' WHERE client_id = '$user_id';";

        if($conn -> query($sql) === TRUE)
        {
            echo "Query Executed";
        }

        else
        {
            echo "Error".$conn -> error;
        }
    }
}

function saveAdminUserChanges()
{
    global $conn;

    if(isset($_POST["admin_save_details"]))
    {
        $user_id = $_SESSION['edited_user_id'];
        $u_type = $_POST['user_type'];
        $f_name = $_POST['f_name'];
        $s_name = $_POST['s_name'];
        $u_name = $_POST['u_name'];
        $p_word = $_POST['p_word'];
        $email_address = $_POST['email_address'];
        $phone_no = $_POST['phone_no'];
        $user_address = $_POST['user_address'];
        $date_of_birth = $_POST['date_of_birth'];
        $user_gender = $_POST['user_gender'];
        
        $sql = "UPDATE fruity_heaven_db.user_details SET User_Type = '$u_type', first_name = '$f_name', second_name = '$s_name', username = '$u_name', 
        pass_word = '$p_word', email = '$email_address', phone_no = '$phone_no', user_address = '$user_address', 
        date_of_birth = '$date_of_birth', gender = '$user_gender' WHERE client_id = '$user_id';";

        if($conn -> query($sql) === TRUE)
        {
            echo "Query Executed";
            header("location:admin_settings.php");
        }

        else
        {
            echo "Error".$conn -> error;
        }
    }
}

function deleteUser()
{
    global $conn;

    if(isset($_POST["client_delete_details"]))
    {
        $sql_delete = "DELETE FROM fruity_heaven_db.user_details WHERE client_id = ".$_SESSION['Client_ID'].";";

        if($conn -> query($sql_delete) === TRUE)
        {
            echo "Query Executed";
        }

        else
        {
            echo "Error".$conn -> error;
        }
    }

    else if(isset($_POST["admin_delete_details"]))
    {
        $sql_delete = "DELETE FROM fruity_heaven_db.user_details WHERE client_id = ".$_SESSION['edited_user_id'].";";
        
        if($conn -> query($sql_delete) === TRUE)
        {
            echo "Query Executed";
        }

        else
        {
            echo "Error".$conn -> error;
        }
    }

    else
    {
        return;
    }
}

deleteUser();
saveChanges();
saveAdminUserChanges();    
?>