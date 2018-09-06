<?php
require_once '../../include/db.php';
function get_total_all_records($db)
{
    $statement = $db->prepare('SELECT * FROM categories');
    $statement->execute();
    return $statement->rowCount();
}

if(isset($_POST["crud_action"]))
{
    if($_POST["crud_action"] == 'fetch_all')
    {
        $query = '';

        $output = array();

        $order_column = array('name', 'status');

        $query .= "
   SELECT * FROM categories 
  ";

         if(isset($_POST["search"]["value"]))
         {
             $query .= 'WHERE name LIKE "%'.$_POST["search"]["value"].'%" ';
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

        $statement->execute();

        $result = $statement->fetchAll();

        $filtered_rows = $statement->rowCount();

        foreach($result as $row)
        {
            if($row['status'] == 1){
                $status = '<span class="label label-success">Active</span>';
            }else{
                $status = '<span class="label label-warning">Inactive</span>';
            }
            $sub_array = array();
            $sub_array[] = $row['id'];
            $sub_array[] = $row['name'];
            $sub_array[] = $status;
            $sub_array[] = '<button type="button" class="btn btn-default" onclick="editCategory('.$row['id'].')" data-toggle="modal" data-target="#editCategoryModal"><i class="fa fa-pencil"></i></button><button data-id="'.$row['id'].'" type="button" class="btn btn-default" onclick="removeCategory('.$row['id'].')" data-toggle="modal" data-target="#removeCategoryModal"><i class="fa fa-trash"></i></button>';
            $output[] = $sub_array;
        }

        $data = array(
            "draw"    => intval($_POST["draw"]),
            "recordsTotal"  => $filtered_rows,
            "recordsFiltered" => get_total_all_records($db),
            "data"    => $output
        );
    }
    echo json_encode($data);
}

?>