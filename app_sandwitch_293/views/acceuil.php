<script> 
$(document).ready(function(){
	$("#form_login").submit(function(event){
		event.preventDefault(); // Supprime l'action par defaut du formulaire submit (rechargement de page)
		// Verification que les formulaires sont remplis
		if(checkEmptyForm(new Array('login','password'))){
			var login_success = 'login_success';
			ajax_request(login_success,'login='+$("#login").val()+'&password='+$("#password").val(),'index.php/users/login');
		}
		else{
			updateTips('Veuillez remplir tous les éléments de formulaire requis.','p_login');
		}
	});
	$(function(){
		$(".button").button();
	});
});

</script>

<div id="conteneur_form">
	<p id= 'p_login'> Veuillez rentrez vos information de connexion. </p>
	<form id="form_login" method="post">
        <h5>Nom d'utilisateur</h5>
        <input id="login" type="text" name="username" value="" size="50" class="text ui-widget-content ui-corner-all" />
    
        <h5>Mot de passe</h5>
        <input id="password" type="password" name="password" value="" size="50" class="text ui-widget-content ui-corner-all" /> <br/>
        <input id="button_login" class='button' type="submit" value="Connexion"/>
    </form>
    <div id="inscription">
    
	<p id='p_record'> Indiquez vos données utilisateur pour vous inscrire :  </p>
	<form id="form_record" method="post">
    
        <label for="prenom">Prénom : </label>
        <input id="prenom" type="text" name="prenom" value="" size="50" class="text ui-widget-content ui-corner-all" />
        
        <label for="nom">Nom : </label>
        <input id="nom" type="text" name="nom" value="" size="50" class="text ui-widget-content ui-corner-all" />
        
        <label for="login"> Nom d'utilisateur : </label>
        <input id="login" type="text" name="login" value="" size="50" class="text ui-widget-content ui-corner-all" />
    
        <label for="password" >Mot de passe</label>
        <input id="password" type="password" name="password" value="" size="50" class="text ui-widget-content ui-corner-all" /> 
        
        <label for="email"> Adresse e-mail : </label>
        <input id="email" type="text" name="email" value="" size="50" class="text ui-widget-content ui-corner-all" />
        
        <br/>
        <input id="button_record" class='button' type="submit" value="S'enregistrer"/>
    </form>
  
</div>
  
</div>
<?php // Si déjà connecté, ne pas laissé voir les formulaires.
/*
	Page d'acceuil : Contient le formulaire de login et l'acceuil par transparence en dessous.
	
*/
