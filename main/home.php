<?php
  session_start();
  echo "<script> console.log('HELPDESK : home') </script>";

  include_once("../modul.php");
  include_once("../action/Home.php");
  if(!$_SESSION["siapa"] || $_SESSION["siapa"]==""){
    $systemini = read_ini_file();
    $location = "Location: ".$systemini["URL"]."logout.php";
    header($location); die();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HELPDESK | PT. RUTAN</title>

    <link rel="icon" href="../resources/images/logo.gif" type="image/ico" />

    <!-- Bootstrap -->
    <link href="../resources/css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../resources/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../resources/css/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../resources/css/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../resources/css/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- Dropzone.js -->
    <link href="../resources/css/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../resources/css/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../resources/css/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../resources/css/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../resources/css/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../resources/css/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../resources/css/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../resources/css/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../resources/css/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../resources/css/custom.css" rel="stylesheet">
    <link href="../resources/Popup/css/popup.css" rel="stylesheet">
    <style type="text/css">
      div.scroll {
        width:100%;
        overflow-x:scroll;        
  }
      /*.terpilih{
        background-color: #affac7;
      }*/
    </style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i style="border:none;"><img src="../resources/images/logo.gif" style="width:30px;height:30px;"></img></i>PT. RUTAN</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../upload/<?php echo $_SESSION['gambarPP']; ?>" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2 id="siapa"><?php echo $_SESSION["siapa"]; ?></h2>
                <h5 id="nname"><?php echo $_SESSION["siapanama"]; ?></h5>
              </div>
            </div>
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu" id="menuBar">
                  <?php
                      $nomorMenu = 0;
                      for($i = 0; $i<count($menu); $i++){
                        $nomorMenu++;
                  ?>
                      <li class="mainmenu"><a 
                        <?php 
                          if($menu[$i]['status']==9){ 
                            echo 'id="'.$menu[$i]['link'].'" onclick="page_changing(this,'."''".','."''".','."''".')" submenu="'.$menu[$i]['nmmenu'].'" text="'.$menu[$i]['nmmenu'].'" iconnya="'.$menu[$i]['icon'].'"' ; }else{}
                        ?>"
                      >
                        <i class="<?php echo $menu[$i]['icon']; ?>"></i> <?php echo $menu[$i]['nmmenu']; if($menu[$i]['status']==1){?>
                          <?php if($menu[$i]['idmenu']=='4'){?> <span class="label label-success pull-right" id="totalHelpdesk"><?php echo $totalHelpdesk;}else if($menu[$i]['idmenu']=='5'){?> <span class="label label-success pull-right" id="totalPengajuan"><?php echo $totalPengajuan;}else if($menu[$i]['idmenu']=='3'){?><?php if ($totalPATA==0) {} else {?> <span class="label label-success pull-right" id="totalPATA"><?php echo $totalPATA;}} ?></span><span class="fa fa-chevron-down pull-right"></span><?php }else{if($menu[$i]['flaghijau']=='1'){ ?><span class="label label-success pull-right"><?php if($menu[$i]['idmenu']=='98'){echo "Coming Soon";} ?></span><?php } }?></a>
                      <?php
                        if($menu[$i]['status']==9){}else{
                      ?>
                          <ul class="nav child_menu">
                            <?php
                              for($j = 0; $j<count($menuSub); $j++){
                                if($menu[$i]['idmenu']==substr($menuSub[$j]['idmenu'],0,1) || $menu[$i]['idmenu']==substr($menuSub[$j]['idmenu'],0,2)){
                                //if diatas untuk menyamakan antara main menu dengan sub menu (lihat database)
                            ?>
                                  <li class="submenu"><a submenu="<?php echo $menu[$i]['nmmenu']; ?>" id="<?php echo $menuSub[$j]['link']; ?>" text="<?php echo $menuSub[$j]['nmmenu']; ?>" iconnya="<?php echo $menuSub[$j]['icon']; ?>" onclick="page_changing(this,'','','')"><i class="<?php echo $menuSub[$j]['icon']; ?>"></i><?php echo $menuSub[$j]['nmmenu']; ?><?php if($menuSub[$j]['flaghijau']=='1'){ ?>
                                <?php if($menuSub[$j]['idmenu']=='4.2'){?> 
                                    <?php if ($jumDimintaDikerjakan[0]['jumlah']==0) {} else {?>
                                    <span class="label label-success pull-right" id="jumDimintaDikerjakan"><?php echo $jumDimintaDikerjakan[0]['jumlah'];}} 

                                    else if($menuSub[$j]['idmenu']=='4.2'){?><?php if ($jumpinjamhardware[0]['jumlah']==0) {} else {?> <span class="label label-success pull-right" id="jumTungguAccPATA"><?php echo $jumpinjamhardware[0]['jumlah'];}}

                                    else if($menuSub[$j]['idmenu']=='4.4'){?> <span class="label label-success pull-right" id="jumSedangDikerjakan"><?php echo $jumSedangDikerjakan[0]['jumlah'];}else if($menuSub[$j]['idmenu']=='4.5'){?> 
                                    <span class="label label-success pull-right" id="jumBelumDitangani"><?php echo $jumBelumDitangani[0]['jumlah'];}else if($menuSub[$j]['idmenu']=='4.6'){?> 
                                      <span class="label label-success pull-right" id="jumBelumDitanganiSAP"><?php echo $jumBelumDitanganiSAP[0]['jumlah'];}else if($menuSub[$j]['idmenu']=='4.3'){?> 
                                      <span class="label label-success pull-right" id="jumBelumDitanganiJOB"><?php echo $jumBelumDitanganiJOB[0]['jumlah'];}else if($menuSub[$j]['idmenu']=='5.2')
                                    {?> <span class="label label-success pull-right" id="jumPengajuanBaru"><?php echo $jumPengajuanBaru[0]['jumlah'];}else if($menuSub[$j]['idmenu']=='5.3'){?><?php if ($jumTungguAccPATA[0]['jumlah']==0) {} else {?> <span class="label label-success pull-right" id="jumTungguAccPATA"><?php echo $jumTungguAccPATA[0]['jumlah'];}}

                                    else if($menuSub[$j]['idmenu']=='5.4'){?><?php if ($jumPengajuanBerjalan[0]['jumlah']==0) {} else {?> <span class="label label-success pull-right" id="jumTungguAccPATA"><?php echo $jumPengajuanBerjalan[0]['jumlah'];}}

                                    else if($menuSub[$j]['idmenu']=='5.6'){ 
                                      if ($jumPengajuanSelesai[0]['jumlah']==0) {} else {  ?> 
                                      <!-- <span class="label label-success pull-right" id="jumTungguAccPATA"> -->
                                      <?php //echo $jumPengajuanSelesai[0]['jumlah'];
                                    }}

                                    else if($menuSub[$j]['idmenu']=='5.5'){?> <span class="label label-success pull-right" id="jumPengajuanSiap"><?php echo $jumPengajuanSiap[0]['jumlah'];}else if($menuSub[$j]['idmenu']=='3.1'){?> <span class="label label-success pull-right" id="jumverifHD"><?php echo $jumverifHD[0]['jum'];}else if($menuSub[$j]['idmenu']=='3.2'){?> <span class="label label-success pull-right" id="jumverifPeng"><?php echo $jumverifPeng[0]['jum'];} ?></span><?php } ?></a></li>
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
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a> -->
              <a data-toggle="tooltip" data-placement="top" title="Logout" onclick="logout()">
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
                  <!-- <a onclick="logout()"><i class="fa fa-sign-out pull-right"></i> Keluar</a> -->
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../upload/<?php echo $_SESSION['gambarPP']; ?>" alt=""><?php echo $_SESSION["nname"]; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a onclick="profil()"> Profil</a></li>
                    <li><a onclick="logout()"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">               
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green" id="msgjumlah"></span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu" style="max-height:500px; overflow-y: scroll;">
                    <!-- <li>
                      <a>
                        <span>
                          <span id="msgfrom"></span>
                          <span class="time" id="msgtime"></span>
                        </span>
                        <span class="message" id="msgtxt">
                          
                        </span>
                      </a>
                    </li> -->                    
                    
                  </ul>
                </li>
                <!-- <li role="presentation" class="dropdown">
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
                </li> -->
                
              </ul>
            </nav>
          </div>
        </div>

        <!-- page content -->
        <div class="right_col" role="main" id="main-section">
          

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

    <script>
      var _api_rutan = "<?= _api_rutan ?>";
      var is_lokal = "<?= is_lokal ?>";
    </script>

    <!-- jQuery -->
    <script src="../resources/css/jquery/dist/jquery.min.js"></script>
    <!-- jQuery Tags Input -->
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>
    <!-- Dropzone.js -->
    <script src="../resources/css/dropzone/dist/min/dropzone.min.js"></script>  
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
    <!-- Switchery -->
    <script src="../resources/css/switchery/dist/switchery.min.js"></script>
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
    <!-- jQuery Knob -->
    <script src="../resources/css/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- Datatables -->
    <script src="../resources/css/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../resources/css/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../resources/css/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../resources/css/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../resources/css/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../resources/css/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../resources/css/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../resources/css/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../resources/css/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../resources/css/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../resources/css/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../resources/css/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../resources/css/jszip/dist/jszip.min.js"></script>
    <script src="../resources/css/pdfmake/build/pdfmake.min.js"></script>
    <script src="../resources/css/pdfmake/build/vfs_fonts.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../resources/js/custom.js"></script>
    <!-- Bootbox Javascript -->
    <script src="../resources/js/bootbox.min.js"></script>
    <!-- Custom Action Javascript - jQuery -->
    <script src="../resources/js/action/action.js?random=<?php echo uniqid(); ?>"></script>
  
  </body>
</html>
