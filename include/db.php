<?php
/**
 * Created by PhpStorm.
 * User: Parvez Reza
 * Date: 7/2/2018
 * Time: 12:27 PM
 */

//$db = new PDO('mysql:host=localhost:dbname=inventory_new;charset=utf8', 'root', '');
//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


$servername = "localhost";
$username = "root";
$password = "";
$db = null;

try {
    $db = new PDO("mysql:host=$servername;dbname=inventory_new", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
