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
        <h2>Kamar_ikhwan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kamar</th>
		<th>Isi Max</th>
		<th>Status</th>
		<th>Kondisi</th>
		
            </tr><?php
            foreach ($kamar_ikhwan_data as $kamar_ikhwan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $kamar_ikhwan->kamar ?></td>
		      <td><?php echo $kamar_ikhwan->isi_max ?></td>
		      <td><?php echo $kamar_ikhwan->status ?></td>
		      <td><?php echo $kamar_ikhwan->kondisi ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>