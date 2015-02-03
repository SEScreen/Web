// JavaScript Document
/*Код проверки регистрации*/
function ProvReg() {
imya=document.getElementById('nameReg').value;
if (imya == '') {
document.getElementById('errorName').innerHTML='<img src="images/galNot.png" width="25" height="20" alt="Введите ваше имя"/>';
oshName='ваше имя; ';
}
else {
	if (/[!@#$%\^&*()=\/'№?:;\[\]\}\{0-9+]/.test(imya)) {
	document.getElementById('errorName').innerHTML='<img src="images/galNot.png" width="25" height="20" alt="Введите правильно ваше имя"/>';
oshName='ваше имя; ';
	}
	else {
		document.getElementById('errorName').innerHTML='<img src="images/galOk.png" width="25" height="20" alt="Имя введено правильно"/>';
oshName='';
	}
}
email=document.getElementById('mailReg').value;
if (/^([a-zA-Z0-9-_]+)\w*[@]([a-z]+)[.]([a-z]{2,4})$/.test(email)) {document.getElementById('errorMail').innerHTML='<img src="images/galOk.png" width="25" height="20"/>';
oshMail='';
}
else {document.getElementById('errorMail').innerHTML='<img src="images/galNot.png" width="25" height="20" alt="Укажите правильно ваш e-mail"/>';
oshMail='ваш e-mail; ';
}
password=document.getElementById('passReg').value;
if (password == '') { document.getElementById('errorPass').innerHTML='<img src="images/galNot.png" width="25" height="20" alt="Укажите правильно ваш пароль"/>';
oshPass='ваш пароль; ';
}
else { document.getElementById('errorPass').innerHTML='<img src="images/galOk.png" width="25" height="20"/>';
oshPass='';
}
passwordPovt=document.getElementById('passPovReg').value;
if (passwordPovt == '') {document.getElementById('errorPassPov').innerHTML='<img src="images/galNot.png" width="25" height="20" alt="Поле долдно быть заполнено"/>';
if (password != '') {document.getElementById('errorPassPov').innerHTML='<img src="images/galNot.png" width="25" height="20" alt="Пароли не совпадают"/>';
oshPassPov=' Ваши пароли не совпадают.';
}else {oshPassPov='';}
}
else {
if (password == passwordPovt) {document.getElementById('errorPassPov').innerHTML='<img src="images/galOk.png" width="25" height="20"/>';
oshPassPov='';
}
else {document.getElementById('errorPassPov').innerHTML='<img src="images/galNot.png" width="25" height="20" alt="Пароли не совпадают"/>';
oshPassPov=' ваш пароль и повторите его.';
}
}
if(oshName == '' && oshMail == '' && oshPass == '' && oshPassPov == '' ) {document.getElementById('oshFormReg').style.display='none';
document.getElementById('registrForm').onsubmit='return true;';
}
else {
document.getElementById('oshFormReg').style.display='block';
document.getElementById('oshFormReg').innerHTML='Введите правильно данные из формы! В том числе: ' + oshName + oshMail + oshPass + oshPassPov;
}
}
/*Код проверки регистрации*/