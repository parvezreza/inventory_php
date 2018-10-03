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

    $sql = "DELETE FROM stores WHERE id = :id";
    $st = $db->prepare($sql);
    $st->bindParam(':id', $data['stores_id'], PDO::PARAM_INT);
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
