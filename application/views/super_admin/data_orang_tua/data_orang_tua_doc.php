<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Data_orang_tua List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Ayah</th>
		<th>NoHP Ayah</th>
		<th>Nama Ibu</th>
		<th>NoHP Ibu</th>
		<th>Provinsi</th>
		<th>Kab</th>
		<th>Kec</th>
		<th>Desa</th>
		<th>Rt/rw</th>
		
            </tr><?php
            foreach ($data_orang_tua_data as $data_orang_tua)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $data_orang_tua->nama_Ayah ?></td>
		      <td><?php echo $data_orang_tua->noHP_Ayah ?></td>
		      <td><?php echo $data_orang_tua->nama_Ibu ?></td>
		      <td><?php echo $data_orang_tua->noHP_Ibu ?></td>
		      <td><?php echo $data_orang_tua->provinsi ?></td>
		      <td><?php echo $data_orang_tua->kab ?></td>
		      <td><?php echo $data_orang_tua->kec ?></td>
		      <td><?php echo $data_orang_tua->desa ?></td>
		      <td><?php echo $data_orang_tua->rt/rw ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>