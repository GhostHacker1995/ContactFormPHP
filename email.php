<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

// include('include/footer.php'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//require 'vendor/autoload.php';

require 'include/src/PHPMailer.php';
require 'include/src/SMTP.php';
require 'include/src/Exception.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {

    $full_name = $_REQUEST['full_name'];
    $email_address = $_REQUEST['email_address'];
    $subject = $_REQUEST['subject'];
    $message = $_REQUEST['message'];

    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        // create a google account where the email will pass smtp 
        // replace mine with the account created
        
        $mail->Username = "grayhostsmtp@gmail.com";
        $mail->Password = "qvzxzikebjnvpulg";
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        //Recipients
        $mail->setFrom($email_address, $full_name);

        //use the company's email here
        // replace yours with the company's email
       
        $mail->addAddress('info@grayhost.co', 'Grayhost Innovations');
        $mail->addReplyTo('info@grayhost.co', 'Contacting you through your website');
        
        $mail->addAddress('mwebembezijosh7@gmail.com', 'Mwebembezi Joshua');
        $mail->addReplyTo('mwebembezijosh7@gmail.com', 'Contacting through the website');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Contacting you through your website';
        $mail->Body = 'Dear Grayhost Innovations,<br/><br/>

        I hope this email finds you well. I am contacting you through your 
        website and these are the details below.<br/><br/>
        
        ' . $full_name . '<br/>
        ' . $email_address . '<br/>
        ' . $subject . '<br/>
        ' . $message;

        $mail->AltBody = 'Dear Grayhost Innovations,<br/><br/>

        I hope this email finds you well.<br/><br/>

        Thank you for your time and assistance.</b>.<br/><br/>
        
        Best regards,<br/><br/>
        
        ' . $full_name . '<br/>
        ' . $email_address ;

        $mail->send();
        // echo 'Message has been sent';
        header("Location: http://localhost/ContactForm/success-email.php", true, 301);
        // header("Location: https://www.nsim-marketing.com/success-email.php", true, 301);
        exit();
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // header("Location: https://www.nsim-marketing.com/error-email.php", true, 301);
        header("Location: http://localhost/ContactForm/error-email.php", true, 301);
        exit();
    }

}

?>