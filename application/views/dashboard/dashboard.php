<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <ol class="breadcrumb">
                <li class='active'><a href="<?php echo base_url(); ?>">Dashboard</a></li>
            </ol>

            <h1>Dashboard</h1>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <a href="<?php echo base_url('admin') ?>" class="info-tiles tiles-midnightblue">
                                <div class="tiles-heading">Admins</div>
                                <div class="tiles-body-alt">
                                    <i class="icon-shopping-cart"></i>
                                    <div class="text-center"><?php echo count($adminValue); ?></div>
                                    <small>All Admins</small>
                                </div>
                                <div class="tiles-footer">Manage info</div>
                            </a>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <a class="info-tiles tiles-grape" href="<?php echo base_url('users') ?>">
                                <div class="tiles-heading">Users</div>
                                <div class="tiles-body-alt">
                                    <i class="fa icon-group"></i>
                                    <div class="text-center"><?php echo count($userValue); ?></div>
                                    <small>All users</small>
                                </div>
                                <div class="tiles-footer">Manage info</div>
                            </a>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <a class="info-tiles tiles-grape" href="<?php echo base_url('users') ?>">
                                <div class="tiles-heading">Cities</div>
                                <div class="tiles-body-alt">
                                    <i class="fa icon-group"></i>
                                    <div class="text-center"><?php echo count($userValue); ?></div>
                                    <small>All cities</small>
                                </div>
                                <div class="tiles-footer">Manage info</div>
                            </a>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <a class="info-tiles tiles-grape" href="<?php echo base_url('users') ?>">
                                <div class="tiles-heading">Venues</div>
                                <div class="tiles-body-alt">
                                    <i class="fa icon-group"></i>
                                    <div class="text-center"><?php echo count($venueValue); ?></div>
                                    <small>All venues</small>
                                </div>
                                <div class="tiles-footer">Manage info</div>
                            </a>
                        </div>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <a class="info-tiles tiles-grape" href="<?php echo base_url('users') ?>">
                                <div class="tiles-heading">Events</div>
                                <div class="tiles-body-alt">
                                    <i class="fa icon-group"></i>
                                    <div class="text-center"><?php echo count($eventValue); ?></div>
                                    <small>All venues</small>
                                </div>
                                <div class="tiles-footer">Manage info</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">        

                <!--                <div class="col-md-12">
                                    <div class="panel panel-grape">
                                        <div class="panel-heading">
                                            <h4>Latest Users</h4>
                                            <div class="options">
                                                <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table" style="margin-bottom: 0px;">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-xs-9 col-sm-4">Email</th>
                                                            <th class="ccol-xs-9 col-sm-2">Mobile</th>
                                                            <th class="col-xs-9 col-sm-3"></th>
                                                            <th class="col-xs-9 col-sm-2">User</th>
                                                            <th class="col-xs-9 col-sm-2">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="selects">
                <?php
                foreach ($latestNews as $newsVal) {
                    if ($newsVal->userType == 1) {
                        $type = 'Admin';
                    }
                    if ($newsVal->userType == 2) {
                        $type = 'Editor';
                    }
                    if ($newsVal->userType == 3) {
                        $type = 'Author';
                    }
                    ?>
                                                                <tr>
                                                                    <td><?php echo $newsVal->newsName; ?></td>
                                                                    <td><?php echo $newsVal->category; ?></td>
                                                                     <td><?php echo date('j\<\s\u\p\>S\<\/\s\u\p\> M Y h:i a', strtotime($newsVal->insert_date)) ?></td>
                                                                     <td><?php echo $newsVal->userName; ?> (<?php echo $type; ?>)</td>
                                                                    <td><?php echo ($newsVal->sponsored == 1 ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'); ?></td>
                                                                    <td><?php echo ($newsVal->status == 1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>'); ?></td>
                                                                </tr>
                <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->

            </div>

        </div> <!-- container -->
    </div> <!--wrap -->
</div> <!-- page-content -->