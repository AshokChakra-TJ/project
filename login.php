<?php
$error="";
  if(isset($_POST['sb-lg']))
     {
		
			 $email=$_POST['email-lg'];
			 $password=$_POST['password-lg'];
			 include_once('config.php');
			 $username=mysqli_real_escape_string($con,$email);
			 $password=mysqli_real_escape_string($con,$password);
			 $query_for_login="select*from users where email='$email' and password='$password'";
			 $ck_for_login=mysqli_query($con,$query_for_login);
			 $chotu_for_login=mysqli_fetch_array($ck_for_login);
			 if($chotu_for_login>0)
			 {
				 session_start();
		        $_SESSION["user_access"]=$email;
				header("location:dashboard.php");
			 }
			 else
			 {
				 $error="<br><font color='red'>Incorrect Email or Password!</font>";
			 }
			 mysqli_close($con);
			 
		 
	 }

?>