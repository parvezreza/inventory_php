<?php
/**
 * Created by PhpStorm.
 * User: rashed
 * Date: 6/30/18
 * Time: 11:30 AM
 */
require_once "db.php";

$request=$_REQUEST;
if ($request){
    $result = ['error' => true];
    /*$col =array(
        0   =>  'id',
        1   =>  'name',
        2   =>  'status',
    );  //create column like table in database

    $sql ="SELECT * FROM brands";
    $st = $db->prepare($sql);
    try{
        $st->execute();
        $totalData=$st->rowCount();
        $totalFilter=$totalData;
    }catch (PDOException $e){
        $result['errorMessage'] = $st->errorInfo()[2];
    }


//Search
    $sql ="SELECT * FROM brands WHERE 1=1";
    if(!empty($request['search']['value'])){
        $sql.=" AND (id Like '".$request['search']['value']."%' ";
        $sql.=" OR name Like '".$request['search']['value']."%' ";
        $sql.=" OR status Like '".$request['search']['value']."%' ";
    }
    $st = $db->prepare($sql);
    try{
        $st->execute();
        $totalData=$st->rowCount();
    }catch (PDOException $e){
        $result['errorMessage'] = $st->errorInfo()[2];
    }

//Order
    $sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
        $request['start']."  ,".$request['length']."  ";*/
    $sql ="SELECT * FROM brands";
    $data=array();
    $st = $db->prepare($sql);
    try{
        $st->execute();
        $totalData = $st->rowCount();
        $totalFilter=$totalData;
        $result = $st->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $results){
            $subdata=array();
            $subdata[]=$results['name'];
            $subdata[]=$results['active'];
            $data[]=$subdata;
        }
        $json_data=array(
            "draw"              =>  intval($request['draw']),
            "recordsTotal"      =>  intval($totalData),
            "recordsFiltered"   =>  intval($totalFilter),
            "data"              =>  $data
        );
        $result['error'] = false;
    }
    catch (PDOException $e){
        $result['errorMessage'] = $st->errorInfo()[2];
    }

    $st = null;
    $db = null;

    print json_encode($json_data);
}
