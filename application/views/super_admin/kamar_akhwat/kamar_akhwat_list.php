<div class="">
    <div class="clearfix"></div>

    <div class="row">


        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>List Kamar akhwat<small>
		<?php echo anchor(site_url('super_admin/create_kamar_akhwat'), '<i class="fa fa-files-o"></i> Create', 'class="btn btn-sm btn-primary"'); ?>
		<?php echo anchor(site_url('super_admin/excel_kamar_akhwat'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-sm btn-primary"'); ?>
		<?php echo anchor(site_url('super_admin/word_kamar_akhwat'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-sm btn-primary"'); ?>
        <?php echo $this->session->flashdata('message');?>
        </small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
            <th width="10px">No</th>
            <th width="30px">Kamar</th>
            <th width="45px">Isi Max</th>
            <th width="55px">Status</th>
            <th>Kondisi</th>
            <th>Perlengkapan</th>
            <th width="60px">Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($kamar_akhwat_data as $kamar_akhwat)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $kamar_akhwat->kamar ?></td>
		    <td><?php echo $kamar_akhwat->isi_max ?></td>
		    <td><?php echo $kamar_akhwat->status=='p'?'Penuh':'Tidak Penuh' ?></td>
		    <td><?php echo $kamar_akhwat->kondisi ?></td>
            <td><?php echo $kamar_akhwat->perlengkapan ?></td>
		    <td style="text-align:center">
			<?php
			echo anchor(site_url('super_admin/update_kamar_akhwat/'.$kamar_akhwat->id),'<i class="fa fa-edit"></i>','title="Edit Data" class="btn btn-sm btn-danger"'); 
			echo '  '; 
			echo anchor(site_url('super_admin/delete_kamar_akhwat/'.$kamar_akhwat->id),'<i class="fa fa-trash"></i>','title="Delete Data" class="btn btn-sm btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
         </div>
            </div>
        </div>
    </div>
</div>
    