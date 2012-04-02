<script> 
$(document).ready(function(){
	$("#form_login").submit(function(event){
		event.preventDefault(); // Supprime l'action par defaut du formulaire submit (rechargement de page)
		// Verification que les formulaires sont remplis
		if(checkEmptyForm(new array('user','pwd'))){
			$.ajax({
				type: POST,
				url :'../controller/ajax/ajax_request/',
				data :'p=connexion&login='+$("#login").val()+'&password='+$("#password").val(),
				dataType: 'json',
				success : function(data){
					
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
});
</script>

<div id="conteneur_form">
	<p class="updateTips"> Veuillez rentrez vos information de connexion. </p>
	<form id="form_login" method="post">
	<h5>Nom d'utilisateur</h5>
	<input id="login" type="text" name="username" value="" size="50" />

	<h5>Mot de passe</h5>
	<input id="password" type="password" name="password" value="" size="50" /> <br/>
    <input type="submit" value="Connexion"/>
    </form>
  
</div>
<?php
/*
	Page d'acceuil : Contient le formulaire de login et l'acceuil par transparence en dessous.
	
*/
