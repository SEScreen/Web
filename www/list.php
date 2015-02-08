<?php
include('config/bd_connect.php');
include('blocks/top_bd_connect.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SEScreen</title>
<?php include('blocks/top.php'); 
if(isset($_SESSION['apikey']))
{
$page= @$_GET['page'] ?: 0;

$count= @$_GET['count'] ?: 10;
$count=$count<=50?$count:50;
$page=abs($page);
$count=abs($count);
$q=mysql_query("SELECT * FROM uploads WHERE apikey = '{$_SESSION['apikey']}' LIMIT ".($page*$count).",".($page*$count+$count)) or die (mysql_error());
while($row=mysql_fetch_array($q)) {
  $fn=$row['i'].$row['ext'];
  echo "<div class='show_screen'><h3>Uploaded: {$row['time']}</h3><a href='/i/$fn'><img src='/s/$fn' ></a><br><h4>Viewed: {$row['views']}<br>Size: {$row['size']}</h4><a href='/api/delete?apikey={$_SESSION['apikey']}&file=$fn'>del</a></div>";
}
echo "<a href='list.php?page=$page&count=10'>10</a>&nbsp;<a href='list.php?page=$page&count=25'>25</a>&nbsp;<a href='list.php?page=$page&count=50'>50</a></div>";
if($page>0)
  echo "<a href='list.php?page=".($page-1)."&count=$count'>prev</a>";
echo "&nbsp;<a href='list.php?page=".($page+1)."&count=$count'>next</a>";
}
?>
<?php include('blocks/bottom.php'); ?>