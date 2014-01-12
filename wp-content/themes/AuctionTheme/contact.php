	<link rel="stylesheet" type="text/css" media="all" href="style.css" />
	<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.css" />
<h3>Contact us</h3>
<form action="contact_action.php" method="POST" role="form" class="form form-inline" name="contact">
<label for="first_name">First Name:</label><input name="first_name" id="first_name" class="form-control" type="text" value="<?php
  if(isset($_GET['first_name'])){ $first_name = $_GET['first_name']; }
  else
  {
	$first_name="";  
  }
echo ucwords(str_replace('_', ' ', $first_name));

?>"><br>
<label for="last_name">Last Name:</label><input name="last_name" id="last_name" class="form-control" type="text" value="<?php
  if(isset($_GET['last_name'])){ $last_name = $_GET['last_name']; }
  else
  {
	$last_name="";  
  }
echo ucwords(str_replace('_', ' ', $last_name));

?>"><br>
<label for="email">Your Email:</label><input type="email" autocapitalize="off" autocorrect="off" name="email" class="form-control" required><br>

<label for="subject">Subject:</label><input name="subject" id="subject" class="form-control" type="text" value="<?php
  if(isset($_GET['subject'])){ $subject = $_GET['subject']; }
  else
  {
	$subject="";  
  }
echo ucwords(str_replace('_', ' ', $subject));

?>"><br>
<label for="message">Message:</label><textarea name="message" class="form-control" cols="" rows="10"></textarea><br>
<br>
<input name="Send" type="submit" class="btn">
</form>