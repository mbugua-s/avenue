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

function registerClientUser()
{
    global $conn;
    
    if(isset($_POST["register_client"]))
    {
        $user_type = "Client";
        $fname = $_POST["f_name"];
        $sname = $_POST["s_name"];
        $uname = $_POST["u_name"];
        $pword = $_POST["p_word"];
        $email = $_POST["email_address"];
        $phoneno = $_POST["phone_no"];
        $address = $_POST["user_address"];
        $dob = $_POST["date_of_birth"];
        $gender = $_POST["user_gender"];

        $sql = "INSERT INTO fruity_heaven_db.user_details(client_id, User_Type, first_name, second_name, username, pass_word, email, phone_no, user_address, date_of_birth, gender) 
        VALUES (NULL, '$user_type', '$fname', '$sname', '$uname', '$pword', '$email', '$phoneno', '$address', '$dob', '$gender');";
        
        if($conn -> query($sql) === TRUE)
        {   
            $_SESSION['User'] = $_POST['u_name'];

            $sql_get_inserted_data = "SELECT * FROM user_details WHERE username = '".$_SESSION['User']."';";
            $getData = getData($sql_get_inserted_data);

            $_SESSION['First_Name'] = $getData['0']['first_name'];
            $_SESSION['Client_ID'] = $getData['0']['client_id'];
            $_SESSION['User_Type'] = $getData['0']['User_Type'];  

            echo $_SESSION['First_Name'];
            
            header("location:dashboard.php");
        }

        else
        {
            echo "Error".$conn -> error;
        }

    }
}

function registerSpecialUser()
{
    global $conn;
    
    if(isset($_POST["register_special"]))
    {
        $user_type = $_POST["user_type"];
        $fname = $_POST["f_name"];
        $sname = $_POST["s_name"];
        $uname = $_POST["u_name"];
        $pword = $_POST["p_word"];
        $email = $_POST["email_address"];
        $phoneno = $_POST["phone_no"];
        $address = $_POST["user_address"];
        $dob = $_POST["date_of_birth"];
        $gender = $_POST["user_gender"];

        $sql = "INSERT INTO fruity_heaven_db.user_details(client_id, User_Type, first_name, second_name, username, pass_word, email, phone_no, user_address, date_of_birth, gender) VALUES
        (NULL, '$user_type', '$fname', '$sname', '$uname', '$pword', '$email', '$phoneno', '$address', '$dob', '$gender');";

        if($conn -> query($sql) === TRUE)
        {
            header("location:admin_settings.php");
        }

        else
        {
            echo "Error".$conn -> error;
        }
    }
}

registerClientUser();
registerSpecialUser();

function DisplayUsers()
{
    global $conn;
    
    $sql_select = "SELECT * FROM fruity_heaven_db.user_details";

    $results = $conn -> query($sql_select);

    if($results -> num_rows > 0)
    {
        echo '<div class = "table"> <table border = "1">
            <thead>    
                <tr>
                    <th>CustomerID</th>
                    <th>User Type</th>
                    <th>First_Name</th>
                    <th>Second_Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Phone_No</th>
                    <th>User Address</th>
                    <th>DOB</th>
                    <th>Gender</th>
                </tr>
            </thead>';

        while($row = $results -> fetch_assoc())
        {
            $rows[] = $row;
            echo '<tr>
                        <td>'.$row["client_id"].'</td>
                        <td>'.$row["User_Type"].'</td>
                        <td>'.$row["first_name"].'</td>
                        <td>'.$row["second_name"].'</td>
                        <td>'.$row["username"].'</td>
                        <td>'.$row["pass_word"].'</td>
                        <td>'.$row["email"].'</td>
                        <td>'.$row["phone_no"].'</td>
                        <td>'.$row["user_address"].'</td>
                        <td>'.$row["date_of_birth"].'</td>
                        <td>'.$row["gender"].'</td>
                    </tr>';

        }

        echo "</table></div>";
    }

}


?>

