<?php
include('config/bd_connect.php');
include('blocks/top_bd_connect.php');
if(isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['apikey']))
{
header('Location: /');
}
if($_GET)
{
//$_GET['email']=addslashes($_GET['email']);
//$_GET['code']=addslashes($_GET['code']);
$query_mail="SELECT * FROM `accounts` WHERE `email` LIKE '".$_GET['email']."'";
$res_mail=mysql_query($query_mail) or die (mysql_error());
$number_mail=mysql_num_rows($res_mail);
if($number_mail == 1)
{
while($row_mail=mysql_fetch_array($res_mail)) {
$password_mail=md5($row_mail['password']);
}
if($password_mail == $_GET['code'])
{
//Send password
$error_mail=3;
$new_password=rand(10000, 32000)+rand(10000, 32000);
$query_past="UPDATE `main`.`accounts` SET `password` = '".md5($new_password)."' WHERE `accounts`.`email` = '".$_GET['email']."';";
$res_past=mysql_query($query_past) or die (mysql_error());

$site_adress='seescreen.test';//Адрес сайта в письме
$header='From: '.$site_adress."\n";
$header.='Content-Type: text/html; charset="UTF-8"'."\n";
$header.="Content-Transfer-Encoding: 8bit\n";
$title ='Пароль успешно изменён';
mail($_POST['email'], $title , "Теперь ваш пароль на сайте ".$site_adress.": ".$new_password." . Сменить его вы можете в разделе Настройки на нашем сайте.\nС уважением, SEScreen", $header);
}
}
}
if($_POST)
{
//$_POST['email']=addslashes($_POST['email']);
$query_mail="SELECT * FROM `accounts` WHERE `email` LIKE '".$_POST['email']."'";
$res_mail=mysql_query($query_mail) or die (mysql_error());
$number_mail=mysql_num_rows($res_mail);
echo $_POST['email'];
if($number_mail == 0)
{
//Error
$error_mail=1;
}
else 
{
//Send message
$error_mail=2;
while($row_mail=mysql_fetch_array($res_mail)) {
$password_mail=$row_mail['password'];
}

$site_adress='seescreen.test';//Адрес сайта в письме
$header='From: '.$site_adress."\n";
$header.='Content-Type: text/html; charset="UTF-8"'."\n";
$header.="Content-Transfer-Encoding: 8bit\n";
$title ='Инструкция по смене пароля';
mail($_POST['email'], $title , "Чтобы сменить пароль на сайте ".$site_adress." перейдите по этой ссылке http://".$site_adress."/new_password.php?code=".md5($password_mail)."&email=".$_POST['email']." . Если вы не не делали запрос на смену пароля, значит кто-то пытался взломать ваш аккаунт.\nС уважением, SEScreen", $header);
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SEScreen | Восстановление пароля</title>
<?php include('blocks/top.php'); ?>
<h1>Восстановление пароля</h1>



<p>Для восстановления пароля введите адрес вашей электронной почты.</p>
<div id="oshFormReg" <?php if($error_mail == 1 || $error_mail == 2 || $error_mail == 3) { echo 'style="display: block;"'; } ?>><?php if($error_mail == 1) { echo 'К сожалению, такого почтового адреса нет в нашей базе данных'; } if($error_mail == 2) { echo 'Инструкция для восстановления пароля выслана на e-mail'; } if($error_mail == 3) { echo 'Новый пароль выслан вам на e-mail'; } ?></div>
<form method="post" action="new_password.php" name="entry">
<table class="registrationTable">
<tr>
<td>E-mail:</td><td><input type="text" name="email" class="input_enry_form"/></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Выстлать пароль" /> 
</td>
</tr>
</table>
</form>


  
 <br />
<?php include('blocks/bottom.php'); ?>