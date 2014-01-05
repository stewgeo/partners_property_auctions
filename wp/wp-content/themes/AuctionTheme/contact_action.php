<?php
$to = "jonnyrharper@gmail.com";
if(isset($_POST['first_name']))
{
	$first_name = $_POST['first_name'];
	}
  else
  {
	$first_name = "";  
  };
if(isset($_POST['last_name']))
{
	$last_name = $_POST['last_name'];
	}
  else
  {
	$last_name = "";  
  };
if(isset($_POST['subject']))
{
	$subject = $_POST['subject'];
	}
  else
  {
	$subject = "No Subject";  
  };
  
   if(isset($_POST['email']))
{
	$email = $_POST['email'];
	}
  else
  {
	$email = "No Email";  
  }; 
  
  if(isset($_POST['message']))
{
	$message = $_POST['message'];
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

  
$headers = 'From:' . filter_name($first_name) . ' ' . filter_name($last_name) . ' <' . filter_email($email) . '>' . "\r\n" .
"BCC: jonny@harperdesigns.co.uk";
 if(mail($to,$subject,$message,$headers)) {
	 if(isset($_POST['newsletter'])){
		 
	 };
     echo "Thank you for your message which has been sent successfully.";
} else { 
     echo "There was a problem sending your message. Please email <a href='mailto:richard@partnerspropertyauctions.co.uk'>richard@partnerspropertyauctions.co.uk</a> or call 07732 374685. Sorry for any inconvenience caused."; 
}  ?>