<?php
include('../api/include/webzone.php');
unset($_SESSION['session_account_id']);
$_SESSION['session_account_id']='';
header('Location: ./');
?>