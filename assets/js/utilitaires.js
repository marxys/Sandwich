// JavaScript Document

function checkEmptyForm(var array){
	
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

function updateTips(tips){
	$( ".validateTips" )
		.text( tips )
		.addClass( "ui-state-highlight" );
		setTimeout(function() {
			$( ".validateTips" ).removeClass( "ui-state-highlight", 1500 );
		}, 500 );
}