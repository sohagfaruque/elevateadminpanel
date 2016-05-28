<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?> || Elevate App Admin</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Book bangladesh">
        <meta name="author" content="sohag">

    <!-- <link href="<?php echo base_url('assets') ?>/less/styles.less" rel="stylesheet/less" media="all">  -->
        <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/styles.css?=121">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>


        <link href='<?php echo base_url('assets') ?>/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='styleswitcher'> 

        <link href='<?php echo base_url('assets') ?>/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher'> 

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/ie8.css">
                <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets') ?>/plugins/charts-flot/excanvas.min.js"></script>
        <![endif]-->

        <!-- The following CSS are included as plugins and can be removed if unused-->

        <link rel='stylesheet' type='text/css' href='<?php echo base_url('assets') ?>/plugins/form-daterangepicker/daterangepicker-bs3.css' /> 
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('assets') ?>/plugins/fullcalendar/fullcalendar.css' /> 
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('assets') ?>/plugins/form-markdown/css/bootstrap-markdown.min.css' /> 
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('assets') ?>/plugins/codeprettifier/prettify.css' /> 
        <link rel='stylesheet' type='text/css' href='<?php echo base_url('assets') ?>/plugins/form-toggle/toggles.css' />

        <script type='text/javascript' src='<?php echo base_url('assets') ?>/js/jquery-1.10.2.min.js'></script> 
        <script type='text/javascript' src='<?php echo base_url('assets') ?>/js/jqueryui-1.10.3.min.js'></script> 
        <!-- custom alert -->
        <link rel="stylesheet" href="<?php echo base_url('assets'); ?>/plugins/customalert/jNotify.jquery.css" type="text/css" />
        <script src="<?php echo base_url('assets'); ?>/plugins/customalert/jNotify.jquery.js"></script>
        <!-- custom confirm -->
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins'); ?>/customconfirm/alertify.core.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins'); ?>/customconfirm/alertify.default.css" type="text/css" />
        <script src="<?php echo base_url('assets/plugins'); ?>/customconfirm/alertify.min.js"></script>
        <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/plugins/form-select2/select2.css' /> 
        <link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>assets/plugins/form-multiselect/css/multi-select.css' /> 

<!-- <script type="text/javascript" src="<?php echo base_url('assets') ?>/js/less.js"></script> -->
        <style>
            .help-inline{
                color: #a81515;
            }

        </style>
    </head>

    <body class="">
        <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
            <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar"></a>
            <div class="navbar-header pull-left">
                <a class="navbar-brand" href="<?php echo base_url('home'); ?>"></a>
            </div>

            <ul class="nav navbar-nav pull-right toolbar">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle username" data-toggle="dropdown">
                        <span class="hidden-xs"><?php echo $this->session->userdata('username'); ?> <i class="fa fa-caret-down"></i></span>
                        <img alt="" src="assets/demo/avatar/dangerfield.png">
                    </a>
                    <ul class="dropdown-menu userinfo arrow">
                        <li class="userlinks">
                            <ul class="dropdown-menu">
                                <li><a href="#">View Profile <i class="pull-right fa fa-search"></i></a></li>
                                <li><a href="<?php echo base_url('account/edit') . '/' . $this->session->userdata('loged_user_id'); ?>">Settings <i class="pull-right fa fa-cog"></i></a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url('login/logout') ?>" class="text-right">Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown demodrop">
                    <a href="#" class="dropdown-toggle tooltips" data-toggle="dropdown"><i class="fa fa-magic"></i></a>

                    <ul class="dropdown-menu arrow dropdown-menu-form" id="demo-dropdown">
                        <li>
                            <label for="demo-header-variations" class="control-label">Header Colors</label>
                            <ul class="list-inline demo-color-variation" id="demo-header-variations">
                                <li><a class="color-black" href="javascript:;"  data-headertheme="header-black.css"></a></li>
                                <li><a class="color-dark" href="javascript:;"  data-headertheme="default.css"></a></li>
                                <li><a class="color-red" href="javascript:;" data-headertheme="header-red.css"></a></li>
                                <li><a class="color-blue" href="javascript:;" data-headertheme="header-blue.css"></a></li>
                            </ul>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <label for="demo-color-variations" class="control-label">Sidebar Colors</label>
                            <ul class="list-inline demo-color-variation" id="demo-color-variations">
                                <li><a class="color-lite" href="javascript:;"  data-theme="default.css"></a></li>
                                <li><a class="color-steel" href="javascript:;" data-theme="sidebar-steel.css"></a></li>
                                <li><a class="color-lavender" href="javascript:;" data-theme="sidebar-lavender.css"></a></li>
                                <li><a class="color-green" href="javascript:;" data-theme="sidebar-green.css"></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </header>

        <div id="page-container">
            <!-- BEGIN SIDEBAR -->
            <nav id="page-leftbar" role="navigation">
                <!-- BEGIN SIDEBAR MENU -->
                <ul class="acc-menu" id="sidebar">
                    <?php
                    $uriSegment = $this->uri->segment(1);
                    ?>
                    <li <?php echo ($uriSegment == 'dashboard' ? 'active' : ''); ?>><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>

                    <li <?php echo ($uriSegment == 'admin' ? 'active' : ''); ?>><a href="javascript:;"><i class="fa fa-list-alt"></i> <span>Admin</span> </a>
                        <ul class="acc-menu">
                            <li><a href="<?php echo base_url('admin'); ?>"><span>List</span></a></li>
                            <li><a href="<?php echo base_url('admin/add'); ?>"><span>Add New</span></a></li>
                        </ul>
                    </li>
                    <li <?php echo ($uriSegment == 'cities' ? 'active' : ''); ?>><a href="javascript:;"><i class="fa fa-list-alt"></i> <span>Cities</span> </a>
                        <ul class="acc-menu">
                            <li><a href="<?php echo base_url('cities'); ?>"><span>List</span></a></li>
                            <li><a href="<?php echo base_url('cities/add'); ?>"><span>Add New</span></a></li>
                        </ul>
                    </li>
                    <li <?php echo ($uriSegment == 'venues' ? 'active' : ''); ?>><a href="javascript:;"><i class="fa fa-list-alt"></i> <span>Venues</span> </a>
                        <ul class="acc-menu">
                            <li><a href="<?php echo base_url('venues'); ?>"><span>List</span></a></li>
                            <li><a href="<?php echo base_url('venues/add'); ?>"><span>Add New</span></a></li>
                        </ul>
                    </li>
                    <li <?php echo ($uriSegment == 'events' ? 'active' : ''); ?>><a href="javascript:;"><i class="fa fa-list-alt"></i> <span>Events</span> </a>
                        <ul class="acc-menu">
                            <li><a href="<?php echo base_url('events'); ?>"><span>List</span></a></li>
                            <li><a href="<?php echo base_url('events/add'); ?>"><span>Add New</span></a></li>
                        </ul>
                    </li>

                </ul>
                <!-- END SIDEBAR MENU -->
            </nav>

            <!-- BEGIN RIGHTBAR -->
            <div id="page-rightbar">

                <div id="chatarea">
                    <div class="chatuser">
                        <span class="pull-right">Jane Smith</span>
                        <a id="hidechatbtn" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="chathistory">
                        <div class="chatmsg">
                            <p>Hey! How's it going?</p>
                            <span class="timestamp">1:20:42 PM</span>
                        </div>
                        <div class="chatmsg sent">
                            <p>Not bad... i guess. What about you? Haven't gotten any updates from you in a long time.</p>
                            <span class="timestamp">1:20:46 PM</span>
                        </div>
                        <div class="chatmsg">
                            <p>Yeah! I've been a bit busy lately. I'll get back to you soon enough.</p>
                            <span class="timestamp">1:20:54 PM</span>
                        </div>
                        <div class="chatmsg sent">
                            <p>Alright, take care then.</p>
                            <span class="timestamp">1:21:01 PM</span>
                        </div>
                    </div>
                    <div class="chatinput">
                        <textarea name="" rows="2"></textarea>
                    </div>
                </div>

            </div>
            <!-- END RIGHTBAR -->
