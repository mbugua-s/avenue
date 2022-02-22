<?php

function connect()
{
    $dbserver = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "fruity_heaven_db";

    $link = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname) or die ("Could not connect");
    return $link;
    
}

function getData($sql)
{
    $link = connect();
    $result = mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $rows[] = $row;
    }

    //echo "Data retrieved";
    return $rows;
}

function setData($sql)
{
    $link = connect();

    if(mysqli_query($link, $sql))
    {
        echo "Data set";
        return true;
    }

    else
    {
        echo "Error ".$link -> error;
        return false;
    }
}

   

?>