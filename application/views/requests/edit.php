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
                <li><a href="<?php echo base_url('users') ?>">Users</a></li>
                <li class="active">Edit user</li>
            </ol>

            <h1>Edit user</h1>
        </div>

        <div class="container">

            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4>Edit : User</h4>
                    <div class="options">   
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body collapse in">
                    <form action="<?php echo base_url('users/edit') . '/' . $data->id; ?>" class="form-horizontal row-border" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $data->name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="email" placeholder="" value="<?php echo $data->email; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Phone</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="phone" placeholder="" value="<?php echo $data->phone; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="password" placeholder="Fill if you want to change" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Longitude</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="longitude" placeholder="" value="<?php echo $data->longitude; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Latitude</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="latitude" placeholder="" value="<?php echo $data->latitude; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gender</label>
                            <div class="col-sm-6">
                                <select class="form-control" placeholder="Dropdown" name="gender">
                                    <option value="">Please Select:</option>
                                    <option value="1" <?php if ($data->gender == 1) echo 'selected="selected"'; ?>>Male</option>
                                    <option value="2" <?php if ($data->gender == 2) echo 'selected="selected"'; ?>>Female</option>
                                    <option value="3" <?php if ($data->gender == 3) echo 'selected="selected"'; ?>>Other</option>
                                </select>
                                <?php echo form_error('status', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Blood group</label>
                            <div class="col-sm-6">
                                <select class="form-control" placeholder="Dropdown" name="bloodgroup">
                                    <option value="">Please Select:</option>
                                    <option value="A+" <?php if ($data->bloodgroup == 'A+') echo 'selected="selected"'; ?>>A+</option>
                                    <option value="B+" <?php if ($data->bloodgroup == 'B+') echo 'selected="selected"'; ?>>B+</option>
                                    <option value="AB+" <?php if ($data->bloodgroup == 'AB+') echo 'selected="selected"'; ?>>AB+</option>
                                    <option value="O+" <?php if ($data->bloodgroup == 'O+') echo 'selected="selected"'; ?>>O+</option>
                                    <option value="A-" <?php if ($data->bloodgroup == 'A-') echo 'selected="selected"'; ?>>A-</option>
                                    <option value="B-" <?php if ($data->bloodgroup == 'B-') echo 'selected="selected"'; ?>>B-</option>
                                    <option value="AB-" <?php if ($data->bloodgroup == 'AB-') echo 'selected="selected"'; ?>>AB-</option>
                                    <option value="O-" <?php if ($data->bloodgroup == 'A-') echo 'selected="selected"'; ?>>O-</option>
                                </select>
                                <?php echo form_error('bloodgroup', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Date of Birth</label>
                            <div class="col-sm-6">
                                <input  type="text" name="dob" class="form-control" value="<?php echo date('Y-m-d', strtotime($data->dob)); ?>" id="start-date" />
                                <?php echo form_error('start_date', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Image</label>
                            <div class="col-sm-6">
                                <img src="<?php echo base_url('assets/wallpaper/xsmall') . '/' . $data->image; ?>" width="100px" height="100px">
                                <input type="hidden" name="previousImage" value="<?php echo $data->image; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Change image</label>
                            <div class="col-sm-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span><input type="file" name="imagefile"></span>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                    <?php echo form_error('imagefile', '<p class="help-inline">', '</p>'); ?>
                                </div>
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
                                        <a href="<?php echo base_url('wallpaper'); ?>" class="btn btn-default">Cancel</a>
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
        window.location.replace("<?php echo base_url('users'); ?>");

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





