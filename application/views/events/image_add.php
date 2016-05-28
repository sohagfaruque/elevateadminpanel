<link rel='stylesheet' type='text/css' href='<?php echo base_url('assets') ?>/plugins/jqueryui-timepicker/jquery.ui.timepicker.css' /> 
<link rel='stylesheet' type='text/css' href='<?php echo base_url('assets') ?>/js/jqueryui.css' />
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('dashboard') ?>">Dashboard</a></li>
                <li class='active'><a href="<?php echo base_url('events') ?>">events</a></li>
                <li class=''><?php echo $eventValue[0]->event_title; ?></li>
                <li class=''>images add</li>
            </ol>

            <h1>Add image </h1>
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
                    <form action="<?php echo base_url('events/imagesadd') . '/' . $eventValue[0]->id; ?>" class="form-horizontal row-border" method="post" enctype="multipart/form-data">
                        <div class="input_fields_wrap">
                            <button class="add_field_button">Add More</button>
                            <div class="form-group maindiv">
                                <label class="col-sm-3 control-label">Image</label>
                                <div class="col-sm-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span><input type="file" name="imagefile[]"></span>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="event_id" value="as">

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="btn-toolbar">
                                        <button class="btn-primary btn" id="submit">Submit</button>
                                        <a href="<?php echo base_url('events/images') . '/' . $eventValue[0]->id; ?>" class="btn btn-default">Cancel</a>
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
        window.location.replace("<?php echo base_url('events/images') . '/' . $eventValue[0]->id; ?>");

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
<script>
    $(document).ready(function () {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                var a = '<div class="form-group maindiv"><label class="col-sm-3 control-label">Image</label><div class="col-sm-3 inputfile"><div class="fileinput fileinput-new" data-provides="fileinput"><div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div><div><span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="imagefile[]"></span><a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a></div></div></div><a href="#" class="remove_field">Remove</a></div>';
                $(wrapper).append(a); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>


