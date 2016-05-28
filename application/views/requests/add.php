<link rel='stylesheet' type='text/css' href='<?php echo base_url('assets') ?>/plugins/jqueryui-timepicker/jquery.ui.timepicker.css' /> 
<link rel='stylesheet' type='text/css' href='<?php echo base_url('assets') ?>/js/jqueryui.css' />
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('home') ?>">Dashboard</a></li>
                <li><a href="<?php echo base_url('users') ?>">users</a></li>
                <li class="active">Add users</li>
            </ol>

            <h1>Add users </h1>
        </div>

        <div class="container">

            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4>User add form</h4>
                    <div class="options">   
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body collapse in">
                    <form action="<?php echo base_url('users/add'); ?>" class="form-horizontal row-border" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" value="<?php echo set_value('name') ?>" placeholder="Name">
                                <?php echo form_error('name', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="email" value="<?php echo set_value('email') ?>" placeholder="Email">
                                <?php echo form_error('email', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Phone</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="phone" placeholder="" value="<?php echo set_value('phone') ?>">
                                <?php echo form_error('phone', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="password" placeholder="" value="<?php echo set_value('password') ?>">
                                <?php echo form_error('password', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Longitude</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="longitude" placeholder="" value="<?php echo set_value('longitude') ?>">
                                <?php echo form_error('longitude', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Latitude</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="latitude" placeholder="" value="<?php echo set_value('latitude') ?>">
                                <?php echo form_error('latitude', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gender</label>
                            <div class="col-sm-6">
                                <select class="form-control" placeholder="Dropdown" name="gender">
                                    <option value="">Please Select:</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Other</option>
                                </select>
                                <?php echo form_error('gender', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Date of Birth</label>
                            <div class="col-sm-6">
                                <input  type="text" name="dob" class="form-control" value="<?php echo set_value('dob') ?>" id="start-date" />
                                <?php echo form_error('dob', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Blood group</label>
                            <div class="col-sm-6">
                                <select class="form-control" placeholder="Dropdown" name="bloodgroup">
                                    <option value="">Please Select:</option>
                                    <option value="A+">A+</option>
                                    <option value="B+">B+</option>
                                    <option value="AB+">AB+</option>
                                    <option value="O+">O+</option>
                                    <option value="A-">A-</option>
                                    <option value="B-">B-</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O-">O-</option>
                                </select>
                                <?php echo form_error('bloodgroup', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Image</label>
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
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="btn-toolbar">
                                        <button class="btn-primary btn" id="submit">Submit</button>
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
            var imagefile = $("input[name='imagefile']").val();
            var displayOrder = $("input[name='display_order']").val();
            if (displayOrder == '') {
                jNotify('Display Order must be filled.');
                return false;
            } else {
                if (imagefile == '') {
                    jNotify('Image must be selected.');
                    return false;
                } else {

                }
            }

        });
        return false;

    });
</script>


