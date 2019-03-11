<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Menu_mhs Read</h2>
        <table class="table">
	    <tr><td>Judul</td><td><?php echo $judul; ?></td></tr>
	    <tr><td>Link</td><td><?php echo $link; ?></td></tr>
	    <tr><td>IsParent</td><td><?php echo $IsParent; ?></td></tr>
	    <tr><td>Status Aktif</td><td><?php echo $status_aktif; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('menu_mhs') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>