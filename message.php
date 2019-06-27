<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->isSMTP();                                            // Set mailer to use SMTP
	    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'junkyymail123456@gmail.com';                     // SMTP username
	    $mail->Password   = '******';                               // SMTP password
	    //$mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
	    $mail->Port       = 587;
	    $mail->SMTPOptions = array(
    			'ssl' => array(
        		'verify_peer' => false,
        		'verify_peer_name' => false,
        		'allow_self_signed' => true
    			)
			);                                   // TCP port to connect to

	    //Recipients
	    $mail->setFrom('junkyymail123456@gmail.com', 'Mailer');
	    $mail->addAddress('junkyymail123456@gmail.com', 'Joe User');     // Add a recipient
	    $mail->addAddress('gsnv.suraj@gmail.com');               // Name is optional
	    $mail->addReplyTo('junkyymail123456@gmail.com', 'Information');
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('junkyymail123456@gmail.com');

	    // Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Here is the subject';
	    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
	    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


	    $mail->send();
	    echo 'Message has been sent';
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

?>