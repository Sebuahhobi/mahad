
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><?php echo $h2;?>
                <small>
					<?php echo anchor(site_url('super_admin/menu_mhs/create'), '<i class="fa fa-files-o"></i> Create', 'class="btn btn-sm btn-primary"'); ?>
					<?php echo anchor(site_url('super_admin/menu_mhs/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-sm btn-primary"'); ?>
					<?php echo anchor(site_url('super_admin/menu_mhs/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-sm btn-primary"'); ?>
					
				</small>
				<?php echo $this->session->flashdata("message");?>
			</h2><ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

        <div class="clearfix"></div>
        </div>
        <div class="x_content">
                    
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10px">No</th>
					    <th>Judul</th>
					    <th>Link</th>
					    <th>IsParent</th>
					    <th>Status Aktif</th>
					    <th>Action</th>
                    </tr>
                </thead>
			    <tbody>
                    <?php
                        $start = 0;
                        foreach ($menu_mhs_data as $menu_mhs)
                        {
                    ?>
                    <tr>
					    <td><?php echo ++$start ?></td>
					    <td><?php echo $menu_mhs->judul ?></td>
					    <td><?php echo $menu_mhs->link ?></td>
					    <td><?php echo $menu_mhs->IsParent ?></td>
					    <td><?php echo $menu_mhs->status_aktif ?></td>
					    <td style="text-align:center" width="140px">
					<?php 
						echo anchor(site_url('menu_mhs/read/'.$menu_mhs->id),'<i class="fa fa-eye"></i>','title="Detail" class="btn btn-sm btn-danger"'); 
						echo '  '; 
						echo anchor(site_url('super_admin/menu_mhs/update/'.$menu_mhs->id),'<i class="fa fa-edit"></i>','title="Edit Data" class="btn btn-sm btn-danger"'); 
						echo '  '; 
						echo anchor(site_url('super_admin/menu_mhs/delete/'.$menu_mhs->id),'<i class="fa fa-trash"></i>','title="Delete Data" class="btn btn-sm btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
    