<?php

require("db_connect.php");
require("login_action.php");

if(isset($_POST["add_fruit"])) //submit button
{
    $file = $_FILES['add_photo'];

    $itemname = $_POST['fruit_name'];
    $price = $_POST['fruit_price'];
    $original_file_name = $_FILES['add_photo']['name'];
    $file_type = substr($original_file_name, strpos($original_file_name, '.'), strlen($original_file_name));

    $new_file_name = $itemname.$file_type;
    $file_tmp_location = $_FILES['add_photo']['tmp_name'];

    $file_path = "../assets/";
    
    if(move_uploaded_file($file_tmp_location, $file_path.$new_file_name))
    {
        $sql = "INSERT INTO fruity_heaven_db.food_items(foodID, food_item, food_image, price) VALUES (NULL, '$itemname', '$new_file_name', '$price');";

        setData($sql);
        header("location:admin_settings.php");
    }
}

if(isset($_POST['SEARCH_FRUIT_TABLE']))
{
    $search_fruit = $_POST['search_fruit'];
    $sql = "SELECT * FROM fruity_heaven_db.food_items WHERE food_item = '$search_fruit';";
    $_SESSION['edited_fruit'] = getData($sql);

    header("location:admin_editFruits.php");
}

if(isset($_POST['edit_fruit']))
{
    $id = $_SESSION['edited_fruit']['0']['foodID'];
    $itemname = $_POST['fruit_name'];
    $price = $_POST['fruit_price'];

    if($_FILES['add_new_photo'] !== NULL)
    {
        $file = $_FILES['add_new_photo'];       
        $original_file_name = $_FILES['add_new_photo']['name'];
        $file_type = substr($original_file_name, strpos($original_file_name, '.'), strlen($original_file_name));

        $new_file_name = $itemname.$file_type;
        $file_tmp_location = $_FILES['add_new_photo']['tmp_name'];

        $file_path = "../assets/";
        
        if(move_uploaded_file($file_tmp_location, $file_path.$new_file_name))
        {
            $sql = "UPDATE fruity_heaven_db.food_items SET food_item = '$itemname', food_image = '$new_file_name', price = '$price' WHERE foodID = '$id';";
            setData($sql);
            header("location:admin_settings.php");
        }
    }

    else
    {
        echo "Ye";
        $sql = "UPDATE fruity_heaven_db.food_items SET food_item = '$itemname', price = '$price' WHERE foodID = '$id';";
        setData($sql);
        header("location:admin_settings.php");
    }

    
}

if(isset($_POST['delete_fruit']))
{
    $id = $_SESSION['edited_fruit']['0']['foodID'];
    $sql = "DELETE FROM fruity_heaven_db.food_items WHERE foodID = '$id';";
    setData($sql);
}

?>