<?php

require("login_action.php");
require("db_connect.php");

function IDtoName($id)
{
    $sql_retrieve_fruit_data = "SELECT * from fruity_heaven_db.food_items;";
    $fruit_data = getData($sql_retrieve_fruit_data);

    foreach($fruit_data as $arr_key => $arr_val)
    {
        if($fruit_data[$arr_key]['foodID'] == $id)
        {
            return $fruit_data[$arr_key]['food_item'];
        }
    }
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Fruity Heaven | Order History</title>
        <style><?php include '../CSS/base.css'?></style>
        <style><?php include '../CSS/register.css'?></style>
        <style><?php include '../CSS/admin_displayUsers.css'?></style>
        <style><?php include '../CSS/client_processOrder.css'?></style>
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
            <h2>All Orders</h2>
            <fieldset>
                <?php
                $id = $_SESSION['Client_ID'];
                $sql_select = "SELECT orders.Order_Date, order_items.Fruit_1, order_items.Fruit_2, order_items.Nuts_Seeds_Spices, order_items.Quantity, 
                order_items.Thickness, order_items.Extras FROM order_items JOIN orders ON order_items.Order_ID = orders.Order_ID 
                JOIN user_details ON orders.client_id = user_details.client_id;";
                $order_data = getData($sql_select);
                ?>

                <br><br><br><table>
                    <thead>    
                        <tr>
                            <th>Order Date</th>
                            <th>Fruit 1</th>
                            <th>Fruit 2</th>
                            <th>Nuts, Seeds and Spices</th>
                            <th>Quantity</th>
                            <th>Thickness</th>
                            <th>Extras</th>
                        </tr>
                    </thead>
                        <?php
                        foreach($order_data as $key => $value)
                        {
                            $order_data[$key]['Fruit_1'] = IDtoName($order_data[$key]['Fruit_1']);
                            $order_data[$key]['Fruit_2'] = IDtoName($order_data[$key]['Fruit_2']);
                            
                            echo '<tr>
                            <td>'.$order_data[$key]["Order_Date"].'</td>
                            <td>'.$order_data[$key]["Fruit_1"].'</td>
                            <td>'.$order_data[$key]["Fruit_2"].'</td>
                            <td>'.$order_data[$key]["Nuts_Seeds_Spices"].'</td>
                            <td>'.$order_data[$key]["Quantity"].'</td>
                            <td>'.$order_data[$key]["Thickness"].'</td>
                            <td>'.$order_data[$key]["Extras"].'</td>
                        </tr>';
                        }
                        ?>
                </table>         
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