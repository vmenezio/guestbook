<?php

include 'classes/Guestbook.php';

$guestbook = new Guestbook();

$database = $guestbook->conectarComDatabase('localhost','root','supersenha','guestbook','users','entries');

/*
Recebe os dados dos formulários de Login/Registro e verificar se eles são válidos, caso os cookies de Login não existam.
Se os cookies de Login existirem, administra os posts do usuário logado e os manda para o objeto 'database'
*/

if(!isset($_COOKIE['username'],$_COOKIE['password']) && isset($_POST['acao'])) {
	if($_POST['acao'] == "registrar") {
		if ($usuario = $database->registrarUsuario()) {
		} else setcookie('error', "Unable to create account", time() + 1*24*60*60);
	} elseif($_POST['acao'] == "acessar") {
		$nome = mysql_real_escape_string(htmlentities($_POST['guestbook_username']));
		$senha = mysql_real_escape_string(htmlentities($_POST['guestbook_password']));
		if ($usuario = $database->acessarUsuario($nome,$senha)) {
			setcookie('username', $nome, time() + 1*24*60*60);
			setcookie('password', $senha, time() + 1*24*60*60);
		} else setcookie('error', "Invalid login information", time() + 1*24*60*60);
	}	
} else if($usuario = $database->acessarUsuario($_COOKIE['username'],$_COOKIE['password'])) {
	if($post  = $usuario->postar()) {
		$database->inserirPost($post);
	}
}

?>