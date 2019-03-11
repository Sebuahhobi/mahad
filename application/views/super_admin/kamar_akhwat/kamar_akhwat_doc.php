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
        <h2>Kamar_akhwat List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kamar</th>
		<th>Isi Max</th>
		<th>Status</th>
		<th>Kondisi</th>
		
            </tr><?php
            foreach ($kamar_akhwat_data as $kamar_akhwat)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kamar_akhwat->kamar ?></td>
		      <td><?php echo $kamar_akhwat->isi_max ?></td>
		      <td><?php echo $kamar_akhwat->status ?></td>
		      <td><?php echo $kamar_akhwat->kondisi ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>