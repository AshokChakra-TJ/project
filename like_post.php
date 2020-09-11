<?php
include_once('config.php');
if(isset($_POST['like_btn']))
	 {
		 $ss=$_POST['like_btn'];
		 $ll=$_POST['likes_h'];
		 $likes2=$ll+1;
		 $like_q="update master_post set likes='$likes2' where sn='$ss'";
		 $ck_like_q=mysqli_query($con,$like_q);
		 header("location:dashboard.php#$ss");
	 }
	 
?>