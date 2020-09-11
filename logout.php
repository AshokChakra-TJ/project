<?php
session_start();
unset($_SESSION['user_access_for_flux']);
header('location:./');	
?>