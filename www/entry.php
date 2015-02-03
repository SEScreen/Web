<?php
include('config/bd_connect.php');
include('blocks/top_bd_connect.php');

if(isset($_POST['email']) && isset($_POST['password']))
{
//Check user
$_POST['email']=addslashes($_POST['email']);
$_POST['password']=addslashes($_POST['password']);
$query_user="SELECT * FROM `accounts` WHERE `email` LIKE '".$_POST['email']."'  AND `password` LIKE '".md5($_POST['password'])."'";
$res_user=mysql_query($query_user) or die (mysql_error());
$number_user=mysql_num_rows($res_user);
if($number_user == 1)
{
while($row_user=mysql_fetch_array($res_user)) {
$id_user=$row_user['i'];
$password_user=$row_user['password'];
$apikey_user=$row_user['apikey'];
$_SESSION['email']=$_POST['email'];
$_SESSION['password']=$password_user;
$_SESSION['apikey']=$apikey_user;
header('Location: '.$url_page.'?'.$get_vars);
}
}
else {
/*Error entry*/
$error=1;
}
//Check user
}
if(isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['apikey']))
{
header('Location: /');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SEScreen | Вход</title>
<?php include('blocks/top.php'); ?>
<h1>Вход</h1>
<?php
if($error == 1) {
?>

<div id="oshFormReg" style="display:block;">Вы ввели неверный логин или пароль! Может быть вы <a href="new_password.php">забыли пароль</a>?</div>



<?php
}
?>
  <form method="post" action="entry.php" name="entry">
<table class="registrationTable">
<tr>
<td>E-mail:</td><td><input type="text" name="email" class="input_enry_form"/></td>
</tr>
<tr>
<td>
Пароль: </td><td><input type="password" name="password" class="input_enry_form" /></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Войти" style=" width: 57px;" /> 
</td>
</tr>
</table>
</form>

 <br />
<?php include('blocks/bottom.php'); ?>