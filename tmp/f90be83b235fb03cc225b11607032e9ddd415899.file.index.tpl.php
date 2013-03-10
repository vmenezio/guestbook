<?php /* Smarty version Smarty-3.1.13, created on 2013-03-05 05:53:18
         compiled from "templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:211465132d481dba518-00401756%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f90be83b235fb03cc225b11607032e9ddd415899' => 
    array (
      0 => 'templates\\index.tpl',
      1 => 1362459195,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '211465132d481dba518-00401756',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5132d48210f462_76985020',
  'variables' => 
  array (
    'logado' => 0,
    'error' => 0,
    'posts' => 0,
    'p' => 0,
    'nome' => 0,
    'email' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5132d48210f462_76985020')) {function content_5132d48210f462_76985020($_smarty_tpl) {?><!DOCTYPE html>

<html>
	<head>
		<script src="./js/jquery-1.9.1.min.js"></script>
		<script src="./js/enviar.js"></script>
		<script src="./js/registrarUsuario.js"></script>
		<script src="./js/acessarUsuario.js"></script>
		<script src="./bootstrap/js/bootstrap.js"></script>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
		<title>Guestbook 1.0</title>
	</head>
	<body>
		<div class="navbar navbar-fixed-top navbar-inverse">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class=" icon-align-justify icon-white"></span>
					</a>
					<a href="#" class="brand">Guestbook 1.0</a>
					<div class="nav-collapse collapse">
					<b>
						<ul class="nav pull-right">
						<?php if ($_smarty_tpl->tpl_vars['logado']->value==0){?>
							<li class="active"><a href="?action=login">Login</a></li>
							<li><a href="?action=signup">Sign Up</a></li>
						<?php }elseif($_smarty_tpl->tpl_vars['logado']->value==1){?>
							<li><a href="?action=login">Login</a></li>
							<li class="active"><a href="?action=signup">Sign Up</a></li>
						<?php }else{ ?>
							<li><a href="?action=logout">Logout</a></li>
						<?php }?>
						</ul>
					</b>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row offset2">
		<?php echo $_smarty_tpl->tpl_vars['error']->value;?>

		<?php if ($_smarty_tpl->tpl_vars['logado']->value==0){?>
				<div class="btn disabled span6">
				<div class=""><h4 class="text-info">Log into your account</h4></div>
					<div class="input-prepend">
						<span class="add-on"><span class="icon-user"></span></span>
						<input type="text" name="guestbook_username" class="span5 form-search" placeholder="Username"></input>
					</div>
					<div class="input-append input-prepend">
						<span class="add-on"><span class="icon-asterisk"></span></span>
						<input type="password" name="guestbook_password" class="span4 form-search" placeholder="Password"></input>
						<button onClick="acessarUsuario(); return false;" class="btn btn-inverse"><b><span class="icon-off icon-white"></span> Sign in!</b></button>
					</div>
				</div>
				<?php }elseif($_smarty_tpl->tpl_vars['logado']->value==1){?>
				<div class="btn disabled span6">
				<div class=""><h4 class="text-info">Create a new account</h4></div>
					<div class="input-prepend">
						<span class="add-on"><span class="icon-user"></span></span>
						<input type="text" name="guestbook_username" class="span5 form-search" placeholder="Username"></input>
					</div>
					<div class="input-prepend">
						<span class="add-on"><span class="icon-envelope"></span></span>
						<input type="text" name="guestbook_email" class="span5 form-search" placeholder="Email"></input>
					</div>
					<div class="input-append input-prepend">
						<span class="add-on"><span class="icon-asterisk"></span></span>
						<input type="password" name="guestbook_password" class="span4 form-search" placeholder="Password"></input>
						<button onClick="registrarUsuario(); return false;" class="btn btn-inverse"><b><span class="icon-plus icon-white"></span> Sign up!</b></button>
					</div>
				</div>
				<?php }else{ ?>
					<form class="span6">
						<textarea id="postArea" name="guestbook_message" rows="3" class="span6" maxlength="160" style="resize: none; margin-bottom: 0;"></textarea>
						<button onClick=" enviar(); return false;" class="btn btn-inverse btn-block"><b>Enviar</b></button><br>
						<div id="posts" class="btn disabled span5" style="text-align: left"><?php if (!$_smarty_tpl->tpl_vars['posts']->value){?>No earlier posts<?php }else{ ?><?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
?><?php echo $_smarty_tpl->tpl_vars['p']->value;?>
<?php } ?><?php }?></div>
					</form>
				<?php }?>
			</div>
		</div>
		<input type="hidden" name="hidden_name" value="<?php echo $_smarty_tpl->tpl_vars['nome']->value;?>
">
		<input type="hidden" name="hidden_email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
">
	</body>
</html><?php }} ?>