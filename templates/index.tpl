<!DOCTYPE html>

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
						{if $logado == 0}
							<li class="active"><a href="?action=login">Login</a></li>
							<li><a href="?action=signup">Sign Up</a></li>
						{elseif $logado == 1}
							<li><a href="?action=login">Login</a></li>
							<li class="active"><a href="?action=signup">Sign Up</a></li>
						{else}
							<li><a href="?action=logout">Logout</a></li>
						{/if}
						</ul>
					</b>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row offset2">
		{$error}
		{if $logado == 0}
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
				{elseif $logado == 1}
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
				{else}
					<form class="span6">
						<textarea id="postArea" name="guestbook_message" rows="3" class="span6" maxlength="160" style="resize: none; margin-bottom: 0;"></textarea>
						<button onClick=" enviar(); return false;" class="btn btn-inverse btn-block"><b>Enviar</b></button><br>
						<div id="posts" class="btn disabled span5" style="text-align: left">{if !$posts}No earlier posts{else}{foreach from=$posts item=p}{$p}{/foreach}{/if}</div>
					</form>
				{/if}
			</div>
		</div>
		<input type="hidden" name="hidden_name" value="{$nome}">
		<input type="hidden" name="hidden_email" value="{$email}">
	</body>
</html>