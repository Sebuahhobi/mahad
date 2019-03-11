<div class="">
    <div class="clearfix"></div>

    <div class="row">


        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Users<small>
		<?php echo anchor(site_url('super_admin/create'), '<i class="fa fa-files-o"></i> Create', 'class="btn btn-sm btn-primary"'); ?>
		<?php echo anchor(site_url('super_admin/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-sm btn-primary"'); ?>
		<?php echo anchor(site_url('super_admin/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-sm btn-primary"'); ?></small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    
        <table class="table table-bordered table-striped" id="datatable-buttons">
            <thead>
                <tr>
                    <th width="10px">No</th>
		    <th>Ip Address</th>
		    <th>Username</th>
		    <th>Password</th>
		    <th>Salt</th>
		    <th>Email</th>
		    <th>Activation Code</th>
		    <th>Forgotten Password Code</th>
		    <th>Forgotten Password Time</th>
		    <th>Remember Code</th>
		    <th>Created On</th>
		    <th>Last Login</th>
		    <th>Active</th>
		    <th>First Name</th>
		    <th>Last Name</th>
		    <th>Company</th>
		    <th>Phone</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($super_admin_data as $super_admin)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $super_admin->ip_address ?></td>
		    <td><?php echo $super_admin->username ?></td>
		    <td><?php echo $super_admin->password ?></td>
		    <td><?php echo $super_admin->salt ?></td>
		    <td><?php echo $super_admin->email ?></td>
		    <td><?php echo $super_admin->activation_code ?></td>
		    <td><?php echo $super_admin->forgotten_password_code ?></td>
		    <td><?php echo $super_admin->forgotten_password_time ?></td>
		    <td><?php echo $super_admin->remember_code ?></td>
		    <td><?php echo $super_admin->created_on ?></td>
		    <td><?php echo $super_admin->last_login ?></td>
		    <td><?php echo $super_admin->active ?></td>
		    <td><?php echo $super_admin->first_name ?></td>
		    <td><?php echo $super_admin->last_name ?></td>
		    <td><?php echo $super_admin->company ?></td>
		    <td><?php echo $super_admin->phone ?></td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
                 </div>
            </div>
        </div>

       
            </div>
        </div>