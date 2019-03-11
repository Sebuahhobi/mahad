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
        <h2>Menu_mhs List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Judul</th>
		<th>Link</th>
		<th>IsParent</th>
		<th>Status Aktif</th>
		
            </tr><?php
            foreach ($menu_mhs_data as $menu_mhs)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $menu_mhs->judul ?></td>
		      <td><?php echo $menu_mhs->link ?></td>
		      <td><?php echo $menu_mhs->IsParent ?></td>
		      <td><?php echo $menu_mhs->status_aktif ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>