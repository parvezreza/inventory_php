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
                <small>Company</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">company</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Manage Company Information</h3>
                        </div>
                        <?php
                        if($_POST){
                            $company_id = $_POST['company_id'];
                            $company_name = $_POST['company_name'];
                            $service_charge_value = $_POST['service_charge_value'];
                            $vat_charge_value = $_POST['vat_charge_value'];
                            $address = $_POST['address'];
                            $phone = $_POST['phone'];
                            $country = $_POST['country'];
                            $message = $_POST['message'];
                            $currency = $_POST['currency'];
                            $sql = "UPDATE company SET
                                      company_name = :company_name,
                                      service_charge_value = :service_charge_value,
                                      vat_charge_value = :vat_charge_value,
                                      address = :address,
                                      phone = :phone,
                                      country = :country,
                                      message = :message, 
                                      currency = :currency
                                WHERE id = :id";
                            $st = $db->prepare($sql);
                            $st->bindParam(":id", $company_id, PDO::PARAM_INT);
                            $st->bindParam(":company_name", $company_name, PDO::PARAM_STR);
                            $st->bindParam(":service_charge_value", $service_charge_value, PDO::PARAM_INT);
                            $st->bindParam(":vat_charge_value", $vat_charge_value, PDO::PARAM_INT);
                            $st->bindParam(":address", $address, PDO::PARAM_STR);
                            $st->bindParam(":phone", $phone, PDO::PARAM_STR);
                            $st->bindParam(":country", $country, PDO::PARAM_STR);
                            $st->bindParam(":message", $message, PDO::PARAM_STR);
                            $st->bindParam(":currency", $currency, PDO::PARAM_STR);
                            try{
                                $st->execute();
                                $result['error'] = false;
                                $result['messages'] = "Successfully Created";
                                $result['id'] = $db->lastInsertId();
                            }
                            catch (PDOException $e){
                                $result['messages'] = $st->errorInfo()[2];

                            }
                            //print_r($result);
                        }
                        // Company Data show area
                        $CompanySQL = "SELECT * FROM company";
                        $st = $db->prepare($CompanySQL);
                        $comResult = [];
                        try{
                            $st->execute();
                            $comResult = $st->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($comResult as $company_data){

                            }
                        }catch (PDOException $e){
                            $e->getMessage();
                        }
                        ?>
                        <form role="form" action="" method="post">
                            <input type="hidden" name="company_id" value="<?php echo $company_data['id'] ?>">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter company name" value="<?php echo $company_data['company_name'] ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="<?php echo $company_data['address'] ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="service_charge_value">Charge Amount (%)</label>
                                    <input type="text" class="form-control" id="service_charge_value" name="service_charge_value" placeholder="Enter charge amount %" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" value="<?php echo $company_data['phone'] ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="vat_charge_value">Vat Charge (%)</label>
                                    <input type="text" class="form-control" id="vat_charge_value" name="vat_charge_value" placeholder="Enter vat charge %" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select class="form-control" id="country" name="country">
                                        <?php
                                        echo '<option value="'.$company_data['country'].'">'.$company_data['country'].'</option>';
                                        $CurrencySQL = "SELECT * FROM currency";
                                        $st = $db->prepare($CurrencySQL);
                                        $comResult = [];
                                        try{
                                            $st->execute();
                                            $comResult = $st->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($comResult as $currency_data){
                                                echo '<option value="'.$currency_data['country'].'">'.$currency_data['country'].'</option>';
                                            }
                                        }catch (PDOException $e){
                                            $e->getMessage();
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="permission">Message</label>
                                    <textarea class="form-control" id="message" name="message">
                                        <?php echo $company_data['message'] ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="currency">Currency</label>
                                    <select class="form-control" id="currency" name="currency">
                                        <?php
                                        echo '<option value="'.$company_data['currency'].'">'.$company_data['currency'].'</option>';
                                        $CurrencySQL = "SELECT * FROM currency";
                                        $st = $db->prepare($CurrencySQL);
                                        $comResult = [];
                                        try{
                                            $st->execute();
                                            $comResult = $st->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($comResult as $currency_data){
                                                echo '<option value="'.$currency_data['code'].'">'.$currency_data['code'].'</option>';
                                            }
                                        }catch (PDOException $e){
                                            $e->getMessage();
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
            </div>
            <!-- /.row -->


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script type="text/javascript">
        $(document).ready(function() {
            $("#companyNav").addClass('active');
            $("#message").wysihtml5();
        });
    </script>

<?php require_once 'include/footer.php'; ?>