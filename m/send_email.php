<?php
 
if(isset($_POST['email'])) {

    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['name']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['subject']) ||
 
        !isset($_POST['regarding'])) {
 
        died('Please Fill In All Required Fields');       
 
    }
 
     
 
    $name = $_POST['name'];
 
    $email = $_POST['email'];
 
    $subject = $_POST['subject'];
 
    $regarding = $_POST['regarding'];
 
 	$email_to = $_POST['regarding'];
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Name: ".clean_string($name)."\n";
 
    $email_message .= "Subject: ".clean_string($subject)."\n";
 
    $email_message .= "Email: ".clean_string($email)."\n";
	
	if(isset($_POST['name'])){
			$message = $_POST['message'];
			$email_message .= "Message: ".clean_string($message)."\n";
	}
 
	if($email_to == "general")
	{
		$email_to = "mail@aschaffer.com";
	} else {
		$email_to = "contracts@aschaffer.com";	
	}
 
     
 
// create email headers
 
$headers = 'From: '.$email."\r\n".
 
'Reply-To: '.$email."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $subject, $email_message, $headers);  
 
?>
 
 
 
<!-- include your own success html here -->
 
 
<meta http-equiv="refresh" content="0; url=http://aschaffer.com/contact.html" />
Thank you for your message. 
 
 
 
<?php
 
}
 
?>