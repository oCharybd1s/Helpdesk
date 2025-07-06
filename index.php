<?php
  include_once("modul.php");
  include_once("action/Login.php");
  $islogin = 0;
  $usr = "";
  $psswd = "";
  if(isset($_POST["usr"])){  
    $islogin = 1;
    $usr = $_POST["usr"];
    $psswd = $_POST["psswd"];
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
    <link REL="shortcut icon" href="resources/images/LOGO.gif" />

    <!-- Bootstrap -->
    <link href="resources/css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="resources/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="resources/css/custom.css?random=<?php echo uniqid(); ?>" rel="stylesheet">

    <!-- SELECT2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  </head>

  <body class="nav-md" style="background:#FFF;">
    <div class="loginku" ></div>
    <div class="container body">
      <div class="main_container">
        <div class="login_wrapper">
          <div class="animate form login_form" style="background:#0b956b;">
            <section class="login_content">
              <form >
                <h1>IT HELPDESK</h1>
                <p class="change_link">Gunakan username dan password yang sama dengan HRIS</p>
                <!-- <p class="change_link">Info lebih lanjut hubungi IT Dept</p><br /> -->
                <div>
                  <input type="text" class="form-control" id="Username" name="Username" placeholder="Username" required="" />
                </div>
                <div>
                  <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" required="" />
                </div>
                <div>
                  <input type="button" id="login" class="btn btn-default submit" value="Log In" style="background-color: #03433c;" />
                </div>

                <div class="clearfix"></div>

                <div class="separator" style="border-color: #000;">
                  <div>
                    <p class="change_link">©2021 IT Departemen - PT. RUTAN - www.rutan.co.id</p>
                    <p class="change_link">Efisiensi, Kolaborasi, dan Invovasi Teknologi</p>
                  </div>
                </div>
              </form>
            </section>
          </div>
        </div>
      </div>

    <script>
      var _api_rutan = "<?= _api_rutan ?>";
      var is_lokal = "<?= is_lokal ?>";
    </script>

    <!-- jQuery -->
    <script src="resources/css/jquery/dist/jquery.min.js"></script>
	
    <!-- Welcome Javascript - jQuery -->
    <script src="resources/js/welcome.js"></script>
	
    <!-- Custom Action Javascript - jQuery -->
    <script src="resources/js/action/action.js?random=<?php echo uniqid(); ?>"></script>

    <!-- Bootstrap -->
    <script src="resources/css/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="resources/js/custom.min.js"></script>

    <!-- Bootbox Javascript -->
    <script src="resources/js/bootbox.min.js"></script>

    <!-- SELECT2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
  </body>
</html>
<script type="text/javascript">
  var islogin = <?php echo $islogin; ?>;  
  if(islogin==1){
    var usr = '<?php echo $usr; ?>';
    var psswd = '<?php echo $psswd; ?>';
    $('#Username').val(usr);
    $('#Password').val(psswd);
    $('#login').trigger( "click" );
  }
</script>