<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/plugins/datatables/dataTables.css' />

<script src="<?php echo base_url('assets/js/dataTables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/dataTables/dataTables.bootstrap.js'); ?>"></script>	

<script type='text/javascript' src='<?php echo base_url('assets/demo/demo-modals.js'); ?>'></script> 

<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li class='active'><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
            </ol>

            <h1>All requests</h1>
        </div>


        <div class="container">
            <div class="row">        
                <div class="col-md-12">
                    <div class="panel panel-grape">
                        <div class="panel-heading">
                            All request
                            <!--                            <div class="options">
                                                            <a href="<?php echo base_url('users/add') ?>"><i class="fa fa-plus" title="Add New"></i></a>
                                                        </div>-->
                        </div>
                        <div class="panel-body table-responsive">

                            <table class="table table-striped table-bordered datatable" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Requested Group</th>
                                        <th>Total</th>
                                        <th>Confirm</th>
                                        <th>Cancel</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>       
                        </div>
                    </div>
                </div>


            </div>

        </div> <!-- container -->
    </div> <!--wrap -->
</div> <!-- page-content -->
<!--modal valus-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <img src="<?php echo base_url('assets/img/loading.gif'); ?>">
        </div>
    </div>
</div>
<!--end modal-->
<?php $posturl = base_url() . 'admin/getDataList'; ?>
<script>
    $(document).ready(function () {
        var dataTable;
        dataTableDrow();
    });

    function dataTableDrow() {
        dataTable = $('.datatable').dataTable(
                {
                    "processing": true,
                    "serverSide": true,
                    "iDisplayLength": 10,
                    "iDisplayStart": <?php echo $this->session->userdata('start') == '' ? 0 : $this->session->userdata('start'); ?>,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "sPaginationType": "full_numbers",
                    "sDom": "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-6'i><'col-xs-6'p>>",
                    "ajax": {
                        "url": "<?php echo $posturl; ?>",
                        "type": "POST"
                    },
                    "columns": [
                        {"data": "serial"},
                        {"data": "name"},
                        {"data": "email"},
                        {"data": "phone"},
                        {"data": "blood_group"},
                        {"data": "total"},
                        {"data": "confirm"},
                        {"data": "cancel"},
                        {"data": "createdDate"},
                        {"data": "action"}
                    ],
                    "aoColumnDefs": [
                        {"bSortable": false, "aTargets": [0]},
                        {"bSortable": false, "aTargets": [1]},
                        {"bSortable": false, "aTargets": [2]},
                        {"bSortable": false, "aTargets": [3]},
                        {"bSortable": false, "aTargets": [4]},
                        {"bSortable": false, "aTargets": [5]},
                        {"bSortable": false, "aTargets": [6]},
                        {"bSortable": false, "aTargets": [7]},
                        {"bSortable": false, "aTargets": [8]},
                        {"bSortable": false, "aTargets": [9]}

                    ]
                }
        );
        return dataTable;
    }
</script>   
<!-- status update start -->
<script type="text/javascript" lang="javascript">
    $(document).ready(function () {
        $('#dataTable').on("click", '.update', function () { //any Click on update icon
            var url = $(this).attr('href');
            $.post(url, function (data) {
                if (data == 1) {
                    jSuccess('Information Updated Successfully !!');

                } else {
                    jError('System ERROR : please Contact Developer !');
                }
                dataTable.fnDraw();
            });
            return false;
        });
    });
</script>
<!-- verified update start -->
<script type="text/javascript" lang="javascript">
    $(document).ready(function () {
        $('#dataTable').on("click", '.updateVerified', function () { //any Click on update icon
            var url = $(this).attr('href');
            $.post(url, function (data) {
                if (data == 1) {
                    jSuccess('Information Updated Successfully !!');

                } else {
                    jError('System ERROR : please Contact Developer !');
                }
                dataTable.fnDraw();
            });
            return false;
        });
    });
</script>
<!--modal view-->
<script>
    $(document).ready(function () {

        $('.datatable ').on("click", '.view', function () { //any Click on Delete icon
            var postVal = $(this).attr("data-value");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('bloodrequest/view'); ?>",
                data: {postID: postVal},
                success: function (result) {
                    $('.modal').html(result);
                }
            });

        });
        return false;

    });
</script>
<!--modal view-->
<script>
    $(document).ready(function () {

        $('.datatable ').on("click", '.viewrequest', function () { //any Click on Delete icon
            var postVal = $(this).attr("data-value");
            var type = $(this).attr("type");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('bloodrequest/viewrequest'); ?>",
                data: {postID: postVal, type: type},
                success: function (result) {
                    $('.modal').html(result);
                }
            });

        });
        return false;

    });
</script>

<script>
    function reset() {
        alertify.set({
            labels: {
                ok: "OK",
                cancel: "Cancel"
            },
            delay: 5000,
            buttonReverse: false,
            buttonFocus: "ok"
        });
    }

    $('#dataTable').on("click", '.delete', function () { //any Click on Delete icon
        reset();
        var url = $(this).attr('href');
        var selector = $(this);
        alertify.confirm("Are You Sure to Delete?", function (e) {
            if (e) {
                $.post(url, function (data) {
                    if (data == 1) {
                        $(selector).closest("tr").empty();
                        alertify.success("Information Deleted.");
                        dataTable.fnDraw();
                    }
                    if (data == 2) {
                        alertify.error("System Error.Please Let Us Know.");
                    }
                });
            } else {
            }
        });
        return false;
    });
</script>
<script>
    $(document).ready(function () {

        $('.datatable ').on("click", '.subHeaderView', function () { //any Click on Delete icon
            var postVal = $(this).attr("data-value");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('header/subHeaderView'); ?>",
                data: {postID: postVal},
                success: function (result) {
                    $('.modal').html();
                    $('.modal').html(result);
                }
            });

        });
        return false;

    });
</script>