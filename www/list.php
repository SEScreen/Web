<?php
require('blocks/geturl.php');
include('config/bd_connect.php');
@mysql_connect($hostname,$username,$password) or die ("Connection error.");
mysql_query("SET NAMES 'utf8'");
mysql_select_db($dbName) or die (mysql_error());
?>
<html>
<body>
<?php
if(isset($_COOKIE['email']) && isset($_COOKIE['password']) && isset($_COOKIE['apikey']))
{
$page= @$_GET['page'] ?: 0;

$count= @$_GET['count'] ?: 10;
$count=$count<=50?$count:50;
$page=abs($page);
$count=abs($count);
$q=mysql_query("SELECT * FROM uploads WHERE apikey = '{$_COOKIE['apikey']}' LIMIT ".($page*$count).",".($page*$count+$count)) or die (mysql_error());
while($row=mysql_fetch_array($q)) {
  $fn=$row['i'].$row['ext'];
  echo "<h3>Uploaded: {$row['time']}</h3><img src='/i/$fn' width ='100'/><br><h4>Viewed: {$row['views']}<br>Size: {$row['size']}</h4><a href='/api/delete?apikey={$_COOKIE['apikey']}&file=$fn'>del</a><br>";
}
echo "<a href='list.php?page=$page&count=10'>10</a>&nbsp;<a href='list.php?page=$page&count=25'>25</a>&nbsp;<a href='list.php?page=$page&count=50'>50</a><br>";
if($page>0)
  echo "<a href='list.php?page=".($page-1)."&count=$count'>prev</a>";
echo "&nbsp;<a href='list.php?page=".($page+1)."&count=$count'>next</a>";
}
?>
</body>
</html>