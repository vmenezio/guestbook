/*
Função chamada pelo formulário de registro
*/
function registrarUsuario() {
	$.ajax({
	url: "ajax.php", 
	type: "POST",
	data: {
		guestbook_username: $("input[name='guestbook_username']").val(),
		guestbook_email: $("input[name='guestbook_email']").val(),
		guestbook_password: $("input[name='guestbook_password']").val(),
		acao: 'registrar'
	},
	success: function(retorno) { window.location = window.location.href.split("?")[0]; }
	});
}