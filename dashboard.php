<!DOCTYPE html>
<?php 
include_once('config.php');
include 'logic.php';
session_start();
if($_SESSION['user_access'])
{
	$session_email=$_SESSION['user_access'];
	$q="select*from users where email='$session_email'";
	$ck=mysqli_query($con,$q);
	$chotu=mysqli_fetch_array($ck);
	$sn=$chotu['sn'];
	$name=$chotu['name'];
  $email=$chotu['email'];
  $type=$chotu['type'];
  $address=$chotu['address'];
  $occupation=$chotu['occupation'];
	$pic=$chotu['pic'];
	$q2="select*from events where status=1";
	$ck2=mysqli_query($con,$q2);
	$chotu2=mysqli_fetch_array($ck2);
	$event_title=$chotu2['event_title'];
	$event_description=$chotu2['event_description'];
	$q3="select*from `user_notifications_$session_email`";
	$ck3=mysqli_query($con,$q3);
	$chotu3=mysqli_fetch_array($ck3);
	$note=$chotu3['note'];
	 
}
else{header("location:index.php");}


?>

<html>
<head>

<title>Covid-19 Feedbook | Dashboard</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style/style.css">
<link rel="stylesheet" href="style/theme.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
</head>
<body class="w3-theme-l5">
<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onClick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Covid-19 Feedbook</a>
  <div class="w3-dropdown-hover w3-hide-small">
    <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">1</span></button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
      <a href="#" class="w3-bar-item w3-button"><?php echo $note;?></a>
    </div>
  </div>
  <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Logout">Logout</a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account"><img src="<?php echo "./$pic"; ?>" class="w3-circle" style="height:25px;width:25px" alt="<?php echo $session_email ?>"></a>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="logout.php" style="margin:50px 0 0 0;" class="w3-bar-item w3-button w3-padding-large">Logout</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Notifications</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Settings</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>
<a name="top"></a>
<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <p class="w3-center"><img src="<?php echo "./$pic"; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <h4 class="w3-center"><?php echo $name ?></h4>
         <hr>
         <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-text-theme"></i><?php echo $type ?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i><?php echo $address ?></p>
         <p><i class="fa fa-book fa-fw w3-margin-right w3-text-theme"></i><?php echo $occupation ?></p>
        </div>
      </div>
      <br>
      
      <!-- Stats -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onClick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l2 w3-left-align">
          <i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>India Cases
          </button>
          <div id="Demo1" class="w3-hide w3-container">
          <table>
          <tr style="color:purple"><th align="left">Confirmed: </th><td><?php echo $total_confirmed_india;?></td></tr>
          <tr style="color:orange"><th align="left">Active: </th><td><?php echo $total_confirmed_india-$total_recovered_india-$total_deaths_india;?></td></tr>
          <tr style="color:green"><th align="left">Recovered: </th><td><?php echo $total_recovered_india;?></td></tr>
          <tr style="color:red"><th align="left">Deaths: </th><td><?php echo $total_deaths_india;?></td></tr>
          </table>
          </div>
          <button onClick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l2 w3-left-align">
          <i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i>Worldwide Cases
          </button>
          <div id="Demo2" class="w3-hide w3-container">
          <table>
          <tr style="color:purple"><th align="left">Confirmed: </th><td><?php echo $total_confirmed;?></td></tr>
          <tr style="color:orange"><th align="left">Active: </th><td><?php echo $total_confirmed-$total_recovered-$total_deaths;?></td></tr>
          <tr style="color:green"><th align="left">Recovered: </th><td><?php echo $total_recovered;?></td></tr>
          <tr style="color:red"><th align="left">Deaths: </th><td><?php echo $total_deaths;?></td></tr>
          </table>
          </div>
          
        </div>      
      </div>
      <br>
      
      <!-- Do's --> 
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
      
        <p><strong>Do's!</strong></p>
        <p>Stay Home, Stay Safe!
        <br>Wear a Mask
        <br>Maintain Distance
        <br>Wash Hands
        </p>
      </div>
      <br>
      
      <!-- Don'ts -->
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        
        <p><strong>Don'ts!</strong></p>
        <p>Don’t Panic, Take It Easy
        <br>Avoid Fake News
        <br>Avoid Going Out
        </p>
      </div>
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
            
              <h6 class="w3-opacity">Create New Post</h6>
              <form action="" method="post" enctype="multipart/form-data">
              <p   onMouseOver="window.cookie()" onKeyUp="window.cookie()" contenteditable style="width:100%;" id="text" name="text" class="w3-border w3-padding"></p> 
                 
              <script>
			  function cookie()
			  {
			 // alert("Called");
			  te=document.getElementById('text').innerHTML;
   			  document.cookie='cookievar='+te;
			  }
			</script>
  <?php
	if(isset($_POST['post-sb']))
	{		
	$text=$_COOKIE["cookievar"];;
	$dir="images/masterpost/";
	$post_pic=$dir.basename($_FILES['post_pic']['name']);
	move_uploaded_file($_FILES['post_pic']['tmp_name'],$post_pic);
	$q4="insert into master_post values('','$text','$post_pic','','$session_email',CURRENT_TIMESTAMP(),'1')";
	$ck4=mysqli_query($con,$q4);																						 
	}
  ?>
              
              
              
              
                      
               <button style="margin:10px 0 0 0;" name="post-sb" type="submit" class="w3-button w3-theme w3-right"><i class="fa fa-pencil"></i>  Post</button> <label style="margin:10px 0 0 0;" id="label11" for="files" class="w3-button w3-theme"><i class="fa fa-photo"></i>  Attach Photo</label><input name="post_pic" type="file" accept="image/*" id="files" style="visibility:hidden;" onChange="document.getElementById('label11').innerHTML=' Attached!';">
              </form>
            </div>
          </div>
        </div>
      </div>
 <?php
 $post_q="select*from master_post where status='1' order by sn desc";
 $ck_post_q=mysqli_query($con,$post_q);
 while($rr=mysqli_fetch_array($ck_post_q))
 {
	 //post wala logic
	 $sn=$rr['sn'];
	 $text1=$rr['text'];
	 $post_p=$rr['pic'];
	 $p_user=$rr['user'];
	 $likes=$rr['likes'];
	 $p_time=$rr['created_on'];
	 $qurr="select name, pic from users where email='$p_user'";
	 $ck_qurr=mysqli_query($con,$qurr);
	 $ct=mysqli_fetch_array($ck_qurr);
	 $p_username=$ct['name'];
	 $p_user_pic=$ct['pic'];
	 
	 //comment wala logic
	 $com_q="select*from comments where p_sn='$sn' and status='1'";
	 $ck_com_q=mysqli_query($con,$com_q);
	
 ?>
 <a name="<?php echo $sn;?>"></a>
      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <img src="<?php echo "./$p_user_pic"; ?>" alt="" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <span class="w3-right w3-opacity"><?php echo $p_time; ?></span>
        <h4><?php echo $p_username ?></h4><br>
        <hr class="w3-clear">
        <p><?php echo $text1; ?></p>
          <div class="w3-row-padding" style="margin:0 -16px">
            
              <img src="<?php echo "./$post_p"; ?>" style="width:100%" alt="No image in this post" class="w3-margin-bottom">
      
        </div>
        <b style="color:#52769A"><?php echo $likes; ?> Likes</b>
        <hr>
        <form action="like_post.php" method="post">
        <input type="text" value="<?php echo $likes ?>" name="likes_h" style=" visibility:hidden; position:absolute;">
        <button value="<?php echo $sn;?>" name="like_btn" id="like<?php echo $sn;?>" type="submit" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button>
 
        <button id="ccmmpp<?php echo $sn?>" onClick="
        if(document.getElementById('comm<?php echo $sn?>').style.display=='none')
			{
				document.getElementById('comm<?php echo $sn?>').style.display='block';
                document.getElementById('ccmmpp<?php echo $sn?>').innerHTML='Hide Comments';
			}
			else
			{
			document.getElementById('comm<?php echo $sn?>').style.display='none';
            document.getElementById('ccmmpp<?php echo $sn?>').innerHTML='Comment';
			}
            " type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> 
         Comment</button> <br>
         </form>
         
         <span id="comm<?php echo $sn?>" style="display:none;">
         <?php 
		  while($com_ct=mysqli_fetch_array($ck_com_q))
		  {
	 	  $com_sn=$com_ct['sn'];
	 	  $com_p_sn=$com_ct['p_sn'];
	 	  $com_user=$com_ct['user'];
	 	  $com_comment=$com_ct['comment'];
	 	  $com_created_on=$com_ct['created_on'];
		  $qqmmt="select name from users where email='$com_user'";
		  $ck_qqmmt=mysqli_query($con,$qqmmt);
		  $com_ct2=mysqli_fetch_array($ck_qqmmt);
		  $com_name=$com_ct2['name'];
		 ?>
         <div class="w3-container w3-round w3-theme-l4 " style="margin:0 0 1px 0;">         
         <b id="user-name" style="color:#666;"><?php echo $com_name;?> 
         <span style="font-size:9px;">(<?php echo $com_created_on;?>)</span></b><br>
         <i><?php echo $com_comment;?></i>
         </div>
         <?php
		 }
		 ?>
         
         <form action="comment_post.php" method="post">
		<input maxlength="200" name="comment_text" class="w3-border w3-padding" type="text" placeholder="Comment..." style="width:100%; margin:10px 0 10px 0;">
        <button value="<?php echo $sn;?>" type="submit" name="sb-comment" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-check"></i> Submit</button>
        </form></span>
        
      </div>
      
      <?php } ?>
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Government Site:</p>
          <p><strong><?php echo $event_title; ?></strong></p>
          <p><?php echo $event_description; ?></p>
          <p><button class="w3-button w3-block w3-theme-l4"><a href="https://www.mohfw.gov.in" >MoHFW</a></button></p>
        </div>
      </div>
      <br>
      
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Donate To</p>
          <img src="<?php echo "./$pic";?>" alt="Avatar" style="width:50%"><br>
          <span><?php echo $name ?></span>
          <div class="w3-row w3-opacity">
            <div class="w3-half">
              <button class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button>
            </div>
            <div class="w3-half">
              <button class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
            </div>
          </div>
        </div>
      </div>
      <br>
      
      <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
        <p>Donate to NGOs</p>
        <p><button class="w3-button w3-block w3-theme-l4"><a href="https://www.cry.org/">CRY</a></button></p>
        <p><button class="w3-button w3-block w3-theme-l4"><a href="http://doctorsforyou.org/">Doctors For You </a></button></p>
        <p><button class="w3-button w3-block w3-theme-l4"><a href="https://www.helpageindia.org/">HelpAge India</a></button></p>
      </div>
      <br>
      
      <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
        <p><i class="fa fa-bug w3-xxlarge"></i><br> <a href="mailto:c19feedbook@gmail.com">Report Bugs</a> </p>
      </div>
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>2020 &copy; Covid-19 Feedbook</h5><h4><a type="button" class="w3-button w3-theme" href="#top">&uarr; Top</a></h4>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Developed by Ashok Choudhary, Harshit Jain and Shivam Singhal</p>
</footer>
 
<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html> 