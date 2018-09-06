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
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add Product</h3>
                        </div>
                        <!-- /.box-header -->
                        <form role="form" action="products.php" method="post" enctype="multipart/form-data">
                            <div class="box-body">

                                <?php //echo validation_errors(); ?>

                                <div class="form-group">

                                    <label for="product_image">Image</label>
                                    <div class="kv-avatar">
                                        <div class="file-loading">
                                            <input id="product_image" name="product_image" type="file">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="product_name">Product name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" require autocomplete="off"/>
                                </div>

                                <div class="form-group">
                                    <label for="sku">SKU</label>
                                    <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter sku" require autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" require autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label for="qty">Qty</label>
                                    <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter Qty" require autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description" autocomplete="off">
                                    </textarea>
                                </div>
                                <?php
                                $sql = "SELECT * FROM attributes"; //ORDER BY id ASC LIMIT 1
                                $st = $db->prepare($sql);
                                $result = [];
                                $resultSub = [];
                                try{
                                    $st->execute();
                                    $result = $st->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($result as $results) {
                                        $id = $results['id'];
                                        $html = '<div class="form-group">
                                                    <label for="groups">'.$results['name'].'</label>
                                                    <select class="form-control select_group" id="attributes_value_id" name="attributes_value_id[]" require>';
                                                        $sqlSub = "SELECT * FROM attribute_value ";
                                                        $st2 = $db->prepare($sqlSub);
                                                        //$st->bindParam(":attribute_parent_id", $results['id'], PDO::PARAM_INT);
                                                        $st2->execute();
                                                        $resultSub = $st2->fetchAll(PDO::FETCH_ASSOC);
                                                         foreach($resultSub as $resultSubs) {
                                                             $html .= '<option value="'.$resultSubs['id'].'">'.$resultSubs['value'].'</option>';
                                                         }

                                         $html .=  '</select>
                                                </div>';
                                        echo $html;
                                    }
                                }
                                catch (PDOException $e){
                                    $e->getMessage();
                                }
                                ?>
                                <div class="form-group">
                                    <label for="brands">Brands</label>
                                    <select class="form-control select_group" id="brands" name="brands" require>
                                        <option value="">Select</option>
                                        <?php
                                        $sql = "SELECT * FROM brands";
                                        $st = $db->prepare($sql);
                                        $result = [];
                                        try{
                                            $st->execute();
                                            $result = $st->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $results){
                                                echo '<option value="'.$results['id'].'">'.$results['name'].'</option>';
                                            }
                                        }catch (PDOException $e){
                                            $e->getMessage();
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="brands">Category</label>
                                    <select class="form-control select_group" id="category" name="category" require>
                                    <option value="">Select</option>
                                    <?php
                                    $sql = "SELECT * FROM categories";
                                    $st = $db->prepare($sql);
                                    $result = [];
                                    try{
                                        $st->execute();
                                        $result = $st->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $results){
                                            echo '<option value="'.$results['id'].'">'.$results['name'].'</option>';
                                        }
                                    }catch (PDOException $e){
                                        $e->getMessage();
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="brands">Stores</label>
                                    <select class="form-control select_group" id="store" name="store" require>
                                    <option value="">Select</option>
                                    <?php
                                    $sql = "SELECT * FROM stores";
                                    $st = $db->prepare($sql);
                                    $result = [];
                                    try{
                                        $st->execute();
                                        $result = $st->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $results){
                                            echo '<option value="'.$results['id'].'">'.$results['name'].'</option>';
                                        }
                                    }catch (PDOException $e){
                                        $e->getMessage();
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="store">Availability</label>
                                    <select class="form-control" id="availability" name="availability">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <input name="add_product" type="submit" class="btn btn-primary" value="Save Changes">
                                <a href="<?php //echo base_url('products/') ?>" class="btn btn-warning">Back</a>
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
        $(document).ready(function() {
            $(".select_group").select2();
            $("#description").wysihtml5();

            $("#mainProductNav").addClass('active');
            $("#addProductNav").addClass('active');

            var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' +
                'onclick="alert(\'Call your custom code here.\')">' +
                '<i class="glyphicon glyphicon-tag"></i>' +
                '</button>';
            $("#product_image").fileinput({
                overwriteInitial: true,
                maxFileSize: 1500,
                showClose: false,
                showCaption: false,
                browseLabel: '',
                removeLabel: '',
                browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
                removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
                removeTitle: 'Cancel or reset changes',
                elErrorContainer: '#kv-avatar-errors-1',
                msgErrorClass: 'alert alert-block alert-danger',
                // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
                layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
                allowedFileExtensions: ["jpg", "jpeg", "png", "gif"]
            });

        });
    </script>

<?php require_once 'include/footer.php'; ?>