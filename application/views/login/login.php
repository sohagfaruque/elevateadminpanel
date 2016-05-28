<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Avant">
        <meta name="author" content="The Red Team">

        <!-- <link href="assets/less/styles.less" rel="stylesheet/less" media="all"> -->
        <link rel="stylesheet" href="assets/css/styles.min.css?=113">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>
        <script type='text/javascript' src='<?php echo base_url('assets') ?>/js/jquery-1.10.2.min.js'></script> 
        <script type='text/javascript' src='<?php echo base_url('assets') ?>/js/jqueryui-1.10.3.min.js'></script> 
        <!-- custom alert -->
        <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/customalert/jNotify.jquery.css" type="text/css" />
        <script src="<?php echo base_url('assets'); ?>/plugins/customalert/jNotify.jquery.js"></script>

<!-- <script type="text/javascript" src="assets/js/less.js"></script> -->
    </head><body class="focusedform">
        <?php if (isset($successMsg)) { ?>
            <script>
                jSuccess('<?php echo $successMsg; ?>');

            </script>
        <?php } ?>
        <?php if (isset($errorMsg)) { ?>
            <script>
                jError('<?php echo $errorMsg; ?>');

            </script>
        <?php } ?>


        <div class="verticalcenter">
            <a href="#"><img src="<?php echo base_url('assets/img/logo.png');?>" alt="Eleveate Admin" class="brand" /></a>
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h4 class="text-center" style="margin-bottom: 25px;">Log in to get started</h4>
                    <form action="<?php echo base_url('login'); ?>" class="form-horizontal" style="margin-bottom: 0px !important;" method="post">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" id="username" placeholder="Email" name="email">
                                    <?php echo form_error('email', '<p class="error-mas">', '</p>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    <?php echo form_error('password', '<p class="error-mas">', '</p>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="pull-right"><label><input type="checkbox" style="margin-bottom: 20px" checked=""> Remember Me</label></div>
                        </div>


                </div>
                <div class="panel-footer">
                    <a href="#" class="pull-left btn btn-link" style="padding-left:0">Forgot password?</a>

                    <div class="pull-right">
                        <a href="#" class="btn btn-default">Reset</a>
                        <button class="btn btn-primary">Log In</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

    </body>
</html>