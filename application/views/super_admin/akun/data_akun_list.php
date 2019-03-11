    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo lang('index_heading');?><small>
		            <?php echo anchor(site_url('super_admin/create_akun_super_admin'), '<daftar_mhsi class="fa fa-files-o"></i> Tambah Akun Super Admin', 'class="btn btn-sm btn-primary"'); ?>
                    <?php echo anchor(site_url('super_admin/create_akun_admin'), '<daftar_mhsi class="fa fa-files-o"></i> Tambah Akun Admin', 'class="btn btn-sm btn-primary"'); ?>
                    <?php echo anchor(site_url('super_admin/create_akun_mhs'), '<daftar_mhsi class="fa fa-files-o"></i> Tambah Akun Mahasiswa', 'class="btn btn-sm btn-primary"'); ?>
                        <br><?php echo lang('index_subheading');?>
                        </small>
                    </h2>
                    <small id="infoMessage" class="blue"><?php echo $message;?></small>
                            <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="10px">No</th>
		    <th><?php echo lang('index_fname_th');?></th>
                    <th><?php echo lang('index_lname_th');?></th>
                    <th><?php echo lang('index_email_th');?></th>
                    <th><?php echo lang('index_groups_th');?></th>
                    <th><?php echo lang('index_status_th');?></th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($users as $user)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
                    <td>
			<?php foreach ($user->groups as $group):?>
                            <?php echo anchor("super_admin/edit_grup/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                        <?php endforeach?>
                    </td>
                    <td><?php echo ($user->active) ? anchor('super_admin/deactivate/'.$user->id, lang('index_active_link'),'class="blue"') : anchor("super_admin/activate/". $user->id, lang('index_inactive_link'),'class="red"');?></td>
                    <td style="text-align:center" width="91px">
			<?php
                            echo anchor(site_url('super_admin/edit_akun/'.$user->id),'<i class="fa fa-edit"></i>','title="Edit Data" class="btn btn-sm btn-danger"'); 
                            echo '  '; 
                            echo anchor(site_url('super_admin/delete_akun/'.$user->id),'<i class="fa fa-trash"></i>','title="Delete Data" class="btn btn-sm btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
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
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>