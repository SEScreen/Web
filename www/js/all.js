// JavaScript Document

function ProvPas() {
var pas1=document.getElementById('pas1').value;	
var pas2=document.getElementById('pas2').value;	
if(pas1 == pas2)
{
	document.getElementById('changePas').onsubmit='return true;';
}
else
{
alert('Ваши пароли не совпадают!');	
}
}

function ProvMail()
{
email=document.getElementById('newEMail').value;
if (/^([a-zA-Z0-9-_]+)\w*[@]([a-z]+)[.]([a-z]{2,4})$/.test(email)) {
	//OK
	document.getElementById('newMail').onsubmit='return true;';
}
else {
	alert('Введите корректный e-mail!');
}	
}

function ProvName()
{
imya=document.getElementById('newName').value;
if (imya == '') {
alert('Введите имя!');
}
else {
	if (/[!@#$%\^&*()=\/'№?:;\[\]\}\{0-9+]/.test(imya)) {
	alert('Введите корректное имя!');
	}
	else {
		document.getElementById('newNameForm').onsubmit='return true;';
	}
}
}