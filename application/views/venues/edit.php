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
                <li><a href="<?php echo base_url('Venues') ?>">venues</a></li>
                <li class="active">Edit venue</li>
            </ol>

            <h1>Edit venue</h1>
        </div>

        <div class="container">

            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4>Edit : venue</h4>
                    <div class="options">   
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body collapse in">
                    <form action="<?php echo base_url('venues/edit') . '/' . $data->id; ?>" class="form-horizontal row-border" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">City</label>
                            <div class="col-sm-6">
                                <select class="form-control" placeholder="Dropdown" name="city_id">
                                    <option value="">Please Select:</option>
                                    <?php foreach ($cityValue as $cityVal) { ?>
                                        <option value="<?php echo $cityVal->id; ?>"<?php echo $cityVal->id == $data->city_id?'selected':'';?>><?php echo $cityVal->city_title; ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('city_id', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="venue_title" placeholder="Title" value="<?php echo $data->venue_title; ?>">
                                <?php echo form_error('venue_title', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Location</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="venue_location" placeholder="Location" value="<?php echo $data->venue_location ?>">
                                <?php echo form_error('venue_location', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="venue_description" placeholder="Description" value="<?php echo $data->venue_description ?>">
                                <?php echo form_error('venue_description', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Age Limit</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="venue_age_limit" placeholder="Age Limit" value="<?php echo $data->venue_age_limit ?>">
                                <?php echo form_error('venue_age_limit', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Dress Code</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="venue_dress_code" placeholder="Dress code" value="<?php echo $data->venue_dress_code ?>">
                                <?php echo form_error('venue_dress_code', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Music</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="venue_music" placeholder="Music" value="<?php echo $data->venue_music ?>">
                                <?php echo form_error('venue_music', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Vip table</label>
                            <div class="col-sm-6">
                                <select class="form-control" placeholder="Dropdown" name="venue_vip_table">
                                    <option value="">Please Select:</option>
                                    <option value="1"<?php echo $data->venue_vip_table==1?'selected':'';?>>Yes</option>
                                    <option value="0"<?php echo $data->venue_vip_table==0?'selected':'';?> >No</option>
                                </select>
                                <?php echo form_error('venue_vip_table', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="btn-toolbar">
                                        <button class="btn-primary btn" id="submit">Update</button>
                                        <a href="<?php echo base_url('venues'); ?>" class="btn btn-default">Cancel</a>
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
        window.location.replace("<?php echo base_url('venues'); ?>");

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





