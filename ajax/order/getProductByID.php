<?php
/**
 * Created by PhpStorm.
 * User: Parvez Reza
 * Date: 6/30/18
 * Time: 11:30 AM
 */
require_once '../../include/db.php';


if ($_POST){
    $input = file_get_contents("php://input");
    parse_str($input, $data);
    $result = ['error' => true];
    //$data = $_GET['id'];
    $id = $data['product_id'];
    $sql = "SELECT * FROM products WHERE id = $id";
    $sql = "SELECT p.name,p.price,p.image,c.service_charge_value,c.vat_charge_value FROM products as p,company as c WHERE p.id = $id";
    $st = $db->prepare($sql);
   // $st->bindParam(':id', $data['product_id'], PDO::PARAM_INT);
    try{
        $st->execute();
        $result['products'] = $st->fetchAll();
        $result['error'] = false;
    }
    catch (PDOException $e){
        $result['errorMessage'] = $st->errorInfo()[2];
    }

    $st = null;
    $db = null;

    print json_encode($result);
}