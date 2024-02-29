<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST["send"])) {

    $mail = new PHPMailer(true);

    try {
        
        $mail->isSMTP();                
        $mail->Host       = 'smtp.gmail.com';   
        $mail->SMTPAuth   = true;               
        $mail->Username   = 'freedomairconjaipur01@gmail.com'; 
        $mail->Password   = 'rkzkhofhytqbhfpu';    
        $mail->SMTPSecure = 'tls';              
        $mail->Port       = 587;                

        
        $mail->setFrom($_POST["email"], $_POST["name"]); 
        $mail->addAddress('freedomairconjaipur01@gmail.com');     
        $mail->addReplyTo($_POST["email"], $_POST["name"]); 

       
        $mail->isHTML(true);
        $mail->Subject = 'This User Want more details about Your Work';
        $mail->Body    = "Name: {$_POST['name']} <br>" .
                         "Phone: {$_POST['phone']} <br>" .
                         "Message: {$_POST['message']}";

        // Send the email
        $mail->send();
        
        // Redirect back to the contact form page after sending the email
        header('Location: contact.php?success=true');
        exit();
    } catch (Exception $e) {
        // Handle errors if the email couldn't be sent
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>