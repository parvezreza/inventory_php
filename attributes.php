<?php require_once 'include/header.php'; ?>
    <!-- Left side column. contains the logo and sidebar -->
<?php require_once 'include/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Manage
                <small>Attributes</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Attributes</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div id="messages"></div>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addAttributesModal">Add Attributes</button>
                    <br /> <br />
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Manage Attributes</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="manageTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Attributes Name</th>
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


    <!-- create Attributes modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addAttributesModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Attributes</h4>
                </div>

                <form role="form" method="post" id="createAttributesForm">

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="attribute_name">Attributes Name</label>
                            <input type="text" class="form-control" id="attribute_name" name="attribute_name" placeholder="Enter Attributes name" autocomplete="off" required>
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

    <!-- edit Attributes modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editAttributesModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Attributes</h4>
                </div>

                <form role="form" method="post" id="updateAttributesForm">

                    <div class="modal-body">
                        <div id="messages"></div>

                        <div class="form-group">
                            <label for="edit_attribute_name">Attributes Name</label>
                            <input type="text" class="form-control" id="edit_attribute_name" name="edit_attribute_name" placeholder="Enter Attributes name" autocomplete="off" required>
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



    <!-- remove Attributes modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeAttributesModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Remove Attributes</h4>
                </div>

                <form role="form" method="post" id="removeAttributesForm">
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
            $("#attributeNav").addClass('active');
            var crud_action = 'fetch_all';
            var manageTable = $('#manageTable').DataTable({
                "processing":true,
                "serverSide":true,
                "order":[],
                "ajax":{
                    url:"ajax/attributes/getAttributes.php",
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
            $("#createAttributesForm").unbind('submit').on('submit', function() {
                var attribute_name = $('input[name="attribute_name"]').val();
                var activity = $('select[name="status"]').val();
                // remove the text-danger
                $(".text-danger").remove();
                if(attribute_name){
                    $.ajax({
                        url: "ajax/attributes/addAttribute.php",
                        type: "POST",
                        data: {"attribute_name": attribute_name, "status": activity},
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
                                $("#addAttributesModal").modal('hide');
                                // reset the form
                                $("#createAttributesForm")[0].reset();
                                $("#createAttributesForm .form-group").removeClass('has-error').removeClass('has-success');
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

        function editAttributes(id)
        {
            $.ajax({
                url: "ajax/attributes/getAttributeByID.php?id="+ id,
                type: "POST",
                data: {'action': 'getAttributes'},
                success:function (data, status) {
                    var response = JSON.parse(data);
                    for(var i=0; i < response.attributes.length; i++){
                        $("#edit_attribute_name").val(response.attributes[i].name);
                        $("#edit_active").val(response.attributes[i].status);
                    }
                    // submit the edit from
                    $("#updateAttributesForm").unbind('submit').bind('submit', function() {
                        var attribute_name = $('input[name="edit_attribute_name"]').val();
                        var activity = $('select[name="edit_active"]').val();
                        // remove the text-danger
                        $(".text-danger").remove();
                        if(attribute_name){
                            $.ajax({
                                url: "ajax/attributes/editAttribute.php",
                                type: "POST",
                                data: {"id":id, "attribute_name": attribute_name, "status": activity},
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
                                        $('tr[id="'+id+'"] td:eq(0)').html(attribute_name);
                                        $('tr[id="'+ id +'"] td:eq(1)').html(active);

                                        // Success message
                                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                            '</div>');
                                        // hide the modal
                                        $("#editAttributesModal").modal('hide');
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

        function removeAttributes(id)
        {
            if(id) {
                $("#removeAttributesForm").on('submit', function() {
                    // remove the text-danger
                    $(".text-danger").remove();
                    $.ajax({
                        url: "ajax/attributes/deleteAttribute.php",
                        type: 'POST',
                        data: { 'attribute_id':id },
                        success:function(data, status) {
                            var response = JSON.parse(data)
                            if(!response.error) {
                                $('#manageTable tr[id="'+ id +'"]').remove();
                                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                    '</div>');

                                // hide the modal
                                $("#removeAttributesModal").modal('hide');
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