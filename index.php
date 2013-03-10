<?php

include 'lib/smarty/libs/Smarty.class.php';
include 'classes/Guestbook.php';

/*
Inicia o Smarty e define vari�veis iniciais.
*/
$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'tmp';
$smarty->assign('nome', '');
$smarty->assign('email', '');
$smarty->assign('error', '');

$guestbook = new Guestbook();

/*
Determina propriedades da conex�o com o banco de dados.
*/
$database = $guestbook->conectarComDatabase('localhost','root','supersenha','guestbook','users','entries');

/*
Administra os posts guardados no banco de dados e, caso haja algum, os passa via vari�vel $postsOutput para o template Smarty.
Caso n�o haja posts, define $postsOutput como false, para que o template imprima a mensagem de que n�o h� posts.
*/
if($postSelect = $database->selecionarPosts()) {
	if(isset($_COOKIE['username'],$_COOKIE['password']) && !empty($_COOKIE['username']) && !empty($_COOKIE['password'])) {
		if($posts = $guestbook->getPosts($postSelect)) {
			$postsOutput = $guestbook->imprimirPosts($posts);
			$smarty->assign('nome', $_COOKIE['username']);
			$smarty->assign('email', $_COOKIE['email']);
			$smarty->assign('posts', $postsOutput);
		} else {
			$postsOutput = false;
			$smarty->assign('nome', $_COOKIE['username']);
			$smarty->assign('email', $_COOKIE['email']);
			$smarty->assign('posts', $postsOutput);
		}
	}
}

/*
Decide a p�gina principal que ser� vista, a de Login caso os cookies de Login n�o existam, ou a de Posts, caso existam.
*/
$logado = (isset($_COOKIE['username'],$_COOKIE['password'])) ? 2 : 0; // 0 = Login, 1 = Registro, 2 = Posts

/*
Administra as informa��es passadas pelo m�todo GET para decidir - caso o usu�rio n�o esteja logado - entre as p�ginas de Login ou Registro,
ou - caso o usu�rio esteja logado - desconectar o usu�rio e apagar os cookies de Login.
*/
if(isset($_GET['action'])) {
	if($_GET['action'] == 'login') {
		$logado = 0;
	} elseif($_GET['action'] == 'signup') {
		$logado = 1;
	} elseif($_GET['action'] == 'logout') {
		setcookie('username', '', time() - 1*24*60*60);
		setcookie('password', '', time() - 1*24*60*60);
		setcookie('email', '', time() - 1*24*60*60);
		$logado = 0;
	}
}

/*
Recebe os erros de Login e Registro atrav�s do cookie de erro e imprime uma indica��o do erro ocorrido.
*/
if(isset($_COOKIE['error']) && !empty($_COOKIE['error'])) {
	$smarty->assign('error', "<div id=\"erros\" style=\"text-align:center; color: #553333;\" class=\"alert alert-error span4 offset1\"><b><span class=\"icon-ban-circle\"></span> ".$_COOKIE['error']."<b></div>");
	setcookie('error', "", time() - 1*24*60*60);
}

/*
Passa para o template Smarty qual a situa��o do Login do usu�rio e carrega o template index.tlp
*/
$smarty->assign('logado', $logado);
$smarty->display('index.tpl');

?>