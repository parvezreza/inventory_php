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
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add Order</h3>
                        </div>
                        <!-- /.box-header -->
                        <?php
                        $id = @$_GET["id"];
                        $sql = "SELECT *,products.image AS img,orders_item.qty AS order_qty FROM orders
                                              LEFT JOIN orders_item ON orders.id = orders_item.order_id
                                              LEFT JOIN products ON  orders_item.product_id = products.id
                                              WHERE orders.id = $id";
                        $st = $db->prepare($sql);
                        $order_results = [];
                        try{
                            $st->execute();
                            $order_results = $st->fetch();
                            //echo $order_results['rate'];
                        }catch (PDOException $e){
                            $e->getMessage();
                        }
                        ?>
                        <form role="form" action="orders.php" method="post" class="form-horizontal">
                            <input type="hidden" name="order_id" value="<?php echo $order_results['order_id']?>">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="gross_amount" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?></label>
                                </div>
                                <div class="form-group">
                                    <label for="gross_amount" class="col-sm-12 control-label">Date: <?php echo date('h:i a') ?></label>
                                </div>

                                <div class="col-md-4 col-xs-12 pull pull-left">

                                    <div class="form-group">
                                        <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Name</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" value="<?php echo $order_results['customer_name']; ?>" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Address</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Enter Customer Address" value="<?php echo $order_results['customer_address']; ?>" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Phone</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Customer Phone" value="<?php echo $order_results['customer_phone']; ?>" autocomplete="off">
                                        </div>
                                    </div>
                                </div>


                                <br /> <br/>
                                <table class="table table-bordered" id="product_info_table">
                                    <thead>
                                    <tr>
                                        <th style="width:50%">Product</th>
                                        <th style="width:10%">Qty</th>
                                        <th style="width:10%">Rate</th>
                                        <th style="width:20%">Amount</th>
                                        <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr id="row_1">
                                        <td>
                                            <select class="form-control select_group products" data-row-id="row_1" id="product_1" name="products" style="width:100%;" required>
                                                <?php
                                                $sql = "SELECT * FROM products";
                                                $st = $db->prepare($sql);
                                                $result = [];
                                                try{
                                                    $st->execute();
                                                    $result = $st->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result as $results){ ?>
                                                        <option value="<?php echo $results['id'] ?>" <?php if($order_results['product_id'] == $results['id']) echo "selected" ?>><?php echo $results['name'] ?></option>
                                                <?php  }
                                                }catch (PDOException $e){
                                                    $e->getMessage();
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="qty" id="qty_1" class="form-control" value="<?php echo $order_results['order_qty']; ?>" required"></td>
                                        <td>
                                            <input type="text" name="rate" id="rate_1" class="form-control" readonly value="<?php echo $order_results['rate']; ?>" autocomplete="off">
                                            <input type="hidden" name="rate_value" id="rate_value_1" class="form-control" autocomplete="off">
                                        </td>
                                        <td>
                                            <input type="text" name="amount" id="amount_1" class="form-control" value="<?php echo $order_results['amount']; ?>" readonly autocomplete="off">
                                            <input type="hidden" name="amount_value" id="amount_value_1" class="form-control" autocomplete="off">
                                        </td>
                                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <br /> <br/>
                                <div class="col-md-6 col-xs-12 pull pull-left">
                                    <div class="form-group" id="product_photo_group" >
                                        <label for="">Product Photo</label>
                                        <img id="product_photo" src="<?php echo $order_results['img']; ?>" width="300"  class="img-circle1" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 pull pull-right">
                                    <?php
                                    $CompanySQL = "SELECT * FROM company";
                                    $st = $db->prepare($CompanySQL);
                                    $comResult = [];
                                    try{
                                        $st->execute();
                                        $comResult = $st->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($comResult as $comResults){

                                        }
                                    }catch (PDOException $e){
                                        $e->getMessage();
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="gross_amount" name="gross_amount" value="<?php echo $order_results['amount']; ?>" readonly autocomplete="off">
                                            <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" autocomplete="off">
                                        </div>
                                    </div>
                                    <?php //if($is_service_enabled == true): ?>
                                        <div class="form-group">
                                            <label for="service_charge" class="col-sm-5 control-label">S-Charge <?php echo $comResults['service_charge_value'] ?> %</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="service_charge" name="service_charge" value="<?php echo $order_results['service_charge']; ?>"  readonly autocomplete="off">
                                                <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" value="<?php echo $order_results['service_charge_rate']; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                    <?php //endif; ?>
                                    <?php //if($is_vat_enabled == true): ?>
                                        <div class="form-group">
                                            <label for="vat_charge" class="col-sm-5 control-label">Vat <?php echo $comResults['vat_charge_value'] ?> %</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="vat_charge" name="vat_charge" value="<?php echo $order_results['vat_charge']; ?>" readonly autocomplete="off">
                                                <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" value="<?php echo $order_results['vat_charge_rate']; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                    <?php //endif; ?>
                                    <div class="form-group">
                                        <label for="discount" class="col-sm-5 control-label">Discount</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" value="<?php echo $order_results['discount']; ?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="net_amount" name="net_amount" value="<?php echo $order_results['net_amount']; ?>" readonly autocomplete="off">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
                                <button name="update_orders" type="submit" class="btn btn-primary">Create Order</button>
                                <a href="orders.php" class="btn btn-warning">Back</a>
                            </div>
                        </form>
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

    <script type="text/javascript">
        $(document).ready(function(){
            $("#mainOrdersNav").addClass('active');
            $("#addOrderNav").addClass('active');
            $('select.products').select2();
            $('select.products').on('change', function() {
               // alert( this.value );
                var product_id = $(this).val();
                //alert(product_id);
                $.ajax({
                    url: "ajax/order/GetProductByID.php",
                    type: "POST",
                    data: {"product_id": product_id},
                    success: function (data, status) {
                        var response = JSON.parse(data);
                        if(response.error == false) {
                             for(var i=0; i < response.products.length; i++){
                                $("#qty_1").val(1);
                                $("#rate_1").val(response.products[i].price);
                                $("#product_photo_group").css({"display" : "block"});
                                $("#product_photo").attr("src",response.products[i].image);
                                $("#product_photo").attr("alt",response.products[i].name);
                                $("#amount_1").val(response.products[i].price);
                                $("#gross_amount").val(response.products[i].price);
                                var gross_amount =  $("#gross_amount").val(); 
                                var service_charge =  response.products[i].service_charge_value;
                                $("#service_charge_value").val(service_charge)
                                var service = gross_amount*service_charge/100;
                                var service = service.toFixed(2);
                                $("#service_charge").val(service);
                                var vat = response.products[i].vat_charge_value;
                                $("#vat_charge_value").val(vat)
                                var vat_amount = gross_amount*response.products[i].vat_charge_value/100;
                                var vat_amount = vat_amount.toFixed(2);
                                $("#vat_charge").val(vat_amount);
                                var net_amount = parseFloat(gross_amount) + parseFloat(service) + parseFloat(vat_amount);
                                var net_amount = net_amount.toFixed(2);
                                $("#net_amount").val(net_amount);
                                $("#discount").val('');
                            }
                        }   
                    }
                });
            });
            //// Discount Product Price
            function discountPrice()
            {
                var discount = parseFloat($("#discount").val());
                var net_amount = parseFloat($("#net_amount").val());
                if(!discount){
                    var total = parseFloat($("#gross_amount").val()) + parseFloat($("#service_charge").val()) + parseFloat($("#vat_charge").val());
                }else{
                    var total = parseFloat($("#gross_amount").val()) + parseFloat($("#service_charge").val()) + parseFloat($("#vat_charge").val());
                    var total = total - discount;
                    var total = total.toFixed(2);
                }
                $("#net_amount").val(total);
            }
            $(document).on("change, keyup", "#discount", discountPrice);
            /////Qty Update product
             function qtyPrice()
            {
                var qty = parseInt($("#qty_1").val());
                var rate = $("#rate_1").val();
                $("#amount_1").val(qty*rate);
                $("#gross_amount").val(qty*rate);
                var gross_amount =  qty*rate; 

                var service_charge =  $("#service_charge_value").val();
                var service = gross_amount*service_charge/100;
                var service = service.toFixed(2);
                $("#service_charge").val(service);

                var vat_charge = $("#vat_charge_value").val();
                var vat_amount = gross_amount*vat_charge/100;
                var vat_amount = vat_amount.toFixed(2);
                $("#vat_charge").val(vat_amount);

                var net_amount = parseFloat(gross_amount) + parseFloat(service) + parseFloat(vat_amount);
                var net_amount = net_amount.toFixed(2);
                $("#net_amount").val(net_amount);
            }
            $(document).on("change, keyup", "#qty_1", qtyPrice);
        });

    </script>
<?php require_once 'include/footer.php'; ?>