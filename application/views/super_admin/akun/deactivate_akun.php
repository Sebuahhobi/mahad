 <div class=""><?php foreach ($users as $user){}?>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo lang('deactivate_heading');?><small>&MediumSpace; <?php echo sprintf(lang('deactivate_subheading'), $user->username);?></small></h2>

 
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
        <?php echo form_open('super_admin/deactivate/'.$user->id, 'data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""');?>
	    <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Yes <?php echo form_error('confirm') ?></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="radio" name="confirm" value="yes" checked="checked" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">No <?php echo form_error('confirm') ?></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="radio" name="confirm" value="no" />
            </div>
        </div>
        <?php echo form_hidden($csrf); ?>
        <?php echo form_hidden(array('id'=>$user->id)); ?>
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?php echo form_submit('submit', lang('deactivate_submit_btn'),'class="btn btn-primary"');?>
                <a href="<?php echo site_url('super_admin/data_akun_list') ?>" class="btn btn-default"><i class="fa fa-reply-all"></i> Cancel</a>
            </div>
        </div>
        <?php echo form_close();?>
     </div>
            </div>
        </div>
    </div>