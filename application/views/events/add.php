<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="<?php echo base_url() ?>assets/datepicker/bootstrap-datetimepicker.js"></script>
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
                <li class='active'><a href="<?php echo base_url('events') ?>">Events</a></li>
                <li class=''>add</li>
            </ol>

            <h1>Add event </h1>
        </div>

        <div class="container">

            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4>Add form</h4>
                    <div class="options">   
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body collapse in">
                    <form action="<?php echo base_url('events/add'); ?>" class="form-horizontal row-border" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Venue</label>
                            <div class="col-sm-6">
                                <select class="form-control" placeholder="Dropdown" name="event_venue">
                                    <option value="">Please Select:</option>
                                    <?php foreach ($venueValue as $venueVal) { ?>
                                        <option value="<?php echo $venueVal->id; ?>" ><?php echo $venueVal->venue_title; ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('event_venue', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="event_title" placeholder="Title" value="<?php echo set_value('event_title') ?>">
                                <?php echo form_error('event_title', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="event_address" placeholder="Address" value="<?php echo set_value('event_address') ?>">
                                <?php echo form_error('event_address', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="event_email" placeholder="Email" value="<?php echo set_value('event_email') ?>">
                                <?php echo form_error('event_email', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mobile</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="event_mobile" placeholder="Mobile" value="<?php echo set_value('event_mobile') ?>">
                                <?php echo form_error('event_mobile', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Start Date</label>
                            <div class="col-sm-6">
                                <input type="text" name="event_start_date" class="form-control" id="start-date"/>
                                <?php echo form_error('event_start_date', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">End Date</label>
                            <div class="col-sm-6">
                                <input type="text" name="event_end_date" class="form-control" id="end-date"/>
                                <?php echo form_error('event_end_date', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Additional Info</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="event_additional_info" placeholder="Additional info" value="<?php echo set_value('event_additional_info') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Bottle service</label>
                            <div class="col-sm-6">
                                <select class="form-control" placeholder="Dropdown" name="bottle_service">
                                    <option value="">Please Select:</option>
                                    <option value="1" >Yes</option>
                                    <option value="0" >No</option>
                                </select>
                                <?php echo form_error('bottle_service', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">RSVP</label>
                            <div class="col-sm-6">
                                <select class="form-control" placeholder="Dropdown" name="rsvp">
                                    <option value="">Please Select:</option>
                                    <option value="1" >Yes</option>
                                    <option value="0" >No</option>
                                </select>
                                <?php echo form_error('rsvp', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="btn-toolbar">
                                        <button class="btn-primary btn" id="submit">Submit</button>
                                        <a href="<?php echo base_url('events'); ?>" class="btn btn-default">Cancel</a>
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
        window.location.replace("<?php echo base_url('events'); ?>");

    </script>
<?php } ?>
<?php if (isset($errorMsg)) { ?>
    <script>
        jError('<?php echo $errorMsg; ?>');

    </script>
<?php } ?>
<script>
    $(document).ready(function () {
        $('#start-date').datetimepicker({format: "YYYY/MM/DD h a"});
        $('#end-date').datetimepicker({format: "YYYY/MM/DD h a"});
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


