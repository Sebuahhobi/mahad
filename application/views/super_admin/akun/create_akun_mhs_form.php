<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Buat akun mahasiswa<small>&MediumSpace; </small></h2>
                    <div id="infoMessage"></div>
 
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
        <?php echo form_open("super_admin/create_akun_mhs", 'data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""');?>
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Fisrt Name <?php echo form_error('first_name') ?></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php echo form_input($first_name);?>
            </div>
        </div>
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">Last Name <?php echo form_error('last_name') ?></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php echo form_input($last_name);?>
            </div>
        </div>
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="char">NPM <?php echo form_error('email') ?></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php echo form_input($email);?>
            </div>
        </div>
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">No. HP <?php echo form_error('phone') ?></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php echo form_input($phone);?>
            </div>
        </div>
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Password <?php echo form_error('password') ?></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php echo form_input($password);?>
            </div>
        </div>
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Password Confirm <?php echo form_error('password_confirm') ?></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php echo form_input($password_confirm);?>
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?php echo form_submit('submit', lang('create_user_submit_btn'),'class="btn btn-primary"');?>
                <a href="<?php echo site_url('super_admin/ion_auth_list') ?>" class="btn btn-default"><i class="fa fa-reply-all"></i> Cancel</a>
            </div>
        </div>
        <?php echo form_close();?>
     </div>
            </div>
        </div>
    </div>
</div>