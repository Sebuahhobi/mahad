<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tambah Data kamar ikhwan<small></small></h2>
 
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
        <form action="<?php echo $action; ?>" method="post" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">Kamar <?php echo form_error('kamar') ?></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php echo kamar_akhwat('kamar', 'kamar_akhwat', 'kamar', 'id', $kamar);?>
                </div>
        </div>
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="int">Isi Max <?php echo form_error('isi_max') ?></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" name="isi_max" id="isi_max" placeholder="Isi Max" value="<?php echo $isi_max; ?>" />
                </div>
        </div>
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">Status <?php echo form_error('status') ?></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php echo form_dropdown('status',array(''=>'--Pilih--','p'=>'Penuh!', 't_p'=>'Tidak penuh'),$status, 'class="form-control" id="status"');?>
                </div>
        </div>
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Kondisi <?php echo form_error('kondisi[]') ?></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <!--input class='flat' type='checkbox' name='kondisi[]' value='Abu' <?php echo set_checkbox('kondisi','Abu' );?> /-->
                <?php echo kondisi_update('kondisi', 'status_kamar', 'kondisi', 'id', $kondisi);?>

                </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Perlengkapan <?php echo form_error('perlengkapan[]') ?></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <?php echo kelengkapan_update('perlengkapan', 'perlengkapan_kamar', 'nama_perlengkapan', 'id', $perlengkapan);?>

                </div>
        </div>
        <div class="ln_solid"></div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
        	    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
        	    <a href="<?php echo site_url('super_admin/list_kamar_akhwat') ?>" class="btn btn-default"><i class="fa fa-reply-all"></i> Cancel</a>
	       </div>
        </div>
    </form>
</div>
            </div>
        </div>
    </div>
</div>
