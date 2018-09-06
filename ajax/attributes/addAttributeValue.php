<?php
require_once '../../include/db.php';
if ($_POST){
    $input = file_get_contents("php://input");
    parse_str($input, $data);
    $result = ['error' => true];
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO attribute_value(value,attribute_parent_id) VALUES(:value,:attribute_parent_id)";
    $st = $db->prepare($sql);
    $st->bindParam(":value", $data['attribute_value'], PDO::PARAM_STR);
    $st->bindParam(":attribute_parent_id", $data['attribute_parent_id'], PDO::PARAM_STR);

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
