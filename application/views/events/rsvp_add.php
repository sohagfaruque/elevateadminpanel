<link rel='stylesheet' type='text/css' href='<?php echo base_url('assets') ?>/plugins/jqueryui-timepicker/jquery.ui.timepicker.css' /> 
<link rel='stylesheet' type='text/css' href='<?php echo base_url('assets') ?>/js/jqueryui.css' />
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
           <ol class="breadcrumb">
                <li><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
                <li class='active'><a href="<?php echo base_url('events') ?>">Events</a></li>
                <li class=''><?php echo $eventValue[0]->event_title; ?></li>
                <li class=''>rsvp add</li>
            </ol>

            <h1>Add RSVP </h1>
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
                    <form action="<?php echo base_url('events/rsvpadd').'/'.$eventValue[0]->id; ?>" class="form-horizontal row-border" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="rsvp_description" placeholder="Description" value="<?php echo set_value('rsvp_description') ?>">
                                <?php echo form_error('rsvp_description', '<p class="help-inline">', '</p>'); ?>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="btn-toolbar">
                                        <button class="btn-primary btn" id="submit">Submit</button>
                                        <a href="<?php echo base_url('events/rsvp').'/'.$eventValue[0]->id; ?>" class="btn btn-default">Cancel</a>
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
        window.location.replace("<?php echo base_url('events/rsvp').'/'.$eventValue[0]->id; ?>");

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


