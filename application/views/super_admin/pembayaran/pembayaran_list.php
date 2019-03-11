
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><?php echo $h2;?>
                <small>
					<?php echo anchor($url_create, '<i class="fa fa-files-o"></i> Create', 'class="btn btn-sm btn-primary"'); ?>
                    <?php echo anchor(site_url('pembayaran/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-sm btn-primary"'); ?>
                    <?php echo anchor(site_url('pembayaran/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-sm btn-primary"'); ?></small></h2>
        
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
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th>Nama</th>
                        <th>No. Kamar</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Operator</th>
                        <th>Tgl Hari Ini</th>
                        <th>Tgl Pembayaran</th>
                        <th width="60px">Action</th>
                    </tr>
                </thead>
			    <tbody>
            <?php
            $start = 0;
            foreach ($pembayaran_data as $pembayaran)
            {
                $data_mhs   = $this->Pembayaran_model->get_data_mhs_by_id($pembayaran->id_mhs);
                foreach ($data_mhs as $mhs) {
                    $get_kamar="";
                    if($mhs->j_k="L"){
                        $get_kamar=$this->Pembayaran_model->get_kamar_mhs_ikhwan_by_id($mhs->kamar);
                    }
                    else{
                        $get_kamar=$this->Pembayaran_model->get_kamar_mhs_akhwat_by_id($mhs->kamar);
                    }
                    foreach ($get_kamar as $kamar) {
                        
                ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $mhs->nama ?></td>
                    <td><?php echo $kamar->kamar ?></td>
                    <td><?php echo $pembayaran->jumlah_pembayaran ?></td>
                    <td><?php echo $pembayaran->operator ?></td>
                    <td><?php echo tgl_indo($pembayaran->tgl_hari_ini) ?></td>
                    <td><?php echo tgl_indo($pembayaran->tgl_pembayaran) ?></td>
                    <td style="text-align:center">
            <?php
            echo anchor(site_url('super_admin/update_pembayaran/'.$pembayaran->id),'<i class="fa fa-edit"></i>','title="Edit Data" class="btn btn-sm btn-danger"'); 
            echo '  '; 
            echo anchor(site_url('super_admin/delete_pembayaran/'.$pembayaran->id),'<i class="fa fa-trash"></i>','title="Delete Data" class="btn btn-sm btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
            ?>
            </td>
            </tr>
                <?php
                    }
                }
            }
            ?>
            </tbody>
            </table>
        </div>
    </div>
</div>
    