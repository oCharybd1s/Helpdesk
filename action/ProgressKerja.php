<?php
	session_start();
	@include("../modul.php");

    $mode = $_POST['mode'];
    $nopengajuan = $_POST['nopengajuan'];
    $progress = $_POST['progress'];

    // echo json_encode(strval($nopengajuan));
    $queryCekAdaData = "SELECT * FROM tabelprogress where nopengajuan = '".$nopengajuan."'";
    $resultAdaData = execute_query($queryCekAdaData);
    // echo json_encode($resultAdaData);
    if (count($resultAdaData)>0){
        //ada data berarti update
        $query = "UPDATE tabelprogress set progress = ".$progress." where nopengajuan = '".$nopengajuan."'";
        $res = execute_query($query);
        echo json_encode($res);
    } else {
        //tidak ada data berarti insert
        $query = "INSERT INTO tabelprogress values ('".$nopengajuan."',".$progress.")";
        $res = execute_query($query);
        echo json_encode($res);
    }
    if($mode == 'get'){
        $queryCek2 = "SELECT * FROM tabelprogress where nopengajuan = '".$nopengajuan."'";
        $result2 = execute_query($queryCek2);
        echo json_encode($result2);
    }
// echo json_encode($query);
?>