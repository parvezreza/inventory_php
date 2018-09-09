<?php
require_once 'include/header.php';
require_once 'include/db.php';
?>
    <!-- Left side column. contains the logo and sidebar -->
<?php require_once 'include/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 616px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->

            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <?php
                            $sql = "SELECT * FROM products";
                            $st = $db->prepare($sql);
                            try{
                                $st->execute();
                               echo '<h3> '.$st->rowCount().' </h3>';
                            }catch (PDOException $e){
                                $e->getMessage();
                            }
                            ?>
                            <p>Total Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="products.php" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <?php
                            $sql = "SELECT * FROM orders";
                            $st = $db->prepare($sql);
                            try{
                                $st->execute();
                                echo '<h3> '.$st->rowCount().' </h3>';
                            }catch (PDOException $e){
                                $e->getMessage();
                            }
                            ?>
                            <p>Total Paid Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="orders.php" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <?php
                            $sql = "SELECT * FROM users";
                            $st = $db->prepare($sql);
                            try{
                                $st->execute();
                                echo '<h3> '.$st->rowCount().' </h3>';
                            }catch (PDOException $e){
                                $e->getMessage();
                            }
                            ?>
                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-people"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <?php
                            $sql = "SELECT * FROM stores";
                            $st = $db->prepare($sql);
                            try{
                                $st->execute();
                                echo '<h3> '.$st->rowCount().' </h3>';
                            }catch (PDOException $e){
                                $e->getMessage();
                            }
                            ?>
                            <p>Total Stores</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-home"></i>
                        </div>
                        <a href="stores.php" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script type="text/javascript">
        $(document).ready(function () {
            $("#dashboardMainMenu").addClass('active');
        });
    </script>
<?php require_once 'include/footer.php'; ?>