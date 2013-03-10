/*
Função chamada pelo formulário de Login
*/
function acessarUsuario() {
	$.ajax({
	url: "ajax.php", 
	type: "POST",
	data: {
		guestbook_username: $("input[name='guestbook_username']").val(),
		guestbook_password: $("input[name='guestbook_password']").val(),
		acao: 'acessar'
	},
	success: function(retorno) { window.location = window.location.href.split("?")[0]; }
	});
}