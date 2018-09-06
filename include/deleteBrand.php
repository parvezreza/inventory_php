<?php
/**
 * Created by PhpStorm.
 * User: rashed
 * Date: 6/30/18
 * Time: 11:30 AM
 */
require_once "db.php";


if ($_POST){
    $input = file_get_contents("php://input");
    parse_str($input, $data);
    $result = ['error' => true];

    $sql = "DELETE FROM brands WHERE id = :id";
    $st = $db->prepare($sql);
    $st->bindParam(':id', $data['brand_id'], PDO::PARAM_INT);
    try{
        $st->execute();
        $result['error'] = false;
        $result['messages'] = "Successfully removed";
        $result['id'] = $db->lastInsertId();
    }
    catch (PDOException $e){
        $result['errorMessage'] = $st->errorInfo()[2];
    }

    $st = null;
    $db = null;

    print json_encode($result);
}
