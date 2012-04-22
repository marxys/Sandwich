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
		.text( tips );
		//.addClass( "ui-state-highlight" );
		//setTimeout(function() {
			//$( ".updateTips" ).removeClass( "ui-state-highlight", 1500 );
		//}, 500 );
}


function notification(titre,message,duration){
	$.notifier.broadcast({
			ttl: titre,
			msg:message,
			duration : duration
		}
	);
}
//COMBOBOX
$(document).ready(function(){
	(function( $ ) {
			$.widget( "ui.combobox", {
				_create: function() {
					var input,
						self = this,
						select = this.element.hide(),
						selected = select.children( ":selected" ),
						value = selected.val() ? selected.text() : "",
						wrapper = $( "<span>" )
							.addClass( "ui-combobox" )
							.insertAfter( select );
	
					input = $( "<input>" )
						.appendTo( wrapper )
						.val( value )
						.addClass( "ui-state-default" )
						.autocomplete({
							delay: 0,
							minLength: 0,
							source: function( request, response ) {
								var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
								response( select.children( "option" ).map(function() {
									var text = $( this ).text();
									if ( this.value && ( !request.term || matcher.test(text) ) )
										return {
											label: text.replace(
												new RegExp(
													"(?![^&;]+;)(?!<[^<>]*)(" +
													$.ui.autocomplete.escapeRegex(request.term) +
													")(?![^<>]*>)(?![^&;]+;)", "gi"
												), "<strong>$1</strong>" ),
											value: text,
											option: this
										};
								}) );
							},
							select: function( event, ui ) {
								ui.item.option.selected = true;
								self._trigger( "selected", event, {
									item: ui.item.option
								});
							},
							change: function( event, ui ) {
								if ( !ui.item ) {
									var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
										valid = false;
									select.children( "option" ).each(function() {
										if ( $( this ).text().match( matcher ) ) {
											this.selected = valid = true;
											return false;
										}
									});
									if ( !valid ) {
										// remove invalid value, as it didn't match anything
										$( this ).val( "" );
										select.val( "" );
										input.data( "autocomplete" ).term = "";
										return false;
									}
								}
							}
						})
						.addClass( "ui-widget ui-widget-content ui-corner-left" );
	
					input.data( "autocomplete" )._renderItem = function( ul, item ) {
						return $( "<li></li>" )
							.data( "item.autocomplete", item )
							.append( "<a>" + item.label + "</a>" )
							.appendTo( ul );
					};
	
					$( "<a>" )
						.attr( "tabIndex", -1 )
						.attr( "title", "Show All Items" )
						.appendTo( wrapper )
						.button({
							icons: {
								primary: "ui-icon-triangle-1-s"
							},
							text: false
						})
						.removeClass( "ui-corner-all" )
						.addClass( "ui-corner-right ui-button-icon" )
						.click(function() {
							// close if already visible
							if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
								input.autocomplete( "close" );
								return;
							}
	
							// work around a bug (likely same cause as #5265)
							$( this ).blur();
	
							// pass empty string as value to search for, displaying all results
							input.autocomplete( "search", "" );
							input.focus();
						});
				},
	
				destroy: function() {
					this.wrapper.remove();
					this.element.show();
					$.Widget.prototype.destroy.call( this );
				}
			});
	})( jQuery );
});

// TOUT CE QUI CONCERNE LES REQUETES AJAX //

function login_success(type_user){
	$("#conteneur_form").fadeOut(3000);
	$("#apps").css("visibility","visible").fadeIn(3000);
	if(type_user == 2){
		// faire apparaitre les apps pour la sandwicherie
		$("#ajout_produit").css("visibility","visible");
		$("#ajouter_news").css("visibility","visible");
	}
	notification('Connexion','Bienvenue !');
	setTimeout(function(){
		$("#conteneur_form").remove();
	},3000);
}

function login_failed(message){
	updateTips(message,'p_login');
}
function inscription(error,message){
	updateTips(message,'p_record');
	if(error == -1)
		notification("inscription","Erreur survenue durant l'inscription");
	else{
		notification("inscription","Vous êtes désormais inscrit");
		$('#prenom').val(''); $('#nom').val(''); $('#login_record').val(''); $('#password_record').val(''); $('#email').val('');
	}

}
function ajax_request(param,url){
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
					case 1 : window[''+data['functions'][i]['name']](array_args[0]); break;
					case 2 : window[''+data['functions'][i]['name']](array_args[0],array_args[1]); break;
					case 3 : window[''+data['functions'][i]['name']](array_args[0],array_args[1],array_args[2]); break;
				}
			}
		},
		error : function(data){
			alert('Ajax error occured');
		}
	});
}