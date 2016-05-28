<?php
foreach ($dataValue as $data) {
    
}
?>
<link rel='stylesheet' type='text/css' href='<?php echo base_url('assets') ?>/plugins/jqueryui-timepicker/jquery.ui.timepicker.css' /> 
<link rel='stylesheet' type='text/css' href='<?php echo base_url('assets') ?>/js/jqueryui.css' /> 
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
                <li class='active'><a href="<?php echo base_url('venues') ?>">Venues</a></li>
                <li class=''><?php echo $venueValue[0]->venue_title; ?></li>
                <li class=''>tables edit</li>
            </ol>

            <h1>Edit table</h1>
        </div>

        <div class="container">

            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4>Edit : table</h4>
                    <div class="options">   
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body collapse in">
                    <form action="<?php echo base_url('venues/tableedit') . '/'.$venueValue[0]->id.'/'. $data->id; ?>" class="form-horizontal row-border" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="venue_table_title" placeholder="Name" value="<?php echo $data->venue_table_title; ?>">
                                <?php echo form_error('venue_table_title', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Price</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="venue_table_price" placeholder="Name" value="<?php echo $data->venue_table_price; ?>">
                                <?php echo form_error('venue_table_price', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Bottle Amount</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="venue_table_bottle_amount" placeholder="Name" value="<?php echo $data->venue_table_bottle_amount; ?>">
                                <?php echo form_error('venue_table_bottle_amount', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Components Amount</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="venue_table_components_amount" placeholder="Name" value="<?php echo $data->venue_table_components_amount; ?>">
                                <?php echo form_error('venue_table_components_amount', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="venue_table_description" placeholder="Name" value="<?php echo $data->venue_table_description; ?>">
                                <?php echo form_error('venue_table_description', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="btn-toolbar">
                                        <button class="btn-primary btn" id="submit">Update</button>
                                        <a href="<?php echo base_url('venues/viptable').'/'.$venueValue[0]->id; ?>" class="btn btn-default">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Colorpicker Modal -->
        </div> <!-- container -->

    </div> <!--wrap -->
</div> <!-- page-content -->
<script type='text/javascript' src='<?php echo base_url('assets/plugins/form-jasnyupload') ?>/fileinput.min.js'></script> 
<?php if (isset($successMsg)) { ?>
    <script>
        jSuccess('<?php echo $successMsg; ?>');
        window.location.replace("<?php echo base_url('venues/viptable').'/'.$venueValue[0]->id; ?>");

    </script>
<?php } ?>
<?php if (isset($errorMsg)) { ?>
    <script>
        jError('<?php echo $errorMsg; ?>');

    </script>
<?php } ?>
<script>
    $(document).ready(function () {
        $('#start-date').datepicker({
            dateFormat: 'yy-mm-dd'
        })
        $("#submit").click(function () {
            var status = $("select[name='status']").val();
            var order = $("select[name='display_order']").val();

            if (order == '') {
                jNotify('Display order must be filled.');
                return false;
            } else {
                if (status == '') {
                    jNotify('Status must be selected.');
                    return false;
                } else {

                }
            }

        });
        return false;

    });
</script>





