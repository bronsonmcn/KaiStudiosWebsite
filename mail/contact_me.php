<?php 
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['subject']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }

require_once "Mail.php";  

$name = $_POST['name'];
$person = $_POST['email'];
$subject = $_POST['subject'];
$from = "$name <noreply@kaistudios.nz>"; 
$to = "Admin <admin@kaistudios.nz>"; 
$mailSubject = "Website Contact Form: $name - $subject";  
$message = $_POST['message']; 
$body = "Name: $name \r\nEmail Address: $person \r\nSubject: $subject \r\n\r\n$message";
$host = "ssl://smtp.zoho.com"; 
$port = "465";
$username = "noreply@kaistudios.nz"; 
$password = "kaistudiosmail";  

$headers = array (
	'From' => $from, 
	'To' => $email_address, 
	'Subject' => $mailSubject, 
	'Reply-To' => $person);
$smtp = Mail::factory('smtp',  
	array ('host' => $host, 
		'port' => $port,
		'auth' => true,  
		'username' => $username,  
		'password' => $password));  
$mail = $smtp->send($to, $headers, $body);  
   
if (PEAR::isError($mail)) {  
	echo("<p>" . $mail->getMessage() . "</p>");  
} 
else {   echo("<p>Message successfully sent!</p>");  
} 
?>