<?php

include 'Post.php';

/*
Classe que reúne os atributos do usuário atual e instancia
um objeto post a partir do método POST emitido em ajax
*/
class Usuario {

	private $nome;
	private $email;
	private $foto;

	public function Usuario($nome, $email) {
		$this->nome = $nome;
		$this->email = $email;
	}
	
	public function postar() {
		if(isset($_POST['guestbook_message']) && !empty($_POST['guestbook_message'])) {
			$conteudo = mysql_real_escape_string(htmlentities($_POST['guestbook_message']));
			return new Post($conteudo,$this);
		} else {
			return false;
		}
	}
	
	public function getNome() {
		return $this->nome;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
}
	
?>