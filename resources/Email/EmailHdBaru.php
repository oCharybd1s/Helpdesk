<?php
@session_start();
@include("lib/PHPMailerAutoload.php");
@include("../../modul.php");
$systemini = read_ini_file(); 
$lnk = $systemini["MAINURL"];
$nohd = $_SESSION['noHelpdesk'];
$query = "select a.no,convert(varchar(12),a.tanggal,105) as tanggal,a.tujuan,a.kategori,a.issue,b.nama,b.cabang,c.namaaplikasi
        from missue a
        LEFT JOIN VPrev b on a.dari=b.NIK
        LEFT JOIN maplikasi c on a.aplikasi=c.Apl
        where no='".$nohd."'";
$datahd = execute_query($query);
$sen_name = "helpdesk@rutan.co.id";
$sen_email = "helpdesk@rutan.co.id";
$rec_email = "anitaforwork07@gmail.com";
$email_sub = "Helpdesk Baru";
$box_msg = "<html>
            <head>
              <title></title>
            </head>
            <body>
              <p>HELPDESK BARU</p>
              <table style='border: 1px solid black;'>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Dari</th>
                  <th>Cabang</th>
                  <th>Tujuan</th>
                  <th>Bagian</th>
                  <th>Nama Aplikasi</th>
                </tr>";
for($j=0;$j<count($datahd);$j++){
    $box_msg.= "<tr>
                  <td>".$datahd[$j]["no"]."</td>
                  <td>".$datahd[$j]["tanggal"]."</td>
                  <td>".$datahd[$j]["nama"]."</td>
                  <td>".$datahd[$j]["cabang"]."</td>
                  <td>".$datahd[$j]["tujuan"]."</td>
                  <td>".$datahd[$j]["kategori"]."</td>
                  <td>".$datahd[$j]["namaaplikasi"]."</td>
                </tr>";
}

$box_msg.= "  </table>
              <div>
              Klik link berikut ini untuk melakukan konfirmasi: </br>
              ".$lnk."index.php?nohd=".$nohd."
              </div>  
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
        and day(tanggal)=day(getdate()) and statuskirim=1";
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
        // echo "Email dikirim ke :".$rec_email;
        $errkirim = 0;
    }
} 

?>