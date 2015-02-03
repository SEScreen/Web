<?php
//list($url_page, $get_vars)= explode('[?]', $_SERVER['REQUEST_URI']); 
@mysql_connect($hostname,$username,$password) or die ("Connection error.");
mysql_query("SET NAMES 'utf8'");
mysql_select_db($dbName) or die (mysql_error());
$enter_user=0;
session_start();
if(isset($_GET['exit']))
{
/*setcookie('email', "");
setcookie('password', "");
setcookie('apikey', "");
$_COOKIE['email']='';*/
  unset($_SESSION['email']);
    unset($_SESSION['password']);
	  unset($_SESSION['apikey']);
session_destroy();
}
if(isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['apikey']))
{
//Check user
/*$_COOKIE['email']=addslashes($_COOKIE['email']);
$_COOKIE['password']=addslashes($_COOKIE['password']);
$_COOKIE['apikey']=addslashes($_COOKIE['apikey']);*/
$query_user="SELECT * FROM `accounts` WHERE `email` LIKE '".$_SESSION['email']."' AND `apikey` LIKE '".$_SESSION['apikey']."'  AND `password` LIKE '".$_SESSION['password']."'";
$res_user=mysql_query($query_user) or die (mysql_error());
$number_user=mysql_num_rows($res_user);
if($number_user == 1)
{
$enter_user=1;
$passwordUSER=$_SESSION['password'];
$emailUSER=$_SESSION['email'];
$apikeyUSER=$_SESSION['apikey'];
while($row_user=mysql_fetch_array($res_user)) {
$id_user=$row_user['i'];
$username_user=$row_user['username'];
}

$query_files="SELECT * FROM `uploads` WHERE `apikey` LIKE '".$_SESSION['apikey']."'";
$res_files=mysql_query($query_files) or die (mysql_error());
$num_files=0;
$size_files=0;
while($row_files=mysql_fetch_array($res_files)) {
$size_files=$size_files+$row_files['size'];
$num_files++;
}
}
else {
unset($_SESSION['email']);
    unset($_SESSION['password']);
	  unset($_SESSION['apikey']);
session_destroy();
}
//Check user
}
/*else if(isset($_COOKIE['email']) || isset($_COOKIE['password']) || isset($_COOKIE['apikey']))
{
setcookie('email', "");
setcookie('password', "");
setcookie('apikey', "");
}*/
?>