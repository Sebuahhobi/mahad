
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SI Ma'had Al-Munaawarah | Gentallela</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>gentelella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url();?>gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>gentelella/production/css/custom.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentellela Alela!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>
                    <?php 
                        $ci = get_instance();
                        $ci->load->library(array('ion_auth'));
                        if ($ci->ion_auth->is_super_admin()){
                            $desc="Super Admin";
                        }
                        elseif ($ci->ion_auth->is_admin()){
                            $desc="Admin";
                        }
                        else{
                            $desc="Members";
                        }
                        $user=$this->ion_auth->user()->row();
                        echo "<b>".$desc."</b>"."<br>".$user->first_name.' '.$user->last_name;
                    ?>
                </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li>
                      <?php echo anchor(site_url('super_admin/'), '<i class="fa fa-home"></i> Home' ); ?>
                  </li>
                  <li>
                        <a><i class="fa fa-edit"></i> Menu Super Admin <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><?php echo anchor(site_url('super_admin/menu_super_admin_list'),'List Menu');?>
                          <li><?php echo anchor(site_url('super_admin/create_menu_super_admin'),'Tambah Menu Super Admin');?>
                          </li>
                        </ul>
                  </li>
                    <?php
                    $this->db->order_by('judul','ASC');
                    $this->db->where_not_in('id',array(0))->where_not_in('status_aktif',array('t'));
                                    //$this->db->where_not_in('status_aktif',array('t')); 
                                    //$this->db->where_not_in(array('id'=>0,'status_aktif'=>'t'));
                                    $main_menu = $this->db->get_where('menu_super_admin',array('isParent'=>0));
                                    foreach ($main_menu->result() as $main){
                                        // chek apakah punya sub menu ?
                                        $sub_menu = $this->db->get_where('menu_super_admin',array('isParent'=>$main->id,'status_aktif'=>'y'));
                                        if($sub_menu->num_rows()>0){
                                            // tampilkan menu dengan submenu
                                            echo '<li><a><i class="fa '.$main->icon.'"></i> '.$main->judul.' <span class="fa fa-chevron-down"></span></a>';
                                            //echo "<li class='active'>".anchor('#','<i class="fa '.$main->icon.'"></i>'.$main->judul.'<span class="fa fa-chevron-down"></span>');
                                            echo '<ul class="nav child_menu">';
                                            foreach ($sub_menu->result() as $sub){
                                                echo "<li>".anchor($sub->link,$sub->judul)."</li>";
                                            }
                                            echo '</ul>';
                                            echo "</li>"; 
                                        }else{
                                            // tampilkan singe menu
                                           echo "<li>".anchor($main->link,'<i class="fa '.$main->icon.'"></i>'.$main->judul)."</li>"; 
                                        }
                                        
                                    }
                                    ?>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
                <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo site_url('auth/logout') ?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">
                        <?php 
                            $ci = get_instance();
                            $ci->load->library(array('ion_auth'));
                            $user=$this->ion_auth->user()->row();
                            echo $user->first_name.' '.$user->last_name;
                    ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;">  Profile</a>
                    </li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">Help</a>
                    </li>
                    <?php echo "<li>".anchor('auth/logout','<i class="fa fa-sign-out pull-right"></i>Log Out')."</li>";?>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image">
                                          <img src="images/img.jpg" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                      </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image">
                                          <img src="images/img.jpg" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                      </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image">
                                          <img src="images/img.jpg" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                      </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image">
                                          <img src="images/img.jpg" alt="Profile Image" />
                                      </span>
                        <span>
                                          <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                                          Film festivals used to be do-or-die moments for movie makers. They were where...
                                      </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main"><!--style="min-height: 3261px;"-->
          <div class="">
            <div class="page-title">
             <div class="title_left">
                <h3>
                     <!--- Users
                      <small>
                          Some examples to get you started
                      </small>-->
                  </h3>
              </div> 

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><!-- <small>Users</small>--></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                          <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <!--start content-->
                  
                <div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo lang('edit_group_heading');?><small>&MediumSpace; <?php echo lang('edit_group_subheading');?></small></h2>
                    <div id="infoMessage" class="blue"><?php echo $message;?></div>
 
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
        <?php echo form_open(uri_string(), 'data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""');?>
	    <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Nama grup <?php echo form_error('group_name') ?></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php echo form_input($group_name);?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="varchar">Deskripsi grup <?php echo form_error('group_description') ?></label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?php echo form_input($group_description);?>
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?php echo form_submit('submit', lang('edit_group_submit_btn'),'class="btn btn-primary"');?>
                <a href="<?php echo site_url('super_admin/data_akun_list') ?>" class="btn btn-default"><i class="fa fa-reply-all"></i> Cancel</a>
            </div>
        </div>
        <?php echo form_close();?>
     </div>
            </div>
        </div>
    </div>
</div>
                  <!-- END content-->
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer><div class="clearfix"></div>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div><br>
          <div style="text-align: center">Copyright &COPY; 2018 - Ma'had Al-Munawwarah | <a href="https://sebuahhobi.com"><b>Sebuahhobi</b></a></div>
          <div class="clearfix"></div>
        </footer>>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url();?>gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>gentelella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>gentelella/vendors/nprogress/nprogress.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url();?>gentelella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>gentelella/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>gentelella/production/js/custom.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        var table = $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
  </body>
</html>

