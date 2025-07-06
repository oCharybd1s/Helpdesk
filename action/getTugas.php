<?php
@session_start();
@include("../model/GetITHD.php");

// $getDataTPS = FDataTPS($_POST["jenisbayarP"],$_POST["statusP"]);
$data = [];
$detmsg = FgetdataAlertTugas($_POST['noidP']);
$jumlahmsg = count($detmsg);
$data[0]=$jumlahmsg;
$data[1]=$detmsg;
echo json_encode($data);
?>