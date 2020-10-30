<?php
error_reporting(0);
include_once('config.php');
include_once('login.php');
session_start();
if($_SESSION['user_access']){
	header("location:dashboard.php");
}
$lg_mess="";
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Covid-19 Feedbook</title>
<link rel="stylesheet" type="text/css" href="style/log_th.css">
<style type="text/css">
*{margin:0; padding:0;}
.pointer{}
.pointer:hover{cursor:pointer;}
.color-lite{color:#9FF;}
</style>
</head>
<body>
<?php
$mes="";
if(isset($_POST['sb'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$ck_email_q="select email from users";
	$ck_ck_email_q=mysqli_query($con,$ck_email_q);
	$flag=0;
	while($chotu=mysqli_fetch_array($ck_ck_email_q)){
		$email_vfy=$chotu['email'];
		if($email==$email_vfy){
			$flag=1;
			break;
		}
	}
	if($flag==1){
		$mes="<br><font color='red'>This email address is already registered! try another to sign up.</font>";
	}
	else{
	
	$password=$_POST['password'];
	$type=$_POST['type'];
	$address=$_POST['address'];
	$occupation=$_POST['occupation'];
	mkdir("./images/users/$email");
	mkdir("./images/users/$email/profile");
	$dir="images/users/$email/profile/";
	$pic=$dir.basename($_FILES['pic']['name']);
	move_uploaded_file($_FILES['pic']['tmp_name'],$pic);
	$query_sign_up="insert into users values(NULL,'$name','$email','$password','$type','$address','$occupation','$pic',CURRENT_TIMESTAMP,NOW(),'1')";
	$ck_sign_up=mysqli_query($con,$query_sign_up);
	$query2="CREATE TABLE `user_images_$email`(sn INT(11) NOT NULL AUTO_INCREMENT,image_description VARCHAR(50) NULL DEFAULT NULL,pic VARCHAR(200) NOT NULL, status TINYINT(1) NOT NULL , PRIMARY KEY (sn))";
	$ck2=mysqli_query($con,$query2);
	$query3="CREATE TABLE `user_notifications_$email`(sn INT(11) NOT NULL AUTO_INCREMENT ,note VARCHAR(100) NOT NULL ,created_on VARCHAR(70) NOT NULL ,status TINYINT(1) NOT NULL , PRIMARY KEY (sn))";
	$ck3=mysqli_query($con,$query3);
	$query4="CREATE TABLE `user_friends_$email`(sn INT(11) NOT NULL AUTO_INCREMENT,email VARCHAR(100) NOT NULL ,created_on VARCHAR(70) NOT NULL , PRIMARY KEY (sn))";
	$ck4=mysqli_query($con,$query4);
	$lg_mess="Your account has been created successfully.";
}}

?>
<div align="center">
<br>
<div class="text" style="background-color:#333; padding:10px 0 10px 0; margin-top:-20px; position:fixed; width:100%;">Covid-19 Feedbook</div>
<br>
<br>
<p style="font-size:24px; font-family:'Courier New', Courier, monospace; background-color:#CC9; margin-top:10px;"><?php echo $lg_mess; ?></p>
<div class="text" style="color:#FFF; font-weight:bold; font-size:36px; margin-top:20px;">Log in to your account</div>
<br>

<form action="" method="post" enctype="multipart/form-data">
<table border="0">
<tr align="center"><td><input type="text" name="email-lg" class="button" placeholder="Email"></td></tr>
<tr align="center"><td><input type="password" name="password-lg" class="button" placeholder="Password"><?php echo $error ?></td></tr>
<tr align="center"><td align="center"><input name="sb-lg" type="submit" value="Log In" class="button pointer" style="background-color:#06F; width:100px; color:#FFF;"></td></tr>

</table>
</form>
<br>
<br>
<div class="sign_up_box" style="padding-top:20px; padding-bottom:30px;">

<div class="text" style="color:#FFF; font-weight:bold; font-size:36px">Create new account</div>
<br>
<form action="" method="post" enctype="multipart/form-data">
<table border="0" align="center">
<tr align="center"><td colspan="2"><input style="width:100%" required placeholder="Full name" type="text" name="name" class="button2"></td></tr>
<tr align="center"><td><input required placeholder="Email address" type="email" name="email" class="button2"><?php echo $mes ?></td>
<td><input required placeholder="Password" type="password" name="password" class="button2"></td></tr>
<tr align="center"><td>
<select name="type" id="type" class="button2">
	<option value="select">---Choose type---</option>
	<option value="Doner">Doner</option>
	<option value="Receiver">Receiver</option>
</select> 
</td>
<td><label for="files" id="label_1" class="button pointer" style="width:250px; background-color:#0F6; padding:10px; color:#FFF">Choose profile picture</label><input  type="file" name="pic" style="display:none;" id="files" onChange="document.getElementById('label_1').innerHTML='Picture choosed!';"></td></tr>
<tr><td colspan="2"><textarea placeholder="Address" class="button2" style="width:100%; padding:10px; height:80px;" name="address"></textarea></td></tr>
<tr><td colspan="2"><input style="width:100%;" required placeholder="Occupation" name="occupation" type="text" class="button2"></td></tr>
<tr align="center"><td colspan="2" align="center"><input name="sb" type="submit" value="Sign Up" class="button pointer" style="background-color:#C93; width:180px; color:#FFF;"></td></tr>

</table>
</form>
</div>
<div class="text2" style="background-color:#333; text-align:center;">2020 &copy; Covid-19 Feedbook<br>
Developed by Ashok Choudhary, Harshit Jain  and Shivam Singhal <br>c19feedbook@gmail.com
</div>
</div>
</body>
</html>
