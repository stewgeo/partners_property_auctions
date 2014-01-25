<?php
if(isset($_POST['to']))
{
	$to = $_POST['to'];
	}
  else
  {
	$to = "info@partnerspropertyauctions.co.uk";  
  };
if(isset($_POST['contact-name']))
{
	$contact_name = $_POST['contact-name'];
	}
  else
  {
	$contact_name = "";  
  };
if(isset($_POST['contact-subject']))
{
	$subject = $_POST['contact-subject'];
	}
  else
  {
	$subject = "No Subject";  
  };
  
   if(isset($_POST['contact-email']))
{
	$email = $_POST['contact-email'];
	}
  else
  {
	$email = "No Email";  
  }; 
  
  if(isset($_POST['contact-msg']))
{
	$message = $_POST['contact-msg'];
	}
  else
  {
	$message = "No Message";  
  };
// Filter Name
function filter_name( $input ) {
	$rules = array( "/r" => '', "/n" => '', "/t" => '', '"'  => "'", '<'  => '[', '>'  => ']' );
	$name = trim( strtr( $input, $rules ) );
	return $name;
}

// Filter Email
function filter_email( $input ) {
	$rules = array( "/r" => '', "/n" => '', "/t" => '', '"'  => '', ','  => '', '<'  => '', '>'  => '' );
	$email = strtr( $input, $rules );
	return $email;
}  

if ($to == 'info@partnerspropertyauctions.co.uk'){
	$cc='';
} else
{
	$cc='info@partnerspropertyauctions.co.uk';
}
  
$headers = 'From:' . filter_name($contact_name) . ' <' . filter_email($email) . '>' . "\r\n" .
"CC: " . $cc;
 if(mail($to,$subject,$message,$headers)) {
     echo "Thank you for your message which has been sent successfully.";
} else { 
     echo "There was a problem sending your message. Please email <a href='mailto:info@partnerspropertyauctions.co.uk'>info@partnerspropertyauctions.co.uk</a> or call 07732 374685. Sorry for any inconvenience caused."; 
}  ?>