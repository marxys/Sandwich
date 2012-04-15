<script> 
$(document).ready(function(){
	$("#form_login").submit(function(event){
		event.preventDefault(); // Supprime l'action par defaut du formulaire submit (rechargement de page)
		// Verification que les formulaires sont remplis
		if(checkEmptyForm(new Array('login','password'))){
			ajax_request('login='+$("#login").val()+'&password='+$("#password").val(),'index.php/users/login');
		}
		else{
			updateTips('Veuillez remplir tous les éléments de formulaire requis.','p_login');
		}
	});
	$("#button_record").click(function(event){
		//event.preventDefault();
		if(checkEmptyForm(new Array('prenom','nom','login_record','password_record','email'))){
			ajax_request('login='+$('#login_record').val()+'&password='+$('#password_record').val()+'&nom='+$('#nom').val()+'&prenom='+$('#prenom').val()+'&email='+$('#email').val()+'&type='+$("#type").val(),'index.php/users/inscription');
		}
	});
	$(function(){
		$("#button_login").button();
		$("#button_record").button();
	});
});

</script>

<div id="conteneur_form">

<div id='page_garde'>

 <div id="inscription">
    
        <p id='p_record'> Indiquez vos données utilisateur pour vous inscrire :  </p>
        
            <label for="prenom">Prénom : </label>
            <input id="prenom" type="text" name="prenom" value="" size="50" class="text ui-widget-content ui-corner-all" />
            
            <label for="nom">Nom : </label>
            <input id="nom" type="text" name="nom" value="" size="50" class="text ui-widget-content ui-corner-all" />
            
            <label for="login"> Nom d'utilisateur : </label>
            <input id="login_record" type="text" name="login" value="" size="50" class="text ui-widget-content ui-corner-all" />
        
            <label for="password" >Mot de passe</label>
            <input id="password_record" type="password" name="password" value="" size="50" class="text ui-widget-content ui-corner-all" /> 
            
            <label for="email"> Adresse e-mail : </label>
            <input id="email" type="text" name="email" value="" size="50" class="ui-widget-content ui-corner-all" size="50" />
            <select id="type" class="text ui-widget-content ui-corner-all">
                <option selected>client
                <option>etablissement
            </select>
            <br/>
            <div id="button_record">S'enregistrer</div>
  
	</div>
	<div id='login_contener'>
    	<img class="sand" src="../../assets/imgs/sandwich.png" />
        <img class="logo" src="../../assets/imgs/title.png" />
        <p id= 'p_login'> Veuillez rentrez vos information de connexion. </p>
    <form id="form_login">
        <h5>Nom d'utilisateur</h5>
        <input id="login" type="text" name="username" value="" size="50" class="text ui-widget-content ui-corner-all" />
    
        <h5>Mot de passe</h5>
        <input id="password" type="password" name="password" value="" size="50" class="text ui-widget-content ui-corner-all" /> <br/>
        <input id="button_login" type="submit" value="Connexion"/>
    </form>
    </div>
</div>

	
   
</div>
<?php // Si déjà connecté, ne pas laissé voir les formulaires.
/*
	Page d'acceuil : Contient le formulaire de login et l'acceuil par transparence en dessous.
	
*/
