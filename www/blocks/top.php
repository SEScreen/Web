<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/all.css" />
<style type="text/css">
<!--
.style1 {color: #CC33FF}
-->
</style>
    
<script type="text/javascript" src="js/photoPlugin/jquery.js"></script>
<script type="text/javascript" src="js/photoPlugin/jquery.shadow.js"></script>
<script type="text/javascript" src="js/photoPlugin/jquery.ifixpng.js"></script>
<script type="text/javascript" src="js/photoPlugin/jquery.fancyzoom.js"></script>
<script type="text/javascript">
$(function() {
	//Set the default directory to find the images needed
	//by the plugin (closebtn.png, blank.gif, loading images ....)
	$.fn.fancyzoom.defaultsOptions.imgDir='images/ressources/'; //very important must finish with a /

	// Select all links in object with gallery ID using the defaults options
	$('#gallery a').fancyzoom(); 

	// Select all links with tozoom class, set the open animation time to 1000
	$('a.tozoom').fancyzoom({Speed:1000});

	// Select all links set the overlay opacity to 80%
	$('a').fancyzoom({overlay:0.8});
	
	//new rev > 1.2
	//apply fancyzoom effect on all image whose class is fancyzoom !!
	$('img.fancyzoom').fancyzoom();


});
</script>
</head>

<body>
<table class="body_table" border="1"  align="center">
<tr>
<td class="body_table_logo">
<a href="/"><span class="logo"><span class="style1">SEScreen.</span> Ваши скриншоты - наше дело!</span></a></td>
<td class="body_table_log">
<?php if($enter_user == 0) { ?>
<form method="post" action="entry.php" name="entry">
E-mail: &nbsp;<input type="text" name="email" class="input_enry_form" style="margin-left: 6px;" />
<div style="height: 5px;"></div>
Пароль: <input type="password" name="password" class="input_enry_form" /><br />
<input type="submit" name="submit" value="Войти" style=" width: 57px;" /> <a href="new_password.php" style="font-size: 14px; margin-left: 55px;">Забыли пароль</a>
</form>
<?php }
else {
?>

<a href="list.php?id=<?php echo $id_user; ?>"><?php echo $username_user; ?></a><br/>
Загружено файлов: <?php echo $num_files; ?><br>
Свободно <?php echo number_format(($memoryUSER*1024*1024-$size_files)/(1024*1024),2); ?> из 50 Мбайт<br>
<a href="settings.php">Настройки</a> <a href="?exit">Выход</a>


<?php
}
?>
<!--<a href="#"><strong>Василий Пупкин</strong></a><br />
Скриншотов: 54<br />
Осталос Мб: 20 из 50-->
</td>
</tr>
<tr>
<td colspan="2" class="body_table_main">