<?php
// @session_start();
@include("lib/PHPMailerAutoload.php");
@include("../../modul.php");
$errkirim = 0;

$query = "select a.*,b.nama,b.email 
            from VPrev a 
            LEFT JOIN ABSEN_NEW.dbo.pegawai b on a.NIK=b.noid
            where a.nik='000656'";
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
    $email_sub = "";
    $box_msg = "<html>
                <head>
                  <title>DAFTAR HELPDESK</title>
                </head>
                <body>";

    $box_msg.= " <p>DAFTAR HELPDESK YANG MASIH BELUM SELESAI</p>
                  <table>
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
        $box_msg .= "</table>";
    for($x=0;$x<count($personil);$x++){
        $query3 = "select a.no,a.issue,a.Solusi,b.nama as namaditangani, d.nama as peminta,
            datediff(minute,a.acceptwork,a.TanggalSelesai)+isnull(c.totpaused,0) as lamapengerjaan
            from missue a
            left join VPrev b on a.ditangani=b.nik
            left join VPause c on a.no=c.no
            left join VPrev d on a.dari=d.nik
            where b.status=1 and year(tanggalselesai)=year(getdate()) and month(tanggalselesai)=month(getdate()) and day(tanggalselesai)=day(getdate())
            and a.Ditangani='".$personil[$x]["NIK"]."' and a.tanggalselesai is not null";        
            // echo $query3."</br>";
        $dataselesai = execute_query($query3);
        $querytotjam = "select sum(datediff(minute,b.acceptwork,b.tanggalselesai)+isnull(c.totpaused,0)) as totjam
                from VPrev a
                left join missue b on a.nik=b.ditangani
                left join vpause c on b.no=c.no
                where a.status=1 and a.aktif=1 and b.tanggalselesai is not null
                and year(b.tanggalselesai)=year(getdate()) and month(b.tanggalselesai)=month(getdate())
                and day(b.tanggalselesai)=day(getdate()) and b.tanggalselesai is not null and b.Ditangani='".$personil[$x]["NIK"]."'";
        $totjam = execute_query($querytotjam);
        $box_msg.= "  <p><strong><ul>".$personil[$x]["Nama"]." - ".$totjam[0]["totjam"]." Menit</ul></strong></p>
                      <table>
                        <tr>
                          <th>No Helpdesk</th>
                          <th>Peminta</th>
                          <th>Deskripsi Helpdesk</th>
                          <th>Solusi</th>
                        </tr>";
        for($k=0;$k<count($dataselesai);$k++){
            $box_msg.= "<tr>
                          <td>".$dataselesai[$k]["no"]."</td>
                          <td>".$dataselesai[$k]["peminta"]."</td>
                          <td>".$dataselesai[$k]["issue"]."</td>
                          <td>".$dataselesai[$k]["Solusi"]."</td>
                        </tr>";                   
        }
        $box_msg .= " </table>";
    }
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
            and day(tanggal)=day(getdate()) and statuskirim=1";
    $checkkirim = execute_query($query);
    // echo $checkkirim[0]["jumlah"];
    // echo $box_msg;
    if($checkkirim[0]["jumlah"]*1<1){
        // Sending message and checking status       
        if (!$mail->send()) {
            // echo "<script>alert('Sorry!!! Message was not sent. Mailer error:  " . $mail->ErrorInfo . ")</script>";
            // exit;            
            // echo 'Email telah dikirim';
            $errkirim = 1;

        }else
        {
            // echo "Email terkirim ke :".$rec_email;
        }
    } 
}
/////////////////////////////////////////////////////////////////////////////
//jika sudah terkirim semua
if($errkirim<1){
    $query = "insert into mkirimemail(tanggal,statuskirim) values(getdate(),1)";
    // execute_query($query);
} 
?>
<script src="js/jquery.js"></script>