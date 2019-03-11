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
        <h2 style="margin-top:0px">Pembayaran Read</h2>
        <table class="table">
	    <tr><td>Jumlah Pembayaran</td><td><?php echo $jumlah_pembayaran; ?></td></tr>
	    <tr><td>Operator</td><td><?php echo $operator; ?></td></tr>
	    <tr><td>Tgl Hari Ini</td><td><?php echo $tgl_hari_ini; ?></td></tr>
	    <tr><td>Tgl Pembayaran</td><td><?php echo $tgl_pembayaran; ?></td></tr>
	    <tr><td>Id Mhs</td><td><?php echo $id_mhs; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pembayaran') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>