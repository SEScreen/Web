<?php
if(isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['apikey']))
{
header('Location: /');
}
include('config/bd_connect.php');
include('blocks/top_bd_connect.php');
/*Проверка капчи*/
session_start();
if($_POST) {
if($_POST['capture'] != $_SESSION['capcha']) 
 { $ok_caprure=0; 
 }
 else { 
 $ok_capture=1;
 }
 
 }
else { $ok_capture=2; }
 /*Проверка капчи*/
 if($_GET)
{

if(isset($_GET['code']) and isset($_GET['mail']))
{
$_GET['code']=addslashes($_GET['code']);
$_GET['mail']=addslashes($_GET['mail']);
$query_user="SELECT * FROM `accounts` WHERE `email` LIKE '".$_GET['mail']."' AND `apikey` LIKE '".$_GET['code']."'";
$res_user=mysql_query($query_user) or die (mysql_error());
$number_user=mysql_num_rows($res_user);
if($number_user == 1)
{
while($row_user=mysql_fetch_array($res_user)) {
$id=$row_user['i'];
$username=$row_user['username'];
$password=$row_user['password'];
$regdate=$row_user['regdate'];
}
$apikey=hash('sha512',$username.$regdate.$id.$_GET['mail']);;
$query_past="UPDATE `main`.`accounts` SET `apikey` = '".$apikey."', `active` = '1' WHERE `accounts`.`i` =".$id.";";
$res_past=mysql_query($query_past) or die (mysql_error());
$query_past="insert into newmail value (null, '".$apikey."', 'nomail', 'nocode');";
$res_past=mysql_query($query_past) or die (mysql_error());
$ok_reg=1;

$_SESSION['email']=$_GET['mail'];
$_SESSION['password']=$password;
$_SESSION['apikey']=$apikey;

/*$cooc_life=time()+3600*24*30;
setcookie('email', $_GET['mail'], $cooc_life);
setcookie('password', $password, $cooc_life);
setcookie('apikey', $apikey, $cooc_life);*/
}

}


}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SEScreen | Регистрация</title>
<script type="text/javascript" src="js/registration.js"></script>
<?php include('blocks/top.php'); ?>

<?php
//Подтверждение регистрации
if($_GET)
{


}
else
{

if($_POST and $ok_capture == 1) {
/*Проверка на POST*/
/*if проверки*/
if(isset($_POST['name']) and isset($_POST['password']) and isset($_POST['password_2']) and isset($_POST['e-mail'])) {
if(!filter_var($_POST['e-mail'], FILTER_VALIDATE_EMAIL))
{$mail=0;
}
else { $mail=1; }
if(preg_match("|^[A-Za-zА-Яа-я ]+$|i", $_POST['name']))
{$name=1;
}
else { $name=0; }
if($_POST['password'] != $_POST['password_2']) { $password_c=0; } else { $password_c=1; }
$login_user=$_POST['e-mail'];
$password_user=$_POST['password'];
$name_user=$_POST['name'];
}
/*if проверки*/
if($mail == 1 and $password_c == 1  and $name == 1 ) {
$login_error=0;
$login_error_t=0;

if($number_user_t == 0) {
/*Проверяем есть ли такой логин в пользователях */
$query_user="select * from  accounts where email='".$login_user."'";
$res_user=mysql_query($query_user) or die (mysql_error());
$number_user=mysql_num_rows($res_user);
/*Проверяем есть ли такой логин в пользователях */
if($number_user == 0) {
/*Вставляем юзера в таблицу*/
$date=time();
$year=date(Y, $date);
$special_code=md5(md5($date-$year+$login_user));//Code
$password_user=md5($password_user);
$query_past="insert into accounts value (null, '".$name_user."', '".$login_user."', '".$password_user."', '".$special_code."', CURRENT_TIMESTAMP, '0');";
$res_past=mysql_query($query_past) or die (mysql_error());
$all_ok=1;
$site_adress='seescreen.test';//Адрес сайта в письме
$header='From: '.$site_adress."\n";
$header.='Content-Type: text/html; charset="UTF-8"'."\n";
$header.="Content-Transfer-Encoding: 8bit\n";
$title ='Подтверждение регистрации';
mail($login_user, $title , "Чтобы подтвердить регистрацию на сайте ".$site_adress." перейдите по этой ссылке http://".$site_adress."/registration.php?code=".$special_code."&mail=".$login_user." . Если вы не имеете никакого отношения к регистрации, просто проигнорируйте сообщение.\nС уважением, SEScreen", $header);
/*Вставляем юзера в таблицу*/
}
}
else { 
$login_error=1;
}

}
/*Проверка на POST*/
}

?>


<h1>Регистрация</h1>
<div id="oshFormReg" <?php if($ok_capture == 0 || $number_user != 0 || $_POST) { echo 'style="display: block;"'; }?> >
<?php if($ok_capture == 0) { echo 'Неправильно введён код с картинки! '; } if($number_user != 0 and $ok_capture == 1) { echo 'Такой почтовый почтовый адрес уже зарегистрирован!'; } if($ok_capture == 1 and $number_user == 0) { echo 'Регистрация прошла успешно! Подтверждение регистрации выслано вам на вашу электроную почту.'; $_POST['e-mail']=''; $_POST['name']='';} ?>
</div>
<form method="post" action="registration.php" name="registration" onsubmit="return false;" id="registrForm">
<table class="registrationTable">
<tr>
<td>Имя:</td><td><input type="text" name="name" class="input_enry_form" id="nameReg" value="<?php echo $_POST['name']; ?>" /></td><td id="errorName"></td>
</tr>
<tr>
<td>E-mail:</td><td><input type="text" name="e-mail" value="<?php echo $_POST['e-mail']; ?>" class="input_enry_form" id="mailReg" /></td><td id="errorMail"></td>
</tr>
<tr>
<td>Пароль:</td><td><input type="password" name="password" class="input_enry_form" id="passReg" /></td><td id="errorPass"></td>
</tr>
<tr>
<td>Повторите пароль:</td><td><input type="password" name="password_2" class="input_enry_form" id="passPovReg" /></td><td id="errorPassPov"></td>
</tr>

<tr><td><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">Введите код с картинки:<br/>
<img style="background: url('images/capture/bg_capture.png');" src="capture.php" width="130" height="40"/>
</span></td><td valign="top"><input type="text" name="capture" class="input_enry_form" /></td></tr>
<tr>
<td colspan="3"><input type="submit" name="submit" value="Зарегистрироваться" onclick="ProvReg();"  /></td>
</tr>
</table>
</form>
<?php

}

?>
<?php
if($ok_reg == 1)
{
?>
<h1>Регистрация</h1>
<div id="oshFormReg" style="display:block;">Спасибо за регистрацию! Вы станете нашим пользователем через <span id="timeReg">5</span></div>

<script type="text/javascript">
setInterval(timeReg, 1000);
var a=5;
function timeReg()
{
if(a==0)
{
document.location="/";
}
document.getElementById('timeReg').innerHTML=a;
a--;
}
</script>
<?php }?>
 
<?php include('blocks/bottom.php'); ?>