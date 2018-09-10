<?php
require_once 'include/header.php';
require_once 'include/db.php';
?>
    <!-- Left side column. contains the logo and sidebar -->
<?php require_once 'include/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Manage
                <small>Products</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Products</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div id="messages"></div>
                    <?php
                    if(isset($_POST['add_product'])){
                        $attributes = array();
                        $file_name = $_FILES['product_image']['name'];
                        $file_type = $_FILES['product_image']['type'];
                        $file_size = $_FILES['product_image']['size'];
                        $file_error = $_FILES['product_image']['error'];
                        $file_temporary_name = $_FILES['product_image']['tmp_name'];
                        //get file Extension
                        $file_extension = explode('.',$file_name);
                        $file_actual_extension = strtolower(end($file_extension));
                        //Allow to upload file in database
                        $allowed_extension = array('jpg','png','gif','jpeg');
                        //check file extension
                        if($file_name !=""){
                            if(in_array($file_actual_extension,$allowed_extension)){
                                //Any error during upload
                                if($file_error === 0){
                                    if($file_size < 8000000){
                                        // Unique file name given
                                        $new_file_name = uniqid('',true). "." . $file_actual_extension;
                                        $file_path = "assets/images/product_image/" . $new_file_name;
                                        move_uploaded_file($file_temporary_name,$file_path);
                                    } else {
                                        echo '<div id="messages"><div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong> Your file is large. </div></div>';
                                    }
                                } else  {
                                    echo '<div id="messages"><div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>File not upload Please try again. Error '.$file_error.'</div></div>';
                                }
                            }else {
                                echo '<div id="messages"><div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>This kind of file extension '.$file_actual_extension.' not allowed</div></div>';
                            }
                        }
                        // Insert Data DB
                        if(!$file_name){ // when photo are not selected
                            $file_path = "<p>You did not select a file to upload.</p>";
                        }
                        $product_name = $_POST['product_name'];
                        $sku = $_POST['sku'];
                        $price = $_POST['price'];
                        $qty = $_POST['qty'];
                        $description = $_POST['description'];
                        $attributes = $_POST['attributes_value_id'];
                        $attributes = json_encode($attributes);
                        $brands = $_POST['brands'];
                        $category = $_POST['category'];
                        $store = $_POST['store'];
                        $availability = $_POST['availability'];
                        $result = ['error' => true];
                        $date = date('Y-m-d H:i:s');
                        $sql = "INSERT INTO products(name,sku,price,qty,image,description,attribute_value_id,brand_id,category_id,store_id,status,created) VALUES('$product_name', '$sku', '$price', '$qty', '$file_path', '$description', '$attributes', '$brands', '$category', '$store', '$availability', '$date')";
                        //$sql = "INSERT INTO products(name,sku,price,qty,image,description,attribute_value_id,brand_id,category_id,store_id,status,created) VALUES(:name, :sku, :price, :qty, :image, :description, :attribute_value_id, :brand_id, :category_id, :store_id, :status, :created)";
                        $st = $db->prepare($sql);
                        /*$st->bindParam(":name", $product_name, PDO::PARAM_STR);
                        $st->bindParam(":sku", $sku, PDO::PARAM_STR);
                        $st->bindParam(":price", $price, PDO::PARAM_STR);
                        $st->bindParam(":qty", $qty, PDO::PARAM_STR);
                        $st->bindParam(":image", $file_path, PDO::PARAM_STR);
                        $st->bindParam(":description", $description, PDO::PARAM_STR);
                        $st->bindParam(":attribute_value_id", $attributes, PDO::PARAM_INT);
                        $st->bindParam(":brand_id", $brands, PDO::PARAM_INT);
                        $st->bindParam(":category_id", $category, PDO::PARAM_INT);
                        $st->bindParam(":store_id", $store, PDO::PARAM_INT);
                        $st->bindParam(":status", $availability, PDO::PARAM_INT);
                        $st->bindParam(":created", $date, PDO::PARAM_STR);*/
                        try{
                            $st->execute();
                            $result['error'] = false;
                            $result['messages'] = "Successfully Created";
                            $result['id'] = $db->lastInsertId();
                        }
                        catch (PDOException $e){
                            $result['messages'] = $st->errorInfo()[2];

                        }
                    }else if(isset($_POST['update_product'])){ ///update part
                        $attributes = array();
                        $file_name = $_FILES['product_image']['name'];
                        $file_type = $_FILES['product_image']['type'];
                        $file_size = $_FILES['product_image']['size'];
                        $file_error = $_FILES['product_image']['error'];
                        $file_temporary_name = $_FILES['product_image']['tmp_name'];
                        //get file Extension
                        $file_extension = explode('.',$file_name);
                        $file_actual_extension = strtolower(end($file_extension));
                        //Allow to upload file in database
                        $allowed_extension = array('jpg','png','gif','jpeg');
                        //check file extension
                    if($file_name !=""){
                        if(in_array($file_actual_extension,$allowed_extension)){
                            //Any error during upload
                            if($file_error === 0){
                                if($file_size < 8000000){
                                    // Unique file name given
                                    $new_file_name = uniqid('',true). "." . $file_actual_extension;
                                    $file_path = "assets/images/product_image/" . $new_file_name;
                                    move_uploaded_file($file_temporary_name,$file_path);
                                } else {
                                    echo '<div id="messages"><div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong> Your file is large. </div></div>';
                                }
                            } else  {
                                echo '<div id="messages"><div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>File not upload Please try again. Error '.$file_error.'</div></div>';
                            }
                        }else {
                            echo '<div id="messages"><div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>This kind of file extension '.$file_actual_extension.' not allowed</div></div>';
                        }
                    }
                        // Insert Data DB
                        $product_id = $_POST['product_id'];
                        $product_name = $_POST['product_name'];
                        $sku = $_POST['sku'];
                        $price = $_POST['price'];
                        $qty = $_POST['qty'];
                        $description = $_POST['description'];
                        $attributes = $_POST['attributes_value_id'];
                        $attributes = json_encode($attributes);
                        $brands = $_POST['brands'];
                        $category = $_POST['category'];
                        $store = $_POST['store'];
                        $availability = $_POST['availability'];
                        $result = ['error' => true];
                        $date = date('Y-m-d H:i:s');
                        if($file_name !=""){ // when photo are not selected
                            $sql = "UPDATE products SET
                                      name = '$product_name',
                                      sku = '$sku',
                                      price = '$price',
                                      qty = '$qty',
                                      image = '$file_path',
                                      description = '$description',
                                      attribute_value_id = '$attributes',
                                      brand_id = '$brands', 
                                      category_id = '$category', 
                                      store_id = '$store', 
                                      status = '$availability'
                                WHERE id = $product_id";
                            $st = $db->prepare($sql);
                           /* $st->bindParam(":id", $product_id, PDO::PARAM_INT);
                            $st->bindParam(":name", $product_name, PDO::PARAM_STR);
                            $st->bindParam(":sku", $sku, PDO::PARAM_STR);
                            $st->bindParam(":price", $price, PDO::PARAM_STR);
                            $st->bindParam(":qty", $qty, PDO::PARAM_STR);
                            $st->bindParam(":image", $file_path, PDO::PARAM_STR);
                            $st->bindParam(":description", $description, PDO::PARAM_STR);
                            $st->bindParam(":attribute_value_id", $attributes, PDO::PARAM_INT);
                            $st->bindParam(":brand_id", $brands, PDO::PARAM_INT);
                            $st->bindParam(":category_id", $category, PDO::PARAM_INT);
                            $st->bindParam(":store_id", $store, PDO::PARAM_INT);
                            $st->bindParam(":status", $availability, PDO::PARAM_INT);*/
                        }else{
                            $sql = "UPDATE products SET
                                      name = '$product_name',
                                      sku = '$sku',
                                      price = '$price',
                                      qty = '$qty',
                                      description = '$description',
                                      attribute_value_id = '$attributes',
                                      brand_id = '$brands', 
                                      category_id = '$category', 
                                      store_id = '$store', 
                                      status = '$availability'
                                WHERE id = $product_id";
                            $st = $db->prepare($sql);
                            /*$st->bindParam(":id", $product_id, PDO::PARAM_INT);
                            $st->bindParam(":name", $product_name, PDO::PARAM_STR);
                            $st->bindParam(":sku", $sku, PDO::PARAM_STR);
                            $st->bindParam(":price", $price, PDO::PARAM_STR);
                            $st->bindParam(":qty", $qty, PDO::PARAM_STR);
                            $st->bindParam(":description", $description, PDO::PARAM_STR);
                            $st->bindParam(":attribute_value_id", $attributes, PDO::PARAM_INT);
                            $st->bindParam(":brand_id", $brands, PDO::PARAM_INT);
                            $st->bindParam(":category_id", $category, PDO::PARAM_INT);
                            $st->bindParam(":store_id", $store, PDO::PARAM_INT);
                            $st->bindParam(":status", $availability, PDO::PARAM_INT);*/
                        }

                        try{
                            $st->execute();
                            $result['error'] = false;
                            $result['messages'] = "Successfully Created";
                            $result['id'] = $db->lastInsertId();
                        }
                        catch (PDOException $e){
                            $result['messages'] = $st->errorInfo()[2];

                        }
                    }
                    ?>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Manage Products</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="manageTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>SKU</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Store</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT products.id as pID,products.name as pName,products.sku as pSKU, products.image as pIMG, products.price as pPrice, products.qty as pQty,products.status as pStatus,stores.name as sName FROM products
                                        LEFT JOIN stores ON products.store_id = stores.id
                                        ORDER BY products.id DESC
                                        ";
                                $st = $db->prepare($sql);
                                $result = [];
                                try{
                                    $st->execute();
                                    $result = $st->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $results){
                                        if($results['pStatus'] == 1){
                                            $active = '<span class="label label-success">Active</span>';
                                        }else{
                                            $active = '<span class="label label-warning">Inactive</span>';
                                        }
                                        $html = '<tr id="'.$results['pID'].'">
                                                    <td><img src="'.$results['pIMG'].'" alt="'.$results['pName'].'" class="img-circle" width="50" height="50"></td>
                                                    <td>'.$results['pSKU'].'</td>
                                                    <td>'.$results['pName'].'</td>
                                                    <td>'.$results['pPrice'].'</td>
                                                    <td>'.$results['pQty'].'</td>
                                                    <td>'.$results['sName'].'</td>
                                                    <td>'.$active.'</td>
                                                    <td>
                                                        <a href="update_product.php?id='.$results['pID'].'" class="btn btn-default"><i class="fa fa-pencil"></i></a> 
                                                        <button type="button" class="btn btn-default" onclick="removeFunc('.$results['pID'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                 </tr>';
                                        echo $html;
                                    }
                                }catch (PDOException $e){
                                    $e->getMessage();
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- col-md-12 -->
            </div>
            <!-- /.row -->


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Remove Product</h4>
                </div>

                <form role="form"  method="post" id="removeForm">
                    <div class="modal-body">
                        <p>Do you really want to remove?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/javascript">
        var manageTable;
        $(document).ready(function() {
            $("#mainProductNav").addClass('active');
            $("#manageProductNav").addClass('active');

            // initialize the datatable
            var manageTable = $('#manageTable').DataTable();

        });

        // remove functions
        function removeFunc(id)
        {
            if(id) {
                $("#removeForm").on('submit', function() {
                    // remove the text-danger
                    $(".text-danger").remove();
                    $.ajax({
                        url: "ajax/products/deleteProduct.php",
                        type: 'POST',
                        data: { 'product_id':id },
                        success:function(data, status) {
                            var response = JSON.parse(data)
                            if(!response.error) {
                                $('#manageTable tr[id="'+ id +'"]').remove();
                                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                    '</div>');

                                // hide the modal
                                $("#removeModal").modal('hide');
                                // remove td data
                                // $this.remove();
                            } else {

                                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                                    '</div>');
                            }
                        }
                    });
                    return false;
                });
            }
        }
    </script>
<?php require_once 'include/footer.php'; ?>