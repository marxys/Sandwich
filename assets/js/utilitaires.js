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


// TOUT CE QUI CONCERNE LES REQUETES AJAX //

function login_success(){
	$("#conteneur_form").fadeIn('slow');
	notification('Connexion','Bienvenue !');
	setTimeout(function(){
		$("#conteneur_form").remove();
	},'400');
}

function login_failed(){
	updateTips('Login ou mot de passe incorrect','p_login');
}
function ajax_request(func_success,param,url){
	$.ajax({
		type: 'POST',
		url :url,
		data :param,
		dataType: 'json',
		success : function(data){
			var array_args = new Array();
			var array = data['functions'];
			for (var i = 0; i < array.length; i++){
				array_args = data['functions'][i]['args'];
				switch(array_args.length){
					case 0 : window[''+data['functions'][i]['name']](); break;
					case 1 : window[''+detail['name']](array_args[0]); break;
					case 2 : window[''+detail['name']](array_args[0],array_args[1]); break;
					case 3 : window[''+detail['name']](array_args[0],array_args[1],array_args[2]); break;
				}
			}
		},
		error : function(data){
			alert('Ajax error occured '+location.href);
		}
	});
}