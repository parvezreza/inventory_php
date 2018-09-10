<?php
require_once 'include/db.php';
$id = @$_GET["id"];
$sql = "SELECT *,products.name AS img,orders_item.qty AS order_qty FROM orders
                                              LEFT JOIN orders_item ON orders.id = orders_item.order_id
                                              LEFT JOIN products ON  orders_item.product_id = products.id
                                              WHERE orders.id = $id";
$st = $db->prepare($sql);
$result = [];
try{
    $st->execute();
    $result = $st->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $order_data){
    }
}catch (PDOException $e){
    $e->getMessage();
}
//company info
$sql = "SELECT * FROM company ORDER BY id DESC";
$st = $db->prepare($sql);
$result = [];
try{
    $st->execute();
    $company_info = $st->fetch();
}catch (PDOException $e){
    $e->getMessage();
}


$order_date = $order_data['date_time'];
$paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";

$html = '<!-- Main content -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inventory | Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href=assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
</head>
<body onload="window.print();">

<div class="wrapper">
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    '.$company_info['company_name'].'
                    <small class="pull-right">Date: '.$order_date.'</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">

            <div class="col-sm-4 invoice-col">

                <b>Bill ID:</b> '.$order_data['bill_no'].'<br>
                <b>Name:</b> '.$order_data['customer_name'].'<br>
                <b>Address:</b> '.$order_data['customer_address'].' <br />
                <b>Phone:</b> '.$order_data['customer_phone'].'
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Product name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>';

                    $html .= '<tr>
                        <td>'.$order_data['name'].'</td>
                        <td>'.$order_data['rate'].'</td>
                        <td>'.$order_data['order_qty'].'</td>
                        <td>'.$order_data['amount'].'</td>
                    </tr>';
                    $html .= '</tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-xs-6 pull pull-right">

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Gross Amount:</th>
                            <td>'.$order_data['gross_amount'].'</td>
                        </tr>';

                        if($order_data['service_charge'] > 0) {
                        $html .= '<tr>
                            <th>Service Charge ('.$order_data['service_charge_rate'].'%)</th>
                            <td>'.$order_data['service_charge'].'</td>
                        </tr>';
                        }

                        if($order_data['vat_charge'] > 0) {
                        $html .= '<tr>
                            <th>Vat Charge ('.$order_data['vat_charge_rate'].'%)</th>
                            <td>'.$order_data['vat_charge'].'</td>
                        </tr>';
                        }


                        $html .=' <tr>
                            <th>Discount:</th>
                            <td>'.$order_data['discount'].'</td>
                        </tr>
                        <tr>
                            <th>Net Amount:</th>
                            <td>'.$order_data['net_amount'].'</td>
                        </tr>
                        <tr>
                            <th>Paid Status:</th>
                            <td>'.$paid_status.'</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
</body>
</html>';

echo $html;