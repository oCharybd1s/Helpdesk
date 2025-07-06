<?php
	@include('../../action/GetData.php');
?>
<html lang="en">
  <head>
  	<style type="text/css">
    .btnaktif{
    	background-color: #75ffc6;
    }
    .tabelaktif{
    	border-width: thin;
    	border-style: groove;
    }
    .tengah{
    	text-align: center;
    }
  </style>  	
  </head>
  	<body>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
	    <div class="x_panel">
	    	<div class="x_title">
		        <h2>LAPORAN HARIAN</h2>
		        <div class="clearfix"></div>
		    </div>
		    <div class="x_content">
			    <label class="control-label col-md-1 col-sm-1 col-xs-12">Tanggal</label>
          <div class="col-md-2 col-sm-2 col-xs-12">
            <input type="date" class="form-control" id="tanggal" onchange="fa_getDataevaluasi();">
          </div>

			    <div id="userlogintbl" class="x_content tabelaktif">
			    	<p class="data"></p>
			    	
			    </div>

		    </div>	   
  </div>
</div>
</body>
</html>
 <script type="text/javascript">
   $(document).ready(function(){
	   	document.getElementById('tanggal').valueAsDate = new Date();
	   	fa_getDataevaluasi();
    });
</script>