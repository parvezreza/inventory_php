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
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM products WHERE id = :id";
                    $st = $db->prepare($sql);
                    $st->bindParam(':id', $id, PDO::PARAM_INT);
                    $result = [];
                    try{
                        $st->execute();
                        $result = $st->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $upResults){
                        }
                    }catch (PDOException $e){
                        $e->getMessage();
                    }
                    ?>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add Product</h3>
                        </div>
                        <!-- /.box-header -->
                        <form role="form" action="products.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" value="<?php echo $upResults['id']; ?>"/>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="">Image Preview</label>
                                    <img src="<?php echo $upResults['image']?>" alt="<?php echo $upResults['name']?>" width="150" height="150" class="img-circle">
                                </div>
                                <div class="form-group">
                                    <label for="product_image">Image</label>
                                    <div class="kv-avatar">
                                        <div class="file-loading">
                                            <input id="product_image" name="product_image" type="file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="box-body">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_name">Product name</label>
                                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" value="<?php echo $upResults['name']; ?>" required autocomplete="off"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="qty">Qty</label>
                                            <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter Qty" value="<?php echo $upResults['qty']; ?>" required autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter sku" value="<?php echo $upResults['sku']; ?>" required autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label for="brands">Brands</label>
                                            <select class="form-control select_group" id="brands" name="brands" require>
                                                <?php
                                                $Bid = $upResults['brand_id'];
                                                $sql = "SELECT * FROM brands WHERE id = :id";
                                                $st = $db->prepare($sql);
                                                $st->bindParam(':id', $Bid, PDO::PARAM_INT);
                                                $result = [];
                                                $st->execute();
                                                $result = $st->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($result as $BrandResults){
                                                }
                                                echo '<option value="'.$upResults['brand_id'].'">'.$BrandResults["name"].'</option>';
                                                //Looping
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
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="<?php echo $upResults['price']; ?>" required autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label for="brands">Category</label>
                                            <select class="form-control select_group" id="category" name="category" require>
                                                <?php
                                                $Cid = $upResults['category_id'];
                                                $sql = "SELECT * FROM categories WHERE id = :id";
                                                $st = $db->prepare($sql);
                                                $st->bindParam(':id', $Cid, PDO::PARAM_INT);
                                                $result = [];
                                                $st->execute();
                                                $result = $st->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($result as $CatResults){
                                                }
                                                echo '<option value="'.$upResults['category_id'].'">'.$CatResults["name"].'</option>';
                                                //Looping
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
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description"  autocomplete="off">
                                                <?php echo $upResults['description']; ?>
                                            </textarea>
                                        </div>
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
                                            $html = '<div class="col-md-4"><div class="form-group">
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

                                             $html .=  '</select></div></div>';
                                            echo $html;
                                        }
                                    }
                                    catch (PDOException $e){
                                        $e->getMessage();
                                    }
                                    ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="brands">Stores</label>
                                            <select class="form-control select_group" id="store" name="store" require>
                                                <?php
                                                $Sid = $upResults['store_id'];
                                                $sql = "SELECT * FROM stores WHERE id = :id";
                                                $st = $db->prepare($sql);
                                                $st->bindParam(':id', $Sid, PDO::PARAM_INT);
                                                $result = [];
                                                $st->execute();
                                                $result = $st->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($result as $StoreResults){
                                                }
                                                echo '<option value="'.$upResults['store_id'].'">'.$StoreResults["name"].'</option>';
                                                //Looping
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
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="store">Availability</label>
                                            <select class="form-control" id="availability" name="availability">
                                                <?php
                                                if($upResults['status'] == 1){
                                                    $active = 'Yes';
                                                }else{
                                                    $active = 'No';
                                                }
                                                ?>
                                                <option value="<?php echo $active; ?>"><?php echo $active; ?></option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="store">&nbsp;</label> <br>
                                            <input name="update_product" type="submit" class="btn btn-primary" value="Save Changes">
                                            <a href="products.php" class="btn btn-warning">Back</a>
                                        </div>
                                    </div>
                                </div> <!--/.box-body -->
                            </div>
                            <!-- /.row -->
                        </form>
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