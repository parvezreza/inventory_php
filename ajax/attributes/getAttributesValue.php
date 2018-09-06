<?php
require_once '../../include/db.php';
$id = $_GET['id'];
function get_total_all_records($db,$id)
{
    $statement = $db->prepare('SELECT * FROM attribute_value WHERE attribute_parent_id = :attribute_parent_id');
    $statement->bindParam(':attribute_parent_id', $id, PDO::PARAM_INT);
    $statement->execute();
    return $statement->rowCount();
}

if(isset($_POST["crud_action"]))
{
    if($_POST["crud_action"] == 'fetch_all')
    {
        $query = '';

        $output = array();

        $order_column = array('value');

        $query .= "
   SELECT * FROM attribute_value 
  ";
       if(isset($_POST["search"]["value"])) {
             $query .= 'WHERE attribute_parent_id = :attribute_parent_id && value LIKE "%'.$_POST["search"]["value"].'%" ';
       }
       if(isset($_POST["order"]))
         {
             $query .= 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
         }
         else
         {
             $query .= 'ORDER BY id DESC ';
         }

         if($_POST["length"] != -1)
         {
             $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
         }

        $statement = $db->prepare($query);
        $statement->bindParam(':attribute_parent_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetchAll();

        $filtered_rows = $statement->rowCount();

        foreach($result as $row)
        {

            $sub_array = array();
            $sub_array[] = $row['id'];
            $sub_array[] = $row['value'];
            $sub_array[] = '<button type="button" class="btn btn-default" onclick="editValue('.$row['id'].')" data-toggle="modal" data-target="#editValueModal"><i class="fa fa-pencil"></i></button><button data-id="'.$row['id'].'" type="button" class="btn btn-default" onclick="removeValue('.$row['id'].')" data-toggle="modal" data-target="#removeValueModal"><i class="fa fa-trash"></i></button>';
            $output[] = $sub_array;
        }

        $data = array(
            "draw"    => intval($_POST["draw"]),
            "recordsTotal"  => $filtered_rows,
            "recordsFiltered" => get_total_all_records($db,$id),
            "data"    => $output
        );
    }
    echo json_encode($data);
}

?>