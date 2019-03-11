<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Menu Admin<small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <br>
            <form action="<?php echo $action; ?>" method="post" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
        	    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Judul <?php echo form_error('judul') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" />
                        </div>
                </div>
        	    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Link <?php echo form_error('link') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="link" id="link" placeholder="Link" value="<?php echo $link; ?>" />
                        </div>
                </div>
        	    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">Icon <?php echo form_error('icon') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" />
                        </div>
                </div>
        	    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="int">IsParent <?php echo form_error('IsParent') ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo menu_cmb('IsParent', 'menu_admin', 'judul', 'id', $IsParent);?>
                        </div>
                </div>
        	    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="enum">Status Aktif <?php echo form_error('status_aktif') ?></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                            echo form_dropdown('status_aktif',array('y'=>'AKTIF','t'=>'TIDAK AKTIF'),$status_aktif,"class='form-control'");
                        ?>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                	    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
                	    <a href="<?php echo site_url('admin/menu/') ?>" class="btn btn-default"><i class="fa fa-reply-all"></i> Cancel</a>
    	           </div>
                </div>
            </form>
        </div>
    </div>
</div>