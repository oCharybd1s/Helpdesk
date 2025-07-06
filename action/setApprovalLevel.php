<?php 
@session_start();
@include("../model/GetITPengajuan.php");

$getApprovalLevel = FDataApprovalLevel($_POST["biayaP"]);

echo json_encode($getApprovalLevel);
?>