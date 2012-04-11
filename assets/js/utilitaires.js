// JavaScript Document

function checkEmptyForm(array){
	
	for (i in array){
		$("#"+array[i]).removeClass("ui-state-error");	
		if($("#"+array[i]).val() == ""){
			$("#"+array[i]).addClass("ui-state-error");
			updateTips("Le champ "+$("#"+array[i]).attr("name")+" ne doit pas etre vide");
			return false;
		}
	}
	return true;
}

function updateTips(tips,id){
	$( "#"+id )
		.text( tips )
		.addClass( "ui-state-highlight" );
		setTimeout(function() {
			$( ".updateTips" ).removeClass( "ui-state-highlight", 1500 );
		}, 500 );
}


function notification(titre,message,duration){
	$.notifier.broadcast({
			ttl: titre,
			msg:message,
			duration : duration
		}
	);
}
function login_success(){
	$("#conteneur_form").fadeIn('slow');
	notification('Connexion','Bienvenue !');
	setTimeout(function(){
		$("#conteneur_form").remove();
	},'400');
}

function ajax_request(func_success,param,url){
	$.ajax({
		type: 'POST',
		url :url,
		data :param,
		dataType: 'json',
		success : function(data){
			window[''+data['function']]();
		},
		error : function(data){
			alert('Ajax error occured');
		}
	});
}