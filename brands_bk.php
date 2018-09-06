<?php
require_once 'include/header.php';
require_once "include/db.php";
?>
    <!-- Left side column. contains the logo and sidebar -->
<?php require_once 'include/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Manage
                <small>Brands</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Brands</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div id="messages"></div>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addBrandModal">Add Brand</button>
                    <br /> <br />
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Manage Brands</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="manageTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Brand Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT * FROM brands ORDER BY id DESC";
                                $st = $db->prepare($sql);
                                $result = [];
                                $i = 0;
                                try{
                                    $st->execute();
                                    $result = $st->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($result as $results){
                                        $i++;
                                        echo '<tr data-id="'.$results['id'].'">';
                                        echo '<td> '.$results['name'].' </td>';
                                        if($results['status'] == 1) {
                                            echo '<td> <span class="label label-success">Active</span> </td>';
                                        }else{
                                            echo '<td> <span class="label label-warning">Inactive</span></td>';
                                        }
                                        echo '<td>';
                                        echo '<button type="button" class="btn btn-default" onclick="editBrand('.$results['id'].')" data-toggle="modal" data-target="#editBrandModal"><i class="fa fa-pencil"></i></button>';
                                        echo '<button data-id="'.$results['id'].'" type="button" class="btn btn-default" onclick="removeBrand('.$results['id'].')" data-toggle="modal" data-target="#removeBrandModal"><i class="fa fa-trash"></i></button>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                                catch (PDOException $e){
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


    <!-- create brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addBrandModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Brand</h4>
                </div>

                <form role="form" method="post" id="createBrandForm">

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="brand_name">Brand Name</label>
                            <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Enter brand name" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- edit brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editBrandModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Brand</h4>
                </div>

                <form role="form" method="post" id="updateBrandForm">

                    <div class="modal-body">
                        <div id="messages"></div>

                        <div class="form-group">
                            <label for="edit_brand_name">Brand Name</label>
                            <input type="text" class="form-control" id="edit_brand_name" name="edit_brand_name" placeholder="Enter brand name" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_active">Status</label>
                            <select class="form-control" id="edit_active" name="edit_active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeBrandModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Remove Brand</h4>
                </div>

                <form role="form" method="post" id="removeBrandForm">
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
<?php //endif; ?>



    <script type="text/javascript">
        $(document).ready(function() {
            $("#brandNav").addClass('active');
             /*$('#manageTable').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'ajax': {
                        url: "include/getProducts.php",
                        type: "post"
                    }
             });*/
            /*$.ajax({
                url: "http://localhost/inventory/new/include/getBrands.php",
                type: "POST",
                data: {'action': 'get_brands'},
                success:function (data, status) {
                    var response = JSON.parse(data);

                    for(var i=0; i < response.brands.length; i++){
                        $("#manageTable tbody").append(
                            '<tr>' +
                            '<td>' + (i+1) + '</td>'+
                            '<td>' +  response.brands[i].name + '</td>' +
                            '<td>' +  response.brands[i].status + '</td>' +
                            '<td>'+
                            '<button type="button" class="btn btn-default" onclick="editbrand(' + response.brands[i].id +')" data-toggle="modal" data-target="#editBrandModal"><i class="fa fa-pencil"></i></button>' +
                            '<button data-id="' + response.brands[i].id +'" type="button" class="btn btn-default" onclick="removeBrand(' + response.brands[i].id +')" data-toggle="modal" data-target="#removeBrandModal"><i class="fa fa-trash"></i></button>' +
                            '</td>' +
                            '</tr>'
                        );
                    }
                }
            });*/

            var manageTable = $('#manageTable').DataTable({
                "order": [[ 3, "desc" ]]
            });
            // submit the create from
            $("#createBrandForm").unbind('submit').on('submit', function() {
                var brand_name = $('input[name="brand_name"]').val();
                var activity = $('select[name="status"]').val();
                // remove the text-danger
                $(".text-danger").remove();
                if(brand_name){
                    $.ajax({
                        url: "http://localhost/inventory/new/include/addBrand.php",
                        type: "POST",
                        data: {"brand_name": brand_name, "status": activity},
                        success: function (data, status) {
                            var response = JSON.parse(data);
                            if(response.error == false) {
                                // Status logic
                                if(activity == 0){
                                    var active = '<span class="label label-warning">Inactive</span>';
                                }else if(activity == 1){
                                    var active = '<span class="label label-success">Active</span>';
                                }
                                // add new row
                                var row = $('<tr data-id="' + response.id +'">')
                                    .append('<td>' + brand_name +'</td>')
                                    .append('<td>' + active +'</td>')
                                    .append('<td>' +
                                        '<button type="button" class="btn btn-default" onclick="editBrand(' + response.id +')" data-toggle="modal" data-target="#editBrandModal"><i class="fa fa-pencil"></i></button>' +
                                        '<button data-id="' + response.id +'" type="button" class="btn btn-default" onclick="removeBrand(' + response.id +')" data-toggle="modal" data-target="#removeBrandModal"><i class="fa fa-trash"></i></button></td></tr>');
                                manageTable.row.add(row).draw( false );
                                $('#manageTable tbody').prepend(row);

                                // Success message
                                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                    '</div>');

                                // hide the modal
                                $("#addBrandModal").modal('hide');
                                // reset the form
                                $("#createBrandForm")[0].reset();
                                $("#createBrandForm .form-group").removeClass('has-error').removeClass('has-success');
                            }else {
                                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<strong><span class="glyphicon glyphicon-exclamation-sign"></span> </strong> '+response.messages+
                                    '</div>');
                            }
                        }
                    });
                } // Endif
                return false;
            });
        });

        function editBrand(id)
        {
            $.ajax({
                url: "http://localhost/inventory/new/include/getBrandByID.php?id="+ id,
                type: "POST",
                data: {'action': 'getBrand'},
                success:function (data, status) {
                    var response = JSON.parse(data);
                    for(var i=0; i < response.brands.length; i++){
                        $("#edit_brand_name").val(response.brands[i].name);
                        $("#edit_active").val(response.brands[i].status);
                    }
                    // submit the edit from
                    $("#updateBrandForm").unbind('submit').bind('submit', function() {
                        var brand_name = $('input[name="edit_brand_name"]').val();
                        var activity = $('select[name="edit_active"]').val();
                        // remove the text-danger
                        $(".text-danger").remove();
                        if(brand_name){
                            $.ajax({
                                url: "http://localhost/inventory/new/include/editBrand.php",
                                type: "POST",
                                data: {"id":id, "brand_name": brand_name, "status": activity},
                                success:function (data, status) {
                                    var response = JSON.parse(data);
                                    if(response.error == false) {
                                        // Status logic
                                        if(activity == 0){
                                            var active = '<span class="label label-warning">Inactive</span>';
                                        }else if(activity == 1){
                                            var active = '<span class="label label-success">Active</span>';
                                        }
                                        // Update tr html value
                                        $('tr[data-id="'+id+'"] td:eq(0)').html(brand_name);
                                        $('tr[data-id="'+ id +'"] td:eq(1)').html(active);

                                        // Success message
                                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                            '</div>');

                                        // hide the modal
                                        $("#editBrandModal").modal('hide');
                                    }else {
                                        $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                            '<strong><span class="glyphicon glyphicon-exclamation-sign"></span> </strong> '+response.messages+
                                            '</div>');
                                    }
                                }
                            });
                        }//EndIF
                        return false;
                    });

                }
            });
        }

        function removeBrand(id)
        {
            if(id) {
                $("#removeBrandForm").on('submit', function() {
                    // remove the text-danger
                    $(".text-danger").remove();
                    $.ajax({
                        url: "http://localhost/inventory/new/include/deleteBrand.php",
                        type: 'POST',
                        data: { 'brand_id':id },
                        success:function(data, status) {
                            var response = JSON.parse(data)
                            if(!response.error) {
                                $('#manageTable tr[data-id="'+ id +'"]').remove();
                                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                    '</div>');

                                // hide the modal
                                $("#removeBrandModal").modal('hide');
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
    <script type="text/javascript">
        $(document).ready(function() {
            $("#brandNav").addClass('active');
        });
    </script>

<?php require_once 'include/footer.php'; ?>