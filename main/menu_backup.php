<?php
  include_once("../modul.php");
  include_once("../action/Home.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="../resources/images/gentelella/favicon.ico" type="image/ico" />

    <!-- Bootstrap -->
    <link href="../resources/css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../resources/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../resources/css/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../resources/css/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="../resources/css/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../resources/css/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../resources/css/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../resources/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i style="border:none;"><img src="../resources/images/logo.gif" style="width:30px;height:30px;"></img></i>PT. RUTAN</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../resources/images/gentelella/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION["siapanama"]; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <?php
                      for($i = 0; $i<count($menu); $i++){
                  ?>
                        <li><a <?php if($menu[$i]['status']==9){ echo 'id="'.$menu[$i]['link'].'"'; }else{}?>" ><i class="<?php echo $menu[$i]['icon']; ?>"></i> <?php echo $menu[$i]['nmmenu']; if($menu[$i]['status']==1){?><span class="fa fa-chevron-down"></span><?php }else{}?></a>
                        <?php
                          if($menu[$i]['status']==9){}else{
                        ?>
                            <ul class="nav child_menu">
                              <?php
                                for($j = 0; $j<count($menuSub); $j++){
                                  if($menu[$i]['idmenu']==substr($menuSub[$j]['idmenu'],0,1)){ //menyamakan antara main menu dengan sub menu (lihat database)
                              ?>
                                    <li><a id="<?php echo $menuSub[$j]['link']; ?>"><?php echo $menuSub[$j]['nmmenu']; ?></a></li>
                              <?php
                                  }
                                }
                              ?>
                            </ul>
                        <?php
                          }
                        ?>
                        </li>
                  <?php
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
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt=""><?php echo $_SESSION["siapanama"]; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
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
        <div class="right_col" role="main" id="main-section">
          a
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            ©2018 IT Departemen - PT. RUTAN - www.rutan.co.id
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../resources/css/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../resources/css/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../resources/css/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../resources/css/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../resources/css/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../resources/css/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../resources/css/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../resources/css/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../resources/css/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../resources/css/Flot/jquery.flot.js"></script>
    <script src="../resources/css/Flot/jquery.flot.pie.js"></script>
    <script src="../resources/css/Flot/jquery.flot.time.js"></script>
    <script src="../resources/css/Flot/jquery.flot.stack.js"></script>
    <script src="../resources/css/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../resources/css/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../resources/css/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../resources/css/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../resources/css/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../resources/css/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../resources/css/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../resources/css/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../resources/css/moment/min/moment.min.js"></script>
    <script src="../resources/css/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../resources/js/custom.min.js"></script>
    <!-- Custom Action Javascript - jQuery -->
    <script src="../resources/js/action/action.js"></script>
  
  </body>
</html>
