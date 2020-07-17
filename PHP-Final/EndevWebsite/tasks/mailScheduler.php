<?php
include("../libraries/WrapMySQL.php");
include("../data/dbConnect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require("../vendor/autoload.php");


function SendMailV2($email, $subject, $message)
{
    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->Host     = getenv("SMTPHost"); 
    $mail->SMTPAuth = true; 
    $mail->Username = getenv("SMTPUser");
    $mail->Password = getenv("SMTPPass");

    $mail->Subject = $subject;
    $mail->IsHTML(true);
    $mail->Body     = $message; 
    $mail->AltBody   = strip_tags($message) ;
    $mail->From     = "noreply@endev.at";
    $mail->FromName = "Endev Software Solutions";
    $mail->AddReplyTo("support@endev.at");
    $mail->Sender     = "noreply@endev.at";
    $mail->CharSet  =  "utf-8"; 
    $mail->AddAddress($email);
    $mail->Send();
}

$sql = new WrapMySQL(getenv("DBHost"),getenv("DBName"),getenv("DBUser"),getenv("DBPass"));
$sql->Open();


foreach($sql->ExecuteQuery("SELECT * FROM mailscheduler WHERE MailSent = 0") as $mail)
{
    try
    {
        SendMailV2($mail["MailTo"], $mail["MailHeader"], $mail["MailMessage"]);
        $sql->ExecuteNonQuery("UPDATE mailscheduler SET MailSent = 1 WHERE ID = ?", $mail["ID"]);
    }
    catch (Exception $e) 
    {
        echo "Could not send Mail: ".$e->getMessage()."\n";
    }
}
