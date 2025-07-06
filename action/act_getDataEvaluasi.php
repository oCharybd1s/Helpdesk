<?php
	@include("../modul.php");

	$tanggal = $_POST['tgl'];
	// echo $tanggal;

    $query2 = "select a.*,b.nama as darinama,c.nama as ditanganinama,convert(varchar(12),Tanggal,103)  as Tanggal2
            from vbelumselesai a 
            left join VPrev b on a.dari=b.nik
            left join VPrev c on isnull(a.ditangani,a.offerditangani)=c.nik ";
    $hdgantung = execute_query($query2);
    
    $querypersonilit = "select * from VPrev where status=1 and aktif=1";
    $personil = execute_query($querypersonilit);    

    // DATA HELPDESK yang belum SELESAI
    $box_msg= " <br/><p style='color:#F00'>DAFTAR HELPDESK YANG MASIH BELUM SELESAI</p>
                  <table style='border : 2px solid #183A1D;  border-collapse: collapse;' class='table table-striped table-bordered table-hover'>
                    <tr style='background-color:#FFAACF'>
                      <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>No</th>
                      <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Tanggal</th>
                      <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Dari</th>
                      <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Ditangani</th>
                      <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Detail</th>
                    </tr>";
    for($j=0;$j<count($hdgantung);$j++){
        $box_msg.= "<tr>
                      <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$hdgantung[$j]["No"]."</td>
                      <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$hdgantung[$j]["Tanggal2"]."</td>
                      <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$hdgantung[$j]["darinama"]."</td>
                      <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$hdgantung[$j]["ditanganinama"]."</td>
                      <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$hdgantung[$j]["issue"]."</td>
                    </tr>";                   
    }
        $box_msg .= "</table>";
    
    //DATA HELPDESK YANG MASUK HARI INI
    $q_datahelpdesk = "select a.no,a.issue,a.Solusi,d.nama as peminta, convert(varchar(12),a.TanggalSelesai,103)  as selesai from missue a
        left join VPrev d on a.dari=d.nik
        where year(Tanggal)=year('$tanggal') and month(Tanggal)=month('$tanggal') and day(Tanggal)=day('$tanggal')";
     // echo $q_datahelpdesk;
    $h_datahelpdesk = execute_query($q_datahelpdesk);

    if (count($h_datahelpdesk)>0) {
	    $box_msg.= "<br/><p style='color:#F00'>HELPDESK YANG MASUK TANGGAL $tanggal</p>
	            <table style='border : 2px solid #183A1D;  border-collapse: collapse;' class='table table-striped table-bordered table-hover'>
	                <tr style='background-color:#7DB9B6'>
	                <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>No Helpdesk</th>
	                <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Peminta</th>
	                <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Deskripsi Helpdesk</th>
	                <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Solusi</th>
	                <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Selesai</th>
	                </tr>";
	    for($k=0;$k<count($h_datahelpdesk);$k++){
	        $box_msg.= "<tr>
	                    <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$h_datahelpdesk[$k]["no"]."</td>
	                    <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$h_datahelpdesk[$k]["peminta"]."</td>
	                    <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$h_datahelpdesk[$k]["issue"]."</td>
	                    <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$h_datahelpdesk[$k]["Solusi"]."</td>
	                    <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$h_datahelpdesk[$k]["selesai"]."</td>
	                    </tr>";    
	    }
	    $box_msg .= "</table>";
	}

    // PEKERJAAN PER PERSONIL
    for($x=0;$x<count($personil);$x++){
        $query3 = "select a.no,a.issue,a.Solusi,b.nama as namaditangani, d.nama as peminta,
            datediff(minute,a.acceptwork,a.TanggalSelesai)+isnull(c.totpaused,0) as lamapengerjaan
            from missue a
            left join VPrev b on a.ditangani=b.nik
            left join VPause c on a.no=c.no
            left join VPrev d on a.dari=d.nik
            where b.status=1 and year(TanggalSelesai)=year('$tanggal') and month(TanggalSelesai)=month('$tanggal') and day(TanggalSelesai)=day('$tanggal')
            and a.Ditangani='".$personil[$x]["NIK"]."' and a.tanggalselesai is not null";
        $dataselesai = execute_query($query3);
        $querytotjam = "select sum(datediff(minute,b.acceptwork,b.tanggalselesai)+isnull(c.totpaused,0)) as totjam
                from VPrev a
                left join missue b on a.nik=b.ditangani
                left join vpause c on b.no=c.no
                where a.status=1 and a.aktif=1 and b.tanggalselesai is not null
                and year(b.tanggalselesai)=year('$tanggal') and month(b.tanggalselesai)=month('$tanggal')
                and day(b.tanggalselesai)=day('$tanggal') and b.tanggalselesai is not null and b.Ditangani='".$personil[$x]["NIK"]."'";
        $totjam = execute_query($querytotjam);

        if ($totjam[0]["totjam"]!=NULL) {
            $box_msg.= "<br/><p style='color:#F00'>HELPDESK YANG DIKERJAKAN</p>
                        <p><strong>".$personil[$x]["Nama"]." - ".$totjam[0]["totjam"]." Menit</strong></p>
                        <table style='border : 2px solid #183A1D;  border-collapse: collapse;' class='table table-striped table-bordered table-hover'>
                            <tr style='background-color:#B5F1CC'>
                            <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>No Helpdesk</th>
                            <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Peminta</th>
                            <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Deskripsi Helpdesk</th>
                            <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Solusi</th>
                            <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Durasi</th>
                            </tr>";
            for($k=0;$k<count($dataselesai);$k++){
                $box_msg.= "<tr>
                            <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$dataselesai[$k]["no"]."</td>
                            <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$dataselesai[$k]["peminta"]."</td>
                            <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$dataselesai[$k]["issue"]."</td>
                            <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$dataselesai[$k]["Solusi"]."</td>
                            <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$dataselesai[$k]["lamapengerjaan"]."</td>
                            </tr>";                   
            }
            $box_msg .= " </table>";
        }
    }

    //DATA PENGAJUAN YANG MASIH NGGANTUNG
    $q_datapengajuan = "select convert(varchar(12),a.tanggal,103) as tanggal, No, b.nama as dari, namainvestasi, alasan from mpengajuan a, mprev b where a.dari=b.NIK and konfirmasi=0";
    $h_datapengajuan = execute_query($q_datapengajuan);

    $box_msg.= "<br/><p style='color:#F00'>PENGAJUAN BELUM DI KASIH SOLUSI</p>
            <table style='border : 2px solid #865DFF;  border-collapse: collapse;'>
                <tr style='background-color:#7DB9B6'>
                <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Tanggal</th>
                <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>No Pengajuan</th>
                <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Dari</th>
                <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Investasi</th>
                <th style='border : 2px solid #183A1D;  border-collapse: collapse;'>Alasan</th>
                </tr>";
    for($k=0;$k<count($h_datapengajuan);$k++){
        $box_msg.= "<tr>
                    <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$h_datapengajuan[$k]["tanggal"]."</td>
                    <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$h_datapengajuan[$k]["No"]."</td>
                    <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$h_datapengajuan[$k]["dari"]."</td>
                    <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$h_datapengajuan[$k]["namainvestasi"]."</td>
                    <td style='border : 2px solid #183A1D;  border-collapse: collapse;'>".$h_datapengajuan[$k]["alasan"]."</td>
                    </tr>";    
    }
    $box_msg .= "</table>";							    
    echo $box_msg;

?>

<script src="js/jquery.js"></script>