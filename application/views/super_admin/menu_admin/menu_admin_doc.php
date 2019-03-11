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
        <h2>Menu_super_admin List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Judul</th>
		<th>Link</th>
		<th>Icon</th>
		<th>IsParent</th>
		<th>Status Aktif</th>
		
            </tr><?php
            foreach ($menu_super_admin_data as $menu_super_admin)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $menu_super_admin->judul ?></td>
		      <td><?php echo $menu_super_admin->link ?></td>
		      <td><?php echo $menu_super_admin->icon ?></td>
		      <td><?php echo $menu_super_admin->IsParent ?></td>
		      <td><?php echo $menu_super_admin->status_aktif ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>