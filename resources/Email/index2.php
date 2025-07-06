<?php
// @session_start();

//KIRIM EMAIL UNTUK MASING-MASING PERSONIL APABILA ADA HELPDESK YANG BELUM SELESAI
@include("lib/PHPMailerAutoload.php");
@include("../../modul.php");
$errkirim = 0;
$email = '';
$query = "select distinct email from vbelumselesai where ditangani not in (select nik from VPrev where status=2) 
or offerditangani not in (select nik from VPrev where status=2)";
$dataemail = execute_query($query);
for($i=0;$i<count($dataemail);$i++){
    $query2 = "select a.*,b.nama as darinama,c.nama as ditanganinama,convert(varchar(12),Tanggal,103)  as Tanggal2
            from vbelumselesai a 
            left join VPrev b on a.dari=b.nik
            left join VPrev c on isnull(a.ditangani,a.offerditangani)=c.nik 
            where a.email='".$dataemail[$i]["email"]."'";
    $hdgantung = execute_query($query2);
    $sen_name = "helpdesk@rutan.co.id";
    $sen_email = "helpdesk@rutan.co.id";
    $rec_email = str_replace(" ","",$dataemail[$i]["email"]);
    $email_sub = "HELPDESK Tanggal ". date("d-m-Y");
    $box_msg = "<html>
                <head>
                  <title>DAFTAR HELPDESK</title>
                </head>
                <body>
                  <p>DAFTAR HELPDESK YANG MASIH BELUM SELESAI</p>
                  <table style='border: 1px solid black;'>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Dari</th>
                      <th>Ditangani</th>
                      <th>Detail</th>
                    </tr>";
    for($j=0;$j<count($hdgantung);$j++){
        $box_msg.= "<tr>
                      <td>".$hdgantung[$j]["No"]."</td>
                      <td>".$hdgantung[$j]["Tanggal2"]."</td>
                      <td>".$hdgantung[$j]["darinama"]."</td>
                      <td>".$hdgantung[$j]["ditanganinama"]."</td>
                      <td>".$hdgantung[$j]["issue"]."</td>
                    </tr>";
    }

    $box_msg.= "  </table>
                </body>
                </html>";

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->isHTML(true); 
    //$mail->SMTPDebug = 2;
    $mail->Mailer = "smtp";
    $mail->Host = "mail.rutan.co.id";
    $mail->Port = 465;
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );

    // Enable SMTP authentication
    $mail->SMTPAuth = TRUE;

    // SMTP username (e.g xyz@gmail.com)
    $mail->Username = 'helpdesk@rutan.co.id';

    // SMTP password
    $mail->Password = 'ITTeam2022';

    // Enable encryption, 'tls' also accepted
    $mail->SMTPSecure = 'ssl';

    // Sender Email address
    $mail->From = $sen_email;

    // Sender name
    $mail->FromName = $sen_name;

    // Receiver Email address
    $mail->addAddress($rec_email);

    // Attaching files in the mail
    // foreach ($files as $file) {
    //     $mail->addAttachment($file);
    // }

    $mail->Subject = $email_sub;
    $mail->Body = $box_msg;
    $mail->WordWrap = 50;

    //check apakah hari ini sudah kirim atau belum
    $query = "select count(tanggal) as jumlah from mkirimemail where year(tanggal)=year(getdate()) 
            and month(tanggal)=month(getdate()) 
            and day(tanggal)=day(getdate()) and statuskirim=1 and email='$email'";
    $checkkirim = execute_query($query);
    // echo $checkkirim[0]["jumlah"];
    if($checkkirim[0]["jumlah"]*1<1){
        // Sending message and checking status       
        if (!$mail->send()) {
            // echo "<script>alert('Sorry!!! Message was not sent. Mailer error:  " . $mail->ErrorInfo . ")</script>";
            // exit;            
            // echo 'Email telah dikirim';
            $errkirim = 1;
        }else{
          $email = $rec_email;  
          $query = "insert into mkirimemail(tanggal,statuskirim,email) values(getdate(),1,'".$email."')";
          echo $query;
          execute_query($query);
            // echo "Email dikirim ke :".$rec_email;
        }
    } 
}  


/////////////////////KIRIM KE PATA ///////////////////////////////////////////
//KIRIM EMAIL KE PATA
$query = "select a.*,b.nama,b.email from VPrev a LEFT JOIN ABSEN_NEW.dbo.pegawai b on a.NIK=b.noid where a.status=2";
$dataemail = execute_query($query);
for($i=0;$i<count($dataemail);$i++){
    $query2 = "select a.*,b.nama as darinama,c.nama as ditanganinama,convert(varchar(12),Tanggal,103)  as Tanggal2
            from vbelumselesai a 
            left join VPrev b on a.dari=b.nik
            left join VPrev c on isnull(a.ditangani,a.offerditangani)=c.nik ";
    $hdgantung = execute_query($query2);
    
    $querypersonilit = "select * from VPrev where status=1 and aktif=1";
    $personil = execute_query($querypersonilit);    

    $sen_name = "helpdesk@rutan.co.id";
    $sen_email = "helpdesk@rutan.co.id";
    $rec_email = str_replace(" ","",$dataemail[$i]["email"]);
    $email_sub = "HELPDESK Tanggal ". date("d-m-Y");
    $box_msg = "<html>
                <head>
                    <title>DAFTAR HELPDESK</title>
                    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                    <meta name='viewport' content='width=device-width'>
                </head>
                <body>";
    // DATA HELPDESK yang belum SELESAI
    $box_msg.= " <p style='color:#F00'>DAFTAR HELPDESK YANG MASIH BELUM SELESAI</p>
                  <table style='border : 2px solid #183A1D;  border-collapse: collapse;'>
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
        where year(Tanggal)=year(getdate()) and month(Tanggal)=month(getdate()) and day(Tanggal)=day(getdate())";
    $h_datahelpdesk = execute_query($q_datahelpdesk);

    $box_msg.= "<p style='color:#F00'>HELPDESK YANG MASUK HARI INI</p>
            <table style='border : 2px solid #183A1D;  border-collapse: collapse;'>
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

    // PEKERJAAN PER PERSONIL
    for($x=0;$x<count($personil);$x++){
        $query3 = "select a.no,a.issue,a.Solusi,b.nama as namaditangani, d.nama as peminta,
            datediff(minute,a.acceptwork,a.TanggalSelesai)+isnull(c.totpaused,0) as lamapengerjaan
            from missue a
            left join VPrev b on a.ditangani=b.nik
            left join VPause c on a.no=c.no
            left join VPrev d on a.dari=d.nik
            where b.status=1 and year(TanggalSelesai)=year(getdate()) and month(TanggalSelesai)=month(getdate()) and day(TanggalSelesai)=day(getdate())
            and a.Ditangani='".$personil[$x]["NIK"]."' and a.tanggalselesai is not null";
        $dataselesai = execute_query($query3);
        $querytotjam = "select sum(datediff(minute,b.acceptwork,b.tanggalselesai)+isnull(c.totpaused,0)) as totjam
                from VPrev a
                left join missue b on a.nik=b.ditangani
                left join vpause c on b.no=c.no
                where a.status=1 and a.aktif=1 and b.tanggalselesai is not null
                and year(b.tanggalselesai)=year(getdate()) and month(b.tanggalselesai)=month(getdate())
                and day(b.tanggalselesai)=day(getdate()) and b.tanggalselesai is not null and b.Ditangani='".$personil[$x]["NIK"]."'";
        $totjam = execute_query($querytotjam);

        if ($totjam[0]["totjam"]!=NULL) {
            $box_msg.= "<p style='color:#F00'>HELPDESK YANG DIKERJAKAN</p>
                        <p><strong>".$personil[$x]["Nama"]." - ".$totjam[0]["totjam"]." Menit</strong></p>
                        <table style='border : 2px solid #183A1D;  border-collapse: collapse;'>
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

    $box_msg.= "<p style='color:#F00'>PENGAJUAN BELUM DI KASIH SOLUSI</p>
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

    $box_msg.= "  </body>
                </html>";

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->isHTML(true); 
    //$mail->SMTPDebug = 2;
    $mail->Mailer = "smtp";
    $mail->Host = "mail.rutan.co.id";
    $mail->Port = 465;
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );

    // Enable SMTP authentication
    $mail->SMTPAuth = TRUE;

    // SMTP username (e.g xyz@gmail.com)
    $mail->Username = 'helpdesk@rutan.co.id';

    // SMTP password
    $mail->Password = 'ITTeam2022';

    // Enable encryption, 'tls' also accepted
    $mail->SMTPSecure = 'ssl';

    // Sender Email address
    $mail->From = $sen_email;

    // Sender name
    $mail->FromName = $sen_name;

    // Receiver Email address
    $mail->addAddress($rec_email);

    // Attaching files in the mail
    // foreach ($files as $file) {
    //     $mail->addAttachment($file);
    // }

    $mail->Subject = $email_sub;
    $mail->Body = $box_msg;
    $mail->WordWrap = 50;

    //check apakah hari ini sudah kirim atau belum
    $query = "select count(tanggal) as jumlah from mkirimemail where year(tanggal)=year(getdate()) 
            and month(tanggal)=month(getdate()) 
            and day(tanggal)=day(getdate()) and statuskirim=1 and email='$email'";
    $checkkirim = execute_query($query);
    // echo $checkkirim[0]["jumlah"];
    // echo $box_msg;
    if(count($checkkirim[0]["jumlah"])<1){
        // Sending message and checking status       
        if (!$mail->send()) {
            // echo "<script>alert('Sorry!!! Message was not sent. Mailer error:  " . $mail->ErrorInfo . ")</script>";
            // exit;            
            // echo 'Email telah dikirim';
            $errkirim = 1;

        }else
        {
          $email = $rec_email;  
          $query = "insert into mkirimemail(tanggal,statuskirim,email) values(getdate(),1,'".$email."')";
          // echo $query;
          execute_query($query);
          // echo "Email terkirim ke :".$rec_email;
        }
    } 
}
/////////////////////////////////////////////////////////////////////////////
//jika sudah terkirim semua
// if($errkirim<1){
//     $query = "insert into mkirimemail(tanggal,statuskirim,email) values(getdate(),1,'".$email."')";
//     execute_query($query);
// } 
?>
<script src="js/jquery.js"></script>