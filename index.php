<?php

include 'lib/smarty/libs/Smarty.class.php';
include 'classes/Guestbook.php';

/*
Inicia o Smarty e define variáveis iniciais.
*/
$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'tmp';
$smarty->assign('nome', '');
$smarty->assign('email', '');
$smarty->assign('error', '');

$guestbook = new Guestbook();

/*
Determina propriedades da conexão com o banco de dados.
*/
$database = $guestbook->conectarComDatabase('localhost','root','supersenha','guestbook','users','entries');

/*
Administra os posts guardados no banco de dados e, caso haja algum, os passa via variável $postsOutput para o template Smarty.
Caso não haja posts, define $postsOutput como false, para que o template imprima a mensagem de que não há posts.
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
Decide a página principal que será vista, a de Login caso os cookies de Login não existam, ou a de Posts, caso existam.
*/
$logado = (isset($_COOKIE['username'],$_COOKIE['password'])) ? 2 : 0; // 0 = Login, 1 = Registro, 2 = Posts

/*
Administra as informações passadas pelo método GET para decidir - caso o usuário não esteja logado - entre as páginas de Login ou Registro,
ou - caso o usuário esteja logado - desconectar o usuário e apagar os cookies de Login.
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
Recebe os erros de Login e Registro através do cookie de erro e imprime uma indicação do erro ocorrido.
*/
if(isset($_COOKIE['error']) && !empty($_COOKIE['error'])) {
	$smarty->assign('error', "<div id=\"erros\" style=\"text-align:center; color: #553333;\" class=\"alert alert-error span4 offset1\"><b><span class=\"icon-ban-circle\"></span> ".$_COOKIE['error']."<b></div>");
	setcookie('error', "", time() - 1*24*60*60);
}

/*
Passa para o template Smarty qual a situação do Login do usuário e carrega o template index.tlp
*/
$smarty->assign('logado', $logado);
$smarty->display('index.tpl');

?>