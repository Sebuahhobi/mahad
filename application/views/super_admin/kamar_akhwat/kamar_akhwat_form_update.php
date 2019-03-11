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
                <?php 
                function split_nth($str, $delim, $n)
                {
                  return array_map(function($p) use ($delim) {
                      return implode($delim, $p);
                  }, array_chunk(explode($delim, $str), $n));
                }
                //$array = split_nth("Atap Bocor AC Bagus Kursi bagus Meja Bagus meja Rusak", " ", 2);
                $array = split_nth($kondisi, ", ", 1);

                echo kondisi_update('kondisi', 'status_kamar', 'kondisi', 'id', $array);
                ?>

                </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Perlengkapan <?php echo form_error('perlengkapan[]') ?></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <?php 
                    function split_nth1($str1, $delim1, $n1)
                    {
                      return array_map(function($p1) use ($delim1) {
                          return implode($delim1, $p1);
                      }, array_chunk(explode($delim1, $str1), $n1));
                    }                    

                    $array1 = split_nth1($perlengkapan, ", ", 1);
                    echo kelengkapan_update('perlengkapan', 'perlengkapan_kamar', 'nama_perlengkapan', 'id', $array1);
                ?>

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
