<div class="">
    <div class="clearfix"></div>

    <div class="row">


        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo $judul;?><small></small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
            <th width="5px">No</th>
		    <th>Nama Ayah</th>
		    <th>NoHP Ayah</th>
		    <th>Nama Ibu</th>
		    <th>NoHP Ibu</th>
            <th>Nama Anak</th>
		    <th>Provinsi</th>
		    <th>Kab</th>
		    <th>Kec</th>
		    <th>Desa</th>
		    <th>Rt/rw</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($data_orang_tua_data as $data_orang_tua)
            {
                $provinsi=$this->db->get_where('provinces',array('id'=>$data_orang_tua->provinsi));
                foreach ($provinsi->result() as $prov)
                {
                    $kabupaten=$this->db->get_where('regencies',array('id'=>$data_orang_tua->kab));
                    foreach ($kabupaten->result() as $kab)
                    {
                        $kecamatan=$this->db->get_where('districts',array('id'=>$data_orang_tua->kec));
                        foreach ($kecamatan->result() as $kec)
                        {
                            $anak=$this->db->get_where('daftar_mhs',array('id'=> $data_orang_tua->id_mhs));
                            foreach ($anak->result() as $anakOrangTua)
                            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $data_orang_tua->nama_Ayah ?></td>
		    <td><?php echo $data_orang_tua->noHP_Ayah ?></td>
		    <td><?php echo $data_orang_tua->nama_Ibu ?></td>
		    <td><?php echo $data_orang_tua->noHP_Ibu ?></td>
            <td><?php echo $anakOrangTua->nama ?></td>
		    <td><?php echo $prov->name ?></td>
		    <td><?php echo $kab->name ?></td>
		    <td><?php echo $kec->name ?></td>
		    <td><?php echo $data_orang_tua->desa ?></td>
		    <td><?php echo $data_orang_tua->rt ?></td>
		    
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
    