<?php
session_start();
unset($_SESSION['user_access']);
header('location:./');	
?>