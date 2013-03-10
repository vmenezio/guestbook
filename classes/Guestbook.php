<?php

include 'Database.php';

/*
Classe que lida com as operações do guestbook em si:
conectar com a database para receber posts e então imprimi-los.
*/
class Guestbook {
	
	public function conectarComDatabase($host, $login, $senha, $banco, $tabelaDeUsuarios, $tabelaDeComentarios) {
			return new Database($host, $login, $senha, $banco, $tabelaDeUsuarios, $tabelaDeComentarios);
	}
	
	public function getPosts($postSelect) {
		if(mysql_num_rows($postSelect)!=0) {
			$postIndex = 0;
			while($linha = mysql_fetch_assoc($postSelect)) {
				$timestamp = date('d/m/y [h:i]',$linha['timestamp']);
				$nome = $linha['name'];
				$email = $linha['email'];
				$mensagem = $linha['message'];
				$posts[$postIndex] = '<div class="post"><span class="nome label label-inverse pull-left">'.$nome.'</span><span class="email" style="color:#000000; text-transform:uppercase; text-shadow: 0px 1px #FFFFFF; font-size: xx-small;">&nbsp;('.$email.')</span> said, on <span class="timestamp">'.$timestamp.'</span>:<br><span class="mensagem"> '.$mensagem.'</span></div><hr>';
				$postIndex++;
			}
			if(isset($posts) && !empty($posts))
				return $posts;
			else
				return false;
		}
	}
	
	public function imprimirPosts($posts) {
		$index = 0;
		foreach($posts as $post) {
			$postsOutput[$index] = $post;
			$index++;
		}
		return $postsOutput;
	}
	
}

?>