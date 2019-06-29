<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'lib/PHPMailer/src/Exception.php';
	require 'lib/PHPMailer/src/PHPMailer.php';
	require 'lib/PHPMailer/src/SMTP.php';

	$mail = new PHPMailer(true);

	function getUserIP()
	{
    // Get real visitor IP behind CloudFlare network
    	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        	$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    	}
    	$client  = @$_SERVER['HTTP_CLIENT_IP'];
    	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    	$remote  = $_SERVER['REMOTE_ADDR'];

    	if(filter_var($client, FILTER_VALIDATE_IP))
        	$ip = $client;
    	elseif(filter_var($forward, FILTER_VALIDATE_IP))
        	$ip = $forward;
    	else
        	$ip = $remote;

    	return $ip;
	}
	$user_ip = getUserIP();

	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	date_default_timezone_set('Asia/Kolkata');

	try {
	    //Server settings
	    //$mail->SMTPDebug = 4;                                       // Enable verbose debug output
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
	    //$mail->addAddress('junkyymail123456@gmail.com', 'Joe User');     // Add a recipient
	    $mail->addAddress('gsnv.suraj@gmail.com', 'Suraj');               // Name is optional
	    $mail->addReplyTo('junkyymail123456@gmail.com', 'Information');
	    //$mail->addCC('cc@example.com');
	    //$mail->addBCC('junkyymail123456@gmail.com');

	    // Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'This is message from your Website';
	    $mail->Body    = "<b>Name : </b>".$name."<br><br><b>Email : </b>".$email."<br><br><b>Message : </b>".$message."<br><br><b>Date & Time : </b>".date("d M Y h:i:s A")."<br><br><b>IP Add : </b>".$user_ip;
	    $mail->AltBody = "Name : ".$name."\nEmail : ".$email."\nMessage : ".$message."\nDate & Time :".date("d M Y h:i:s A")."\nIP Add :".$user_ip;

	    $mail->send();
	    //echo 'Message has been sent';
			exit(header("location:index.html"));
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

?>