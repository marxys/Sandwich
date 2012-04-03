<script> 
$(document).ready(function(){
	$("#form_login").submit(function(event){
		event.preventDefault(); // Supprime l'action par defaut du formulaire submit (rechargement de page)
		// Verification que les formulaires sont remplis
		if(checkEmptyForm(new Array('login','password'))){
			$.ajax({
				type: 'POST',
				url :'../controller/ajax/ajax_request/',
				data :'p=connexion&login='+$("#login").val()+'&password='+$("#password").val(),
				dataType: 'json',
				success : function(data){
					$("#conteneur_form").fadeIn('slow');
					notification('Connexion','Bienvenue !');
					setTimeout(function(){
						$("#conteneur_form").remove();
					},'400');
				},
				error : function(data){
					alert('Ajax error occured');
				}
			});
		}
		else{
			updateTips('Veuillez remplir tous les éléments de formulaire requis.');
		}
	});
	$(function(){
		$("#button").button();
	});
});

</script>

<div id="conteneur_form">
	<p class="updateTips"> Veuillez rentrez vos information de connexion. </p>
	<form id="form_login" method="post">
	<h5>Nom d'utilisateur</h5>
	<input id="login" type="text" name="username" value="" size="50" class="text ui-widget-content ui-corner-all" />

	<h5>Mot de passe</h5>
	<input id="password" type="password" name="password" value="" size="50" class="text ui-widget-content ui-corner-all" /> <br/>
    <input id="button" type="submit" value="Connexion"/>
    </form>
  
</div>
<?php // Si déjà connecté, ne pas laissé voir les formulaires.
/*
	Page d'acceuil : Contient le formulaire de login et l'acceuil par transparence en dessous.
	
*/
