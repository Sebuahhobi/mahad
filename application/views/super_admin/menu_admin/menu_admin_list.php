
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Menu Admin<small>
                <?php echo anchor(site_url('admin/menu/create'), '<i class="fa fa-files-o"></i> Create', 'class="btn btn-sm btn-primary"'); ?></small>
                <?php echo $this->session->flashdata("message") <> "" ? $this->session->flashdata("message") : ""; ?>
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">       
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th>Judul</th>
                        <th>Link</th>
                        <th>Icon</th>
                        <th>IsParent</th>
                        <th>Status Aktif</th>                              
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $start = 0;
                        foreach ($menu_admin_data as $menu)
                        {
                    ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td><?php echo $menu->judul ?></td>
                        <td><?php echo $menu->link ?></td>
                        <td><?php echo $menu->icon ?></td>
                        <td><?php echo $menu->IsParent ?></td>
                        <td><?php echo $menu->status_aktif=='y'?'AKTIF':'TIDAK AKTIF' ?></td>
                        <td style="text-align:center" width="91px">
                            <?php 
                            echo anchor(site_url('/super_admin/update_menu_admin/'.$menu->id),'<i class="fa fa-edit"></i>','title="Edit Data" class="btn btn-sm btn-danger"'); 
                            echo '  '; 
                            echo anchor(site_url('/super_admin/delete_menu_admin/'.$menu->id),'<i class="fa fa-trash"></i>','title="Delete Data" class="btn btn-sm btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
    