<?php
include('config/bd_connect.php');
include('blocks/top_bd_connect.php');
if(!isset($_SESSION['email']) || !isset($_SESSION['password']) || !isset($_SESSION['apikey']))
{
header('Location: /');
mysql_close();
}
?>
<?php
if($_GET && isset($_GET['mail']) && isset($_GET['code']))
{
//Check new mail
$_GET['mail']=addslashes($_GET['mail']);
$_GET['code']=addslashes($_GET['code']);
$query_code="SELECT * FROM `newmail` WHERE `newmail` LIKE '".$_GET['mail']."'  AND `code` LIKE '".$_GET['code']."'";
$res_code=mysql_query($query_code) or die (mysql_error());
$number_code=mysql_num_rows($res_code);
if($number_code == 1)
{
$query_past="UPDATE `main`.`accounts` SET `email` = '".$_GET['mail']."' WHERE `accounts`.`email` ='".$emailUSER."';";
$res_past=mysql_query($query_past) or die (mysql_error());
$_SESSION['email']=$_GET['mail'];
/*$cooc_life=time()+3600*24*30;
setcookie('email', $_GET['mail'], $cooc_life);*/
$emailUSER=$_GET['mail'];
$true_change=1;//Change mail true
}
else
{
$true_change=2;//Change mail false
}
//Check new mail
}
if($_POST)
{
//Change password function
if(isset($_POST['pas1']) && isset($_POST['pas2']))
{
if($passwordUSER == md5($_POST['pas']))
{
/*Change password*/
$_POST['pas1']=addslashes($_POST['pas1']);
$_POST['pas2']=addslashes($_POST['pas2']);
if($_POST['pas1'] == $_POST['pas2'])
{
$query_past="UPDATE `main`.`accounts` SET `password` = '".md5($_POST['pas1'])."' WHERE `accounts`.`email` ='".$emailUSER."';";
$res_past=mysql_query($query_past) or die (mysql_error());
$error_pass=2;
$_SESSION['password']=$_POST['pas1'];
$passwordUSER=$_POST['pas1'];
/*$cooc_life=time()+3600*24*30;
setcookie('password', md5($_POST['pas1']), $cooc_life);*/
}
/*Change password*/
}
else
{
$error_pass=1;
}
}
//Change password function

//Change name
if(isset($_POST['newName']))
{
if(preg_match("|^[A-Za-zА-Яа-я ]+$|i", $_POST['newName']))
{ $name=1;
}
else { $name=2; }
if($name == 1)
{
$query_past="UPDATE `main`.`accounts` SET `username` = '".$_POST['newName']."' WHERE `accounts`.`email` ='".$emailUSER."';";
$res_past=mysql_query($query_past) or die (mysql_error());
$username_user=$_POST['newName'];

}

}
//Change name

//Change e-mail
if(isset($_POST['newEMail']))
{
if($passwordUSER == md5($_POST['password']))
{
if(!filter_var($_POST['newEMail'], FILTER_VALIDATE_EMAIL))
{ 
$errorNewMail=2;//Error mail 

}
else { $errorNewMail=3; //Good mail
$date=time();
$year=date(Y, $date);
$special_code=md5(md5($date-$year+$login_user));//Code
$query_past="UPDATE `main`.`newmail` SET `newmail` = '".$_POST['newEMail']."', `code` = '".$special_code."' WHERE `newmail`.`apikey` ='".$apikeyUSER."';";
$res_past=mysql_query($query_past) or die (mysql_error());


$site_adress='seescreen.test';//Адрес сайта в письме
$header='From: '.$site_adress."\n";
$header.='Content-Type: text/html; charset="UTF-8"'."\n";
$header.="Content-Transfer-Encoding: 8bit\n";
$title ='Проверка электронного адреса';
mail($_POST['newEMail'], $title , "Чтобы подтвердить электронный адрес на сайте ".$site_adress." перейдите по этой ссылке http://".$site_adress."/settings.php?code=".$special_code."&mail=".$_POST['newEMail']." . Если вы не имеете никакого отношения к нашему сайту, просто проигнорируйте сообщение.\nС уважением, SEScreen", $header);


}
}
else
{
$errorNewMail=1;//Error password
}
}
//Change e-mail
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SEScreen | Настройки</title>
<script type="text/javascript" src="js/all.js"></script>
<?php include('blocks/top.php'); ?>
<h1>Настройки</h1>
<form method="post" action="settings.php" name="newNameForm" onsubmit="return false;" id="newNameForm">
<p style="margin:0px;"><strong>Смена имени:</strong></p>
<div id="oshFormReg" <?php if($name == 2) { echo 'style="display: block;"'; }?> >
<?php if($name == 2) { echo 'Имя успешно изменено!'; } ?></div>
<table class="registrationTable">
<tr>
<td>Имя:</td><td><input type="text" name="newName" value="<?php echo $username_user; ?>" class="input_enry_form" id="newName" /></td>
</tr> 
<tr>
<td colspan="2"><input type="submit" name="submit" value="Сменить имя" onclick="ProvName();"  /></td>
</tr>
</table>
</form><br />

<form method="post" action="settings.php" name="changePas" onsubmit="return false;" id="changePas">
<p style="margin:0px;"><strong>Смена пароля:</strong></p>
<div id="oshFormReg" <?php if($error_pass == 2 || $error_pass == 1) { echo 'style="display: block;"'; }?> >
<?php if($error_pass == 2) { echo 'Пароль успешно изменён!'; } if($error_pass == 1) { echo 'Вы ввели неверный действующий пароль!'; } ?></div>
<table class="registrationTable">
<tr>
<td>Пароль:</td><td><input type="password" name="pas" class="input_enry_form" id="pas" /></td>
</tr>
<tr>
<td>Новый пароль:</td><td><input type="password" name="pas1" class="input_enry_form" id="pas1" /></td>
</tr>
<tr>
<td>Повторите новый пароль:</td><td><input type="password" name="pas2" class="input_enry_form" id="pas2" /></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Сменить пароль" onclick="ProvPas();"  /></td>
</tr>
</table>
</form>
<br />


<form method="post" action="settings.php" name="newMail" onsubmit="return false;" id="newMail">
<p style="margin:0px;"><strong>Смена электронного адреса:</strong></p>
<div id="oshFormReg" <?php if($true_change == 2 || $true_change == 1 || $errorNewMail == 1 || $errorNewMail == 2 || $errorNewMail == 3) { echo 'style="display: block;"'; }?> >
<?php if($errorNewMail == 1) { echo 'Вы ввели неверный пароль!'; }  if($errorNewMail == 2) { echo 'Вы ввели некорректный электронный адрес!'; }  if($errorNewMail == 3) { echo 'Письмо с подтверждением выслано на указанный адрес!'; } if($true_change == 1) { echo 'Электронный адрес успешно изменён!'; } if($true_change == 2) { echo 'Ошибка! Попробуйте ещё раз.'; } ?></div>
<table class="registrationTable">
<tr>
<td>Новый e-mail:</td><td><input type="text" name="newEMail" value="<?php if(isset($_POST['newEMail'])){ echo $_POST['newEMail'];} ?>" class="input_enry_form" id="newEMail" /></td>
</tr>
<tr>
<td>Пароль для подтверждения:</td><td><input type="password" name="password" class="input_enry_form"  /></td>
</tr> 
<tr>
<td colspan="2"><input type="submit" name="submit" value="Сменить e-mail" onclick="ProvMail();"  /></td>
</tr>
</table>
</form>
 <br />
<?php include('blocks/bottom.php'); ?>