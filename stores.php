<?php require_once 'include/header.php'; ?>
    <!-- Left side column. contains the logo and sidebar -->
<?php require_once 'include/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Manage
                <small>Stores</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Stores</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div id="messages"></div>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addStoresModal">Add Stores</button>
                    <br /> <br />
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Manage Stores</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="manageTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Stores Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
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


    <!-- create Stores modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addStoresModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Stores</h4>
                </div>

                <form role="form" method="post" id="createStoresForm">

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="stores_name">Stores Name</label>
                            <input type="text" class="form-control" id="stores_name" name="stores_name" placeholder="Enter Stores name" autocomplete="off" required>
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

    <!-- edit Stores modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editStoresModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Stores</h4>
                </div>

                <form role="form" method="post" id="updateStoresForm">

                    <div class="modal-body">
                        <div id="messages"></div>

                        <div class="form-group">
                            <label for="edit_stores_name">Stores Name</label>
                            <input type="text" class="form-control" id="edit_stores_name" name="edit_stores_name" placeholder="Enter Stores name" autocomplete="off" required>
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



    <!-- remove Stores modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeStoresModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Remove Stores</h4>
                </div>

                <form role="form" method="post" id="removeStoresForm">
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
            $("#storeNavNav").addClass('active');
            var crud_action = 'fetch_all';
            var manageTable = $('#manageTable').DataTable({
                "processing":true,
                "serverSide":true,
                "order":[],
                "ajax":{
                    url:"ajax/stores/getStores.php",
                    type:"POST",
                    data:{crud_action:crud_action}
                },
                'createdRow': function( row, data, dataIndex ) {
                    $(row).attr('id', data[0]);
                },
                "columnDefs": [
                    {
                        "orderable": false, "targets": [2]
                    },
                    {
                        "visible": false, "targets": [0]
                    }
                ]
            });

            // submit the create from
            $("#createStoresForm").unbind('submit').on('submit', function() {
                var stores_name = $('input[name="stores_name"]').val();
                var activity = $('select[name="status"]').val();
                // remove the text-danger
                $(".text-danger").remove();
                if(stores_name){
                    $.ajax({
                        url: "ajax/stores/addStore.php",
                        type: "POST",
                        data: {"stores_name": stores_name, "status": activity},
                        success: function (data, status) {
                            var response = JSON.parse(data);
                            if(response.error == false) {
                                manageTable.ajax.reload();
                                // Success message
                                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                    '</div>');

                                // hide the modal
                                $("#addStoresModal").modal('hide');
                                // reset the form
                                $("#createStoresForm")[0].reset();
                                $("#createStoresForm .form-group").removeClass('has-error').removeClass('has-success');
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

        function editStores(id)
        {
            $.ajax({
                url: "ajax/stores/getStoreByID.php?id="+ id,
                type: "POST",
                data: {'action': 'getStores'},
                success:function (data, status) {
                    var response = JSON.parse(data);
                    for(var i=0; i < response.stores.length; i++){
                        $("#edit_stores_name").val(response.stores[i].name);
                        $("#edit_active").val(response.stores[i].status);
                    }
                    // submit the edit from
                    $("#updateStoresForm").unbind('submit').bind('submit', function() {
                        var stores_name = $('input[name="edit_stores_name"]').val();
                        var activity = $('select[name="edit_active"]').val();
                        // remove the text-danger
                        $(".text-danger").remove();
                        if(stores_name){
                            $.ajax({
                                url: "ajax/stores/editStore.php",
                                type: "POST",
                                data: {"id":id, "stores_name": stores_name, "status": activity},
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
                                        $('tr[id="'+id+'"] td:eq(0)').html(stores_name);
                                        $('tr[id="'+ id +'"] td:eq(1)').html(active);

                                        // Success message
                                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                            '</div>');
                                        // hide the modal
                                        $("#editStoresModal").modal('hide');
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

        function removeStores(id)
        {
            if(id) {
                $("#removeStoresForm").on('submit', function() {
                    // remove the text-danger
                    $(".text-danger").remove();
                    $.ajax({
                        url: "ajax/stores/deleteStore.php",
                        type: 'POST',
                        data: { 'stores_id':id },
                        success:function(data, status) {
                            var response = JSON.parse(data)
                            if(!response.error) {
                                $('#manageTable tr[id="'+ id +'"]').remove();
                                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                    '</div>');

                                // hide the modal
                                $("#removeStoresModal").modal('hide');
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