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
                <small>Orders</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Orders</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div id="messages"></div>
                    <?php
                    if(isset($_POST['add_orders'])){
                        // Insert Data DB
                        $customer_name = $_POST['customer_name'];
                        $customer_address = $_POST['customer_address'];
                        $customer_phone = $_POST['customer_phone'];

                        $product_id = $_POST['products'];
                        $qty = $_POST['qty'];
                        $rate = $_POST['rate'];
                        $amount = $_POST['amount'];

                        $gross_amount = $_POST['gross_amount'];
                        $service_charge_rate = $_POST['service_charge_value'];
                        $service_charge = $_POST['service_charge'];
                        $vat_charge_rate = $_POST['vat_charge_value'];
                        $vat_charge = $_POST['vat_charge'];
                        $net_amount = $_POST['net_amount'];
                        $discount = $_POST['discount'];
                        $paid_status = 1;
                        $date_time = date('Y-m-d H:i:s');
                        $user_id = 1;
                        // Rand Number
                        srand((double)microtime()*10000); 
						function gen_id() 
						{ 
						    $id = 'A'; 
						    for ($i=1; $i<=4; $i++) { 
						        if (rand(0,1)) { 
						            // letter 
						            $id .= chr(rand(65, 90)); 
						        } else { 
						            // number; 
						            $id .= rand(0, 9); 
						        } 
						    } 
						    return $id; 
						} 
						$bill_no = gen_id(); 
						$result = ['error' => true];
						$sql = "INSERT INTO orders ( bill_no, customer_name, customer_address, customer_phone, date_time, gross_amount, service_charge_rate, service_charge, vat_charge_rate, vat_charge, net_amount, discount, paid_status, user_id) VALUES ('$bill_no', '$customer_name', '$customer_address', '$customer_phone', '$date_time', '$gross_amount', '$service_charge_rate', '$service_charge', '$vat_charge_rate', '$vat_charge', '$net_amount', '$discount', '$paid_status', '$user_id')";

                        $st = $db->prepare($sql);
                        try{
                            $st->execute();
                            $result['error'] = false;
                            $result['messages'] = "Successfully Created";
                            $order_id = $db->lastInsertId();
                        }
                        catch (PDOException $e){
                            $result['messages'] = $st->errorInfo()[2];

                        }
                        // Insert Orderitem table
                        $sql = "INSERT INTO orders_item ( order_id, product_id, qty, rate, amount) VALUES ('$order_id', '$product_id', '$qty', '$rate', '$amount')";

                        $st = $db->prepare($sql);
                        try{
                            $st->execute();
                            $result['error'] = false;
                            $result['messages'] = "Successfully orders";
                            $result['id'] = $db->lastInsertId();
                        }
                        catch (PDOException $e){
                            $result['messages'] = $st->errorInfo()[2];

                        }
                    }else if(isset($_POST['update_orders'])){ ///update part
                        // update Data DB
                        $order_id = $_POST['order_id'];
                        $customer_name = $_POST['customer_name'];
                        $customer_address = $_POST['customer_address'];
                        $customer_phone = $_POST['customer_phone'];

                        $product_id = $_POST['products'];
                        $qty = $_POST['qty'];
                        $rate = $_POST['rate'];
                        $amount = $_POST['amount'];

                        $gross_amount = $_POST['gross_amount'];
                        $service_charge_rate = $_POST['service_charge_value'];
                        $service_charge = $_POST['service_charge'];
                        $vat_charge_rate = $_POST['vat_charge_value'];
                        $vat_charge = $_POST['vat_charge'];
                        $net_amount = $_POST['net_amount'];
                        $discount = $_POST['discount'];
                        $date_time = date('Y-m-d H:i:s');
                        $result = ['error' => true];
                        $sql = "UPDATE orders SET
                                      customer_name = '$customer_name',
                                      customer_address = '$customer_address',
                                      customer_phone = '$customer_phone',
                                      date_time = '$date_time',
                                      gross_amount = '$gross_amount',
                                      service_charge_rate = '$service_charge_rate',
                                      service_charge = '$service_charge', 
                                      vat_charge_rate = '$vat_charge_rate', 
                                      vat_charge = '$vat_charge', 
                                      net_amount = '$net_amount',
                                      discount = '$discount'
                                WHERE id = $order_id";
                        $st = $db->prepare($sql);
                        try{
                            $st->execute();
                            $result['error'] = false;
                            $result['messages'] = "Successfully orders";
                            $order_id = $db->lastInsertId();
                        }
                        catch (PDOException $e){
                            $result['messages'] = $st->errorInfo()[2];

                        }
                        // update Orderitem table
                        $sql = "UPDATE orders_item SET
                                      product_id = '$product_id',
                                      qty = '$qty',
                                      rate = '$rate',
                                      amount = '$amount'  
                                WHERE order_id = $order_id";
                        $st = $db->prepare($sql);
                        try{
                            $st->execute();
                            $result['error'] = false;
                            $result['messages'] = "Successfully orders_item";
                        }
                        catch (PDOException $e){
                            $result['messages'] = $st->errorInfo()[2];

                        }
                    }
                    ?>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Manage Orders</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="manageTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Bill No</th>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Date Time</th>
                                    <th>Total Amount</th>
                                    <th>Paid Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT * FROM orders ORDER BY id DESC";
                                $st = $db->prepare($sql);
                                $result = [];
                                try{
                                    $st->execute();
                                    $result = $st->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $results){
                                        if($results['paid_status'] == 1){
                                            $active = '<span class="label label-success">Paid</span>';
                                        }else{
                                            $active = '<span class="label label-warning">Unpaid</span>';
                                        }
                                        $html = '<tr id="'.$results['id'].'">
                                                    <td>'.$results['bill_no'].'</td>
                                                    <td>'.$results['customer_name'].'</td>
                                                    <td>'.$results['customer_address'].'</td>
                                                    <td>'.$results['customer_phone'].'</td>
                                                    <td>'.$results['date_time'].'</td>
                                                    <td>'.$results['net_amount'].'</td>
                                                    <td>'.$active.'</td>
                                                    <td>
                                                        <a target="_blank" href="print_order.php?id='.$results['id'].'" class="btn btn-default"><i class="fa fa-print"></i></a>
                                                        <a href="update_order.php?id='.$results['id'].'" class="btn btn-default"><i class="fa fa-pencil"></i></a> 
                                                        <button type="button" class="btn btn-default" onclick="removeFunc('.$results['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
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
            $("#mainOrdersNav").addClass('active');
            $("#manageOrdersNav").addClass('active');

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
                        url: "ajax/order/deleteOrder.php",
                        type: 'POST',
                        data: { 'order_id':id },
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