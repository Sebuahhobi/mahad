<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2><?php echo $h2;?><small>
		        <?php echo anchor($create, '<daftar_mhsi class="fa fa-files-o"></i> Create', 'class="btn btn-sm btn-primary"'); ?></small>
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
            <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="7px">No</th>
            		    <th>Nama</th>
                        <th>Nama Ibu</th>
            		    <th width="30px">NPM</th>
            		    <th>Fakultas</th>
            		    <th>Jurusan</th>
            		    <th width="30px">Semester</th>
            		    <th width="15px">Kamar</th>
            		    <th>NoHP</th>
            		    <th>Action</th>
                    </tr>
                </thead>
        	    <tbody>
                    <?php
                    $start = 0;
                    foreach ($daftar_mhs_data as $daftar_mhs)
                    {

                        if($daftar_mhs->j_k=="L")
                            $get_kamar    =$this->db->get_where('kamar_ikhwan',array('id'=>$daftar_mhs->kamar));
                        elseif($daftar_mhs->j_k=="P")
                            $get_kamar    =$this->db->get_where('kamar_akhwat',array('id'=>$daftar_mhs->kamar));

                        foreach ($get_kamar->result() as $kamar) {
                                        
                        ?>
                        <tr>
        		    <td><?php echo ++$start ?></td>
        		    <td><?php echo $daftar_mhs->nama ?></td>
                    <td><?php echo get_data('data_orang_tua', 'nama_Ibu', $daftar_mhs->id, 'id') ?></td>
        		    <td><?php echo $daftar_mhs->npm ?></td>
        		    <td><?php echo get_data('fakultas', 'nama_fakultas', $daftar_mhs->fakultas, 'id') ?></td>
        		    <td><?php echo get_data('jurusan', 'nama_jurusan', $daftar_mhs->jurusan, 'id') ?></td>
                    <td><?php echo $daftar_mhs->semester ?></td>
        		    <td><?php echo $kamar->kamar ?></td>
        		    <td><?php echo $daftar_mhs->noHP ?></td>
        		    <td style="text-align:center" width="140px">
        			<?php 
                    echo anchor(site_url('admin/mhs/read_ikhwan/'.$daftar_mhs->id),'<i class="fa fa-eye"></i>','title="Read" class="btn btn-sm btn-danger"'); 
                    echo '  '; 
        			echo anchor(site_url('admin/mhs/update_ikhwan/'.$daftar_mhs->id),'<i class="fa fa-edit"></i>','title="Edit Data" class="btn btn-sm btn-danger"'); 
        			echo '  '; 
        			echo anchor(site_url('admin/mhs/delete/'.$daftar_mhs->id),'<i class="fa fa-trash"></i>','title="Delete Data" class="btn btn-sm btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
        			?>
        		    </td>
        	        </tr>
                        <?php
                        }
                    }
                    ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>