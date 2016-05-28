<?php $data_all = json_decode($datainfo);
?>
<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/plugins/datatables/dataTables.css' /> 
<script type='text/javascript' src='<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js'></script> 
<script type='text/javascript' src='<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.columnFilter.js'></script>

<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li class='active'><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
                <li class='active'><a href="<?php echo base_url('events') ?>">Events</a></li>
                <li class=''><?php echo $eventValue[0]->event_title;?></li>
                <li class=''>rsvp</li>
            </ol>

            <h1>All RSVP of <?php echo $eventValue[0]->event_title;?></h1>
        </div>


        <div class="container">
            <div class="row">        
                <div class="col-md-12">
                    <div class="panel panel-grape">
                        <div class="panel-heading">
                            All RSVPS
                            <div class="options">
                                <a href="<?php echo base_url('events/rsvpadd').'/'.$eventValue[0]->id; ?>"><i class="fa fa-plus" title="Add New"></i></a>
                            </div>
                        </div>
                        <div class="panel-body table-responsive">

                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Create Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_all->data as $key => $dataVal) { ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $dataVal->rsvp_description; ?></td>
                                            <td><?php echo $dataVal->insert_date; ?></td>
                                            <td><?php echo $dataVal->action; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
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
<script>
    $(document).ready(function () {
        $('.datatables').dataTable({
            "sDom": "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-6'i><'col-xs-6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page",
                "sSearch": ""
            },
            bSortable: true,
            aoColumnDefs: [
                {"aTargets": [0], "bSortable": true},
                {"aTargets": [1], "bSortable": true},
                {"aTargets": [2], "bSortable": true}
            ]
        });
        $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'Search...');
        $('.dataTables_length select').addClass('form-control');
    });

</script>
<!--column filter-->
<script type="text/javascript">
    $(document).ready(function () {
        $('.datatables').dataTable()
                .columnFilter({
                    aoColumns: [
                        null,
                        null,
                        null
                       
                    ]

                });
    });

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
<!--modal view-->
<script>
    $(document).ready(function () {

        $('.datatables').on("click", '.view', function () { //any Click on Delete icon
            var postVal = $(this).attr("data-value");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('cities/view'); ?>",
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

        $('.datatables').on("click", '.view', function () { //any Click on Delete icon
            var postVal = $(this).attr("data-value");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('cities/view'); ?>",
                data: {postID: postVal},
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

    $('.datatables').on("click", '.delete', function () { //any Click on Delete icon
        reset();
        var url = $(this).attr('href');
        var selector = $(this);
        alertify.confirm("Are You Sure to Delete?", function (e) {
            if (e) {
                $.post(url, function (data) {
                    if (data == 1) {
                        $(selector).closest("tr").empty();
                        alertify.success("Information Deleted.");
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