<?php

include 'Usuario.php';

/*
Classe que administra as operações do banco de dados:
registrar/acessar usuários e inserir/selecionar posts
*/
class Database{

	private $tabelaDeUsuarios;
	private $tabelaDeComentarios;

	public function Database($host, $login, $senha, $banco, $tabelaDeUsuarios, $tabelaDeComentarios) {
		@mysql_connect($host,$login,$senha);
		mysql_select_db($banco);
		$this->tabelaDeUsuarios = $tabelaDeUsuarios;
		$this->tabelaDeComentarios = $tabelaDeComentarios;
	}

	public function registrarUsuario() {
		if(isset($_POST['guestbook_username'],$_POST['guestbook_email'],$_POST['guestbook_password']) && 
		!empty($_POST['guestbook_username']) && !empty($_POST['guestbook_email']) && !empty($_POST['guestbook_password'])) {
			$nome = mysql_real_escape_string(htmlentities($_POST['guestbook_username']));
			$email = mysql_real_escape_string(htmlentities($_POST['guestbook_email']));
			$senha = mysql_real_escape_string(htmlentities($_POST['guestbook_password']));
			$exists = "SELECT * FROM ".$this->tabelaDeUsuarios." WHERE username = '$nome'";
			if(mysql_num_rows(mysql_query($exists)) == 0) {
				$insert = "INSERT INTO ".$this->tabelaDeUsuarios." (username,email,password) VALUES ('$nome','$email','$senha')";
				if (mysql_query($insert)) {
					setcookie('username', $nome, time() + 1*24*60*60);
					setcookie('password', $senha, time() + 1*24*60*60);
					setcookie('email', $email, time() + 1*24*60*60);
					return new Usuario($nome, $email);
				} 
			} else {
				return false;
			}
		}
			return false;
	}
	
	public function acessarUsuario($nome, $senha) {
		$exists = "SELECT * FROM ".$this->tabelaDeUsuarios." WHERE (username,password) = ('$nome','$senha')";
		if(mysql_num_rows(mysql_query($exists)) != 0) {
			$linha = mysql_fetch_assoc(mysql_query($exists));
			setcookie('email', $linha['email'], time() + 1*24*60*60);
			return new Usuario($nome, $linha['email']);
			
		} else {
			return false;
		}
	}
	
	public function inserirPost($post) {
		$timestamp = time();
		$nomePostador = $post->getPostador()->getNome();
		$emailPostador = $post->getPostador()->getEmail();
		$conteudo = $post->getConteudo();
		$insert = "INSERT INTO ".$this->tabelaDeComentarios." (timestamp,name,email,message) VALUES ('$timestamp','$nomePostador','$emailPostador','$conteudo')";
		mysql_query($insert);
		
	}
	
	public function selecionarPosts() {
		return mysql_query('SELECT * FROM '.$this->tabelaDeComentarios.' ORDER BY timestamp DESC');
	}
}

?>