<?php
include('../api/include/webzone.php');

if($_SESSION['session_account_id']!='') {
	header('Location: ./home.php');
}

$login = $_GET['login'];
$password = $_GET['password'];

if($login!='' && $password!='') {
	if($login==$GLOBALS['admin_login'] && $password==$GLOBALS['admin_password']) {
		$_SESSION['session_account_id'] = 1;
		header('Location: ./home.php');
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Stores Locator Admin</title>
<meta name="description" content="">
<link rel="stylesheet" href="../api/include/css/style.css">
<link rel="stylesheet" href="../api/include/css/blueprint/grid.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="../api/include/js/script.js"></script>
</head>
<body>

<div class="container">

<br>
<h1 style="margin-bottom:10px;">Admin section</h1>
<hr>

<div style="margin-bottom:10px;">Please connect in order to manage your stores and/or categories.</div>

<?php
if($login!='' || $password!='') {
	echo '<div style="margin-bottom:10px;"><font color="red">Your login and/or password are incorrect</font></div>';
}
?>

<form>
<table>
<tr style="height:25px;"><td width="120">Login:</td><td><input type="text" name="login" value="<?php echo $login; ?>"></td></tr>
<tr style="height:25px;"><td>Password:</td><td><input type="password" name="password"></td></tr>
<tr style="height:25px;"><td></td><td><input type="submit" value="Connect"></td></tr>
</table>
</form>

</div>

</body>
</html>