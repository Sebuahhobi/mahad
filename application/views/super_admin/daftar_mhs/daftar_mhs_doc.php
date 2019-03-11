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
        <h2>Daftar_mhs List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama</th>
		<th>Npm</th>
		<th>Fakultas</th>
		<th>Jurusan</th>
		<th>Semester</th>
		<th>Kamar</th>
		<th>Operator</th>
		<th>NoHP</th>
		
            </tr><?php
            foreach ($daftar_mhs_data as $daftar_mhs)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $daftar_mhs->nama ?></td>
		      <td><?php echo $daftar_mhs->npm ?></td>
		      <td><?php echo $daftar_mhs->fakultas ?></td>
		      <td><?php echo $daftar_mhs->jurusan ?></td>
		      <td><?php echo $daftar_mhs->semester ?></td>
		      <td><?php echo $daftar_mhs->kamar ?></td>
		      <td><?php echo $daftar_mhs->operator ?></td>
		      <td><?php echo $daftar_mhs->noHP ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>