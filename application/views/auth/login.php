
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentallela Alela! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>gentelella/production/css/custom.css" rel="stylesheet">
  </head>

  <body style="background:#F7F7F7;">
    <div class="">
      <a class="hiddenanchor" id="toregister"></a>
      <a class="hiddenanchor" id="tologin"></a>

      <div id="wrapper">
        <div id="login" class=" form">
          <section class="login_content">
            <?php echo form_open("auth/login");?>
                <h1>Login Form</h1>
                <p><?php echo lang('login_subheading');?></p>
                  <div id="infoMessage"><?php echo $message;?></div>
                <div>
                      <?php echo form_input($identity);?>
                </div>
                <div>
                      <?php echo form_input($password);?>
                </div>
                  <div>
                    <?php echo form_submit('submit', lang('login_submit_btn'),'class="btn btn-default submit"');?>                    
                </div>
                <div class="clearfix"></div>
                <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                  <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            <?php echo form_close();?>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>