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
                <li><a href="<?php echo base_url('admin') ?>">admin</a></li>
                <li class="active">Edit admin</li>
            </ol>

            <h1>Edit admin</h1>
        </div>

        <div class="container">

            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4>Edit : admin</h4>
                    <div class="options">   
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body collapse in">
                    <form action="<?php echo base_url('admin/edit') . '/' . $data->id; ?>" class="form-horizontal row-border" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $data->user_name; ?>">
                                <?php echo form_error('name', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="email" placeholder="" value="<?php echo $data->email; ?>">
                                <?php echo form_error('email', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="password" placeholder="Fill if you want to change" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Type</label>
                            <div class="col-sm-6">
                                <select class="form-control" placeholder="Dropdown" name="type">
                                    <option value="">Please Select:</option>
                                    <option value="4" <?php if ($data->user_type == 4) echo 'selected="selected"'; ?>>Sub-admin</option>
                                    <option value="3" <?php if ($data->user_type == 3) echo 'selected="selected"'; ?>>Super-admin</option>
                                </select>
                                <?php echo form_error('type', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-6">
                                <select class="form-control" placeholder="Dropdown" name="status">
                                    <option value="">Please Select:</option>
                                    <option value="1" <?php if ($data->status == 1) echo 'selected="selected"'; ?>>Active</options>
                                    <option value="0" <?php if ($data->status == 0) echo 'selected="selected"'; ?>>Inactive</options>
                                </select>
                                <?php echo form_error('status', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="btn-toolbar">
                                        <button class="btn-primary btn" id="submit">Update</button>
                                        <a href="<?php echo base_url('admin'); ?>" class="btn btn-default">Cancel</a>
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
        window.location.replace("<?php echo base_url('admin'); ?>");

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





