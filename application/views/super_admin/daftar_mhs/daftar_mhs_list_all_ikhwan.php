<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>List Mahasiswa<small>
            <?php echo anchor(site_url('super_admin/create_mhs'), '<i class="fa fa-files-o"></i> Create', 'class="btn btn-sm btn-primary"'); ?></small>
            </h2>
            <?php echo $this->session->flashdata("message") <> "" ? $this->session->flashdata("message") : ""; ?>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        
            <table class="table table-bordered table-striped" id="datatable-buttons">
                <thead>
                    <tr>
            		    <th width="10px">No</th>
            		    <th>Nama</th>
            		    <th>NPM</th>
            		    <th>Fakultas</th>
            		    <th>Jurusan</th>
            		    <th>Semester</th>
            		    <th>Kamar</th>
            		    <th>Operator</th>
            		    <th>NoHP</th>
            		    <th>J K</th>
            		    <th>Tgl Lahir</th>
            		    <th>Ttl</th>
            		    <th>Sertifikat Ldik</th>
            		    <th>Foto</th>
            		    <th>Bahasa</th>
            		    <th>Hobi</th>
            		    <th>Keahlian</th>
            		    <th>Cita Cita</th>
            		    <th>Action</th>
                    </tr>
                </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($daftar_mhs_data as $daftar_mhs)
            {
                $get_ibu = $this->db->get_where('data_orang_tua',array('id_mhs'=>$daftar_mhs->id));
                foreach ($get_ibu->result() as $ibu) {
    
                    $get_fakultas = $this->db->get_where('fakultas',array('id'=>$daftar_mhs->fakultas));
                    foreach ($get_fakultas->result() as $fakultas) {

                        $get_Jurusan  =$this->db->get_where('jurusan',array('id'=>$daftar_mhs->jurusan));
                        foreach ($get_Jurusan->result() as $jurusan) {

                            if($daftar_mhs->j_k=="L")
                                $get_kamar    =$this->db->get_where('kamar_ikhwan',array('id'=>$daftar_mhs->kamar));
                            elseif($daftar_mhs->j_k=="P")
                                $get_kamar    =$this->db->get_where('kamar_akhwat',array('id'=>$daftar_mhs->kamar));

                            foreach ($get_kamar->result() as $kamar) {
                  
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $daftar_mhs->nama ?></td>
		    <td><?php echo $daftar_mhs->npm ?></td>
		    <td><?php echo $fakultas->nama_fakultas ?></td>
		    <td><?php echo $jurusan->nama_jurusan ?></td>
		    <td><?php echo $daftar_mhs->semester ?></td>
		    <td><?php echo $kamar->kamar ?></td>
		    <td><?php echo $daftar_mhs->operator ?></td>
		    <td><?php echo $daftar_mhs->noHP ?></td>
		    <td><?php echo $daftar_mhs->j_k=='L'?'Laki-laki':'Perempuan' ?></td>
		    <td><?php echo $daftar_mhs->tgl_lahir ?></td>
		    <td><?php echo $daftar_mhs->ttl ?></td>
		    <td><?php echo $daftar_mhs->sertifikat_ldik ?></td>
		    <td><?php echo $daftar_mhs->foto ?></td>
		    <td><?php echo $daftar_mhs->bahasa ?></td>
		    <td><?php echo $daftar_mhs->hobi ?></td>
		    <td><?php echo $daftar_mhs->keahlian ?></td>
		    <td><?php echo $daftar_mhs->cita_cita ?></td>
		    <td style="text-align:center" width="91px">
			<?php 
			echo anchor(site_url('super_admin/update_mhs/'.$daftar_mhs->id),'<i class="fa fa-edit"></i>','title="Edit Data" class="btn btn-sm btn-danger"'); 
			echo '  '; 
			echo anchor(site_url('super_admin/delete_mhs/'.$daftar_mhs->id),'<i class="fa fa-trash"></i>','title="Delete Data" class="btn btn-sm btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
                }
                        }
                    }
                }
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