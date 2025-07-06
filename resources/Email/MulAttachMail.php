<?php
// Include PHPMailerAutoload.php library file
@session_start();
include ("lib/PHPMailerAutoload.php");
@include("../../modul.php");
        $query = "INSERT INTO [dbo].[MEmail]
                       ([NoEmail]
                       ,[EmailTo]
                       ,[EmailNote]
                       ,[EmailDate]
                       ,[UserID]
                       ,[EmailTitle])
                 VALUES
                       ((SELECT isnull('E'+right('000000000'+convert(varchar(9),MAX(right(NoEmail,9))+1),9),'E000000001') as NoEmail
from MEmail)
                       ,'".$_POST["rec_email"]."'
                       ,'".$_POST["box_msg"]."'
                       ,getdate()
                       ,'".$_SESSION["siapa_depo"]."'
                       ,'".$_POST["eSubject"]."')";
        execute_query($query);

$sen_name = "";
$sen_email = "";
$rec_email = "";
$email_sub = "";
$box_msg = "";
// Retrieving & storing user's submitted information
if (isset($_POST['sen_name'])) {
    $sen_name = $_POST['sen_name'];
}
if (isset($_POST['sen_email'])) {
    $sen_email = $_POST['sen_email'];
}
if (isset($_POST['rec_email'])) {
    $rec_email = $_POST['rec_email'];
}
if (isset($_POST['email_sub'])) {
    $email_sub = $_POST['email_sub'];
}
if (isset($_POST['box_msg'])) {
    $box_msg = $_POST['box_msg'];
}

if (isset($_FILES) && (bool) $_FILES) {
    $files = array();
    $ext_error = "";
    $seq = 1;
    // Define allowed extensions
    $allowedExtentsoins = array('pdf', 'doc', 'docx', 'gif', 'jpeg', 'jpg', 'png', 'rtf', 'txt','zip', 'xlsx');
    foreach ($_FILES as $name => $file) {
        if (!$file['name'] == "") {
            $file_name = $file['name'];
            $temp_name = $file['tmp_name'];
            $path_part = pathinfo($file_name);
            $ext = $path_part['extension'];

            // Checking for extension of attached files
            if (!in_array($ext, $allowedExtentsoins)) {
                echo "<script>alert('Sorry!!! ." . $ext ."Extension is not allowed!!! Try Again.')</script>";
                $ext_error = FALSE;
				}else{
                $ext_error = True;
            }

            // Store attached files in uploads folder
            $server_file = dirname(__FILE__) . "/uploads/" .$seq."-" . $path_part['basename'];
            move_uploaded_file($temp_name, $server_file);
            array_push($files, $server_file);
            $query = "INSERT INTO MFileEmail(NoEmail,Seq,FileName)
                      VALUES((SELECT max(NoEmail) from MEmail),
                             '".$seq."',
                             '".$seq."-".$file_name."')";
            execute_query($query);
            $seq = $seq + 1;
        }
    }
if($ext_error != FALSE){
    $mail = new PHPMailer();
    $mail->IsSMTP();
    //$mail->SMTPDebug = 2;
    $mail->Mailer = "smtp";
    $mail->Host = "mail.rutan.co.id";
    $mail->Port = 465;

    // Enable SMTP authentication
    $mail->SMTPAuth = FALSE;

    // SMTP username (e.g xyz@gmail.com)
    $mail->Username = 'limitkredit2@rutan.co.id';

    // SMTP password
    $mail->Password = 'ZxCv1234';

    // Enable encryption, 'tls' also accepted
    $mail->SMTPSecure = 'ssl';

    // Sender Email address
    $mail->From = $sen_email;

    // Sender name
    $mail->FromName = $sen_name;

    // Receiver Email address
    $mail->addAddress($rec_email);

    // Attaching files in the mail
    foreach ($files as $file) {
        $mail->addAttachment($file);
    }
    $mail->Subject = $email_sub;
    $mail->Body = $box_msg;
    $mail->WordWrap = 50;

    // Sending message and checking status
    if (!$mail->send()) {
        echo "<script>alert('Sorry!!! Message was not sent. Mailer error:  " . $mail->ErrorInfo . ")</script>";
        exit;
    } else {
        echo "<script>alert('Congratulations!!! Your Email has been sent successfully!!!')</script>";
    }
    // Deleting files from the uploads folder
    foreach ($files as $file) {
        unlink($file);
    }
    echo "<script>window.location='../../main/home.php';</script>";
}else{
    foreach ($files as $file) {
        unlink($file);
    }
    echo "<script>window.location='index.php';</script>";
}
}
?>
<script src="js/jquery.js"></script>