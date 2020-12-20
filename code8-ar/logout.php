<?php
session_start();
unset($_SESSION[SESS_CUSTOMER_ID]);
header("location:index.php");
exit();
?>