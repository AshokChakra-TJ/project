<?php
include_once('config.php');
session_start();
if($_SESSION['user_access_for_flux'])
{
	$session_email=$_SESSION['user_access_for_flux'];
if(isset($_POST['sb-comment']))
	 {
		 $ss=$_POST['sb-comment'];
		 $comment=$_POST['comment_text'];
		 
		 $comment_q11="insert into comments values('','$ss','$session_email','$comment',CURRENT_TIMESTAMP(),'1')";
		 $ck_comment_q11=mysqli_query($con,$comment_q11);
		 header("location:dashboard.php#$ss");
	 }
}
else
{
	echo "Access Denied!";
}
	 
?>