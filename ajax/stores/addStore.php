<?php
require_once '../../include/db.php';
if ($_POST){
    $input = file_get_contents("php://input");
    parse_str($input, $data);
    $result = ['error' => true];
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO stores(name,status) VALUES(:name, :status)";
    $st = $db->prepare($sql);
    $st->bindParam(":name", $data['stores_name'], PDO::PARAM_STR);
    $st->bindParam(":status", $data['status'], PDO::PARAM_STR);

    try{
        $st->execute();
        $result['error'] = false;
        $result['messages'] = "Successfully Created";
        $result['id'] = $db->lastInsertId();
    }
    catch (PDOException $e){
        $result['messages'] = $st->errorInfo()[2];
    }

    $st = null;
    $db = null;

    print json_encode($result);
}
?>
