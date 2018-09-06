<?php
/**
 * Created by PhpStorm.
 * User: rashed
 * Date: 6/30/18
 * Time: 11:30 AM
 */
require_once '../../include/db.php';


if ($_POST){
    $input = file_get_contents("php://input");
    parse_str($input, $data);
    $result = ['error' => true];
    $sql = "UPDATE categories SET
                   name = :name,
                   status = :status WHERE id = :id";
    $st = $db->prepare($sql);
    $st->bindParam(':id', $data['id'], PDO::PARAM_INT);
    $st->bindParam(':name', $data['Category_name'], PDO::PARAM_STR);
    $st->bindParam(':status', $data['status'], PDO::PARAM_STR);
    try{
        $st->execute();
        $result['messages'] = "Successfully Updated";
        $result['id'] = $db->lastInsertId();
        $result['error'] = false;
    }
    catch (PDOException $e){
        $result['errorMessage'] = $st->errorInfo()[2];
    }

    $st = null;
    $db = null;

    print json_encode($result);
}