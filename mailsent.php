<?php

    require("DBconnect.php");

    $subject = $_POST["subject"];
    $body = $_POST["body"];
    $body = nl2br($body);

    $SQL = "SELECT * FROM mail";
    $result = mysqli_query($link,$SQL);
    

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        //$mail->SMTPDebug = 2;   
        while($row = mysqli_fetch_assoc($result)){
            $email=$row['email'];
                           
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'chclin1030@gmail.com';                   
            $mail->Password   = '5601030a';                  
            $mail->Port       = 465;                                   
            $mail->SMTPSecure = 'ssl';
            $mail->CharSet    ='UTF-8';

            //Recipients
            $mail->setFrom('chclin1030@gmail.com', '+7電子報');
            $mail->addAddress($email);    

            $mail->isHTML(true);                           
            $mail->Subject = "+7電子報主題： ".$subject;
            $mail->Body    = "內容： <br>".$body."<br>"."----------------------------<br>感謝您訂閱+7電子報";

            $mail->send();
        }
        echo "<script type='text/javascript'>";
        echo "alert('已發送電子報');";
        echo "</script>";
        echo "<meta http-equiv='Refresh' content='0; url = mailsentform.php'>";
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

?>