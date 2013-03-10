/*
Função chamada pelo envio de posts ao Guestbook
*/
function enviar() {
	$.ajax({
	url: "ajax.php", 
	type: "POST",
	data: {
		guestbook_message: $("textarea[name='guestbook_message']").val(),
	},
	success: function(retorno) { 
		if($("textarea[name='guestbook_message']").val() != '') {
			$('#posts').prepend("<div class=\"post\"><span class=\"nome label label-inverse pull-left\">"+$("input[name='hidden_name']").val()
			+"</span><span class=\"email\" style=\"color:#000000; text-transform:uppercase; text-shadow: 0px 1px #FFFFFF; font-size: xx-small;\">&nbsp;("+
			$("input[name='hidden_email']").val()+")</span> said, <span class=\"timestamp\">now</span>:<br><span class=\"mensagem\"> "+$("textarea[name='guestbook_message']").val()+"</span></div><hr>");
			document.getElementById('postArea').value='';
		}
	}
	});
}