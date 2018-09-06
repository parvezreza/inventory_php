<?php require_once 'include/header.php'; ?>
    <!-- Left side column. contains the logo and sidebar -->
<?php require_once 'include/sidebar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Manage Attributes
                <small>Value</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Attributes</li>
               <!-- <li class="active">Attributes Value</li>-->
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <h4>Attribute name: </h4>
                        </div>
                    </div>
                    <div id="messages"></div>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addValueModal">Add Value</button>
                    <br /> <br />
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Manage Value</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="manageTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Attributes Value</th>
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


    <!-- create Value modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addValueModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Value</h4>
                </div>

                <form role="form" method="post" id="createValueForm">

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="attribute_value">Value Name</label>
                            <input type="text" class="form-control" id="attribute_value" name="attribute_value" placeholder="Enter Value name" autocomplete="off" required>
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

    <!-- edit Value modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editValueModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Value</h4>
                </div>

                <form role="form" method="post" id="updateValueForm">

                    <div class="modal-body">
                        <div id="messages"></div>

                        <div class="form-group">
                            <label for="edit_attribute_value">Attributes Value</label>
                            <input type="text" class="form-control" id="edit_attribute_value" name="edit_attribute_value" placeholder="Enter Value name" autocomplete="off" required>
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



    <!-- remove Value modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeValueModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Remove Value</h4>
                </div>

                <form role="form" method="post" id="removeValueForm">
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
                    url:"ajax/attributes/getAttributesValue.php?id=<?php echo $_GET['id']; ?>",
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
            $("#createValueForm").unbind('submit').on('submit', function() {
                var attribute_value = $('input[name="attribute_value"]').val();
                var attribute_parent_id = <?php echo $_GET['id']; ?>
                // remove the text-danger
                $(".text-danger").remove();
                if(attribute_value){
                    $.ajax({
                        url: "ajax/attributes/addAttributeValue.php",
                        type: "POST",
                        data: {"attribute_parent_id":attribute_parent_id,"attribute_value": attribute_value},
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
                                $("#addValueModal").modal('hide');
                                // reset the form
                                $("#createValueForm")[0].reset();
                                $("#createValueForm .form-group").removeClass('has-error').removeClass('has-success');
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

        function editValue(id)
        {
            $.ajax({
                url: "ajax/attributes/getAttributeValueByID.php?id="+ id,
                type: "POST",
                data: {'action': 'getValue'},
                success:function (data, status) {
                    var response = JSON.parse(data);
                    for(var i=0; i < response.attributeValue.length; i++){
                        $("#edit_attribute_value").val(response.attributeValue[i].value);
                    }
                    // submit the edit from
                    $("#updateValueForm").unbind('submit').bind('submit', function() {
                        var attribute_value = $('input[name="edit_attribute_value"]').val();
                        // remove the text-danger
                        $(".text-danger").remove();
                        if(attribute_value){
                            $.ajax({
                                url: "ajax/attributes/editAttributeValue.php",
                                type: "POST",
                                data: {"id":id, "attribute_value": attribute_value},
                                success:function (data, status) {
                                    var response = JSON.parse(data);
                                    if(response.error == false) {
                                        // Update tr html value
                                        $('tr[id="'+id+'"] td:eq(0)').html(attribute_value);

                                        // Success message
                                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                            '</div>');
                                        // hide the modal
                                        $("#editValueModal").modal('hide');
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

        function removeValue(id)
        {
            if(id) {
                $("#removeValueForm").on('submit', function() {
                    // remove the text-danger
                    $(".text-danger").remove();
                    $.ajax({
                        url: "ajax/attributes/deleteAttributeValue.php",
                        type: 'POST',
                        data: { 'attribute_value_id':id },
                        success:function(data, status) {
                            var response = JSON.parse(data)
                            if(!response.error) {
                                $('#manageTable tr[id="'+ id +'"]').remove();
                                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                    '</div>');

                                // hide the modal
                                $("#removeValueModal").modal('hide');
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