<?php

class Post {

/*
Classe que reúne e retorna
os atributos de um post
*/
	private $conteudo;
	private $timestamp;
	private $postador;
	
	public function Post($conteudo,$postador) {
		$this->conteudo = $conteudo;
		$this->postador = $postador;
	}
	
	public function setTimestamp($timestamp) {
		$this->timestamp = $timestamp;
	}
	
	public function getTimestamp() {
		return $this->timestamp;
	}
	
	public function getConteudo() {
		return $this->conteudo;
	}
	
	public function getPostador() {
		return $this->postador;
	}

}

?>