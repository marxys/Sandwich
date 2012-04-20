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
<?php 
if($this->session->userdata('type') == 0){ ?>
    <div id="conteneur_form">
    	<script> 		$(document).ready(function(){
$("#apps").css('visibility','hidden').fadeOut('fast');}); </script>
        <div id='page_garde'>
        
            <div id="inscription">
            
                <p id='p_record'> Indiquez vos données utilisateur pour vous inscrire :  </p>
                
                <label for="prenom">Prénom : </label>
                <input id="prenom" type="text" name="prenom" value="" size="50" class="text ui-widget-content ui-corner-all" />
                <br />
                <label for="nom">Nom : </label>
                <input id="nom" type="text" name="nom" value="" size="50" class="text ui-widget-content ui-corner-all" />
                <br />
                <label for="login"> Nom d'utilisateur : </label>
                <input id="login_record" type="text" name="login" value="" size="50" class="text ui-widget-content ui-corner-all" />
            	<br />
                <label for="password" >Mot de passe : </label>
                <input id="password_record" type="password" name="password" value="" size="50" class="text ui-widget-content ui-corner-all" /> 
                <br />
                <label for="email"> Adresse e-mail : </label>
                <input id="email" type="text" name="email" value="" size="50" class="ui-widget-content ui-corner-all"/>

                <br />
                <label for="type"> Type d'utilisation : </label>
                <select id="type" class="text ui-widget-content ui-corner-all">
                    <option selected>client</option>
                    <option>etablissement</option>
                </select>
                
                <br />
                <div id="button_record">S'enregistrer</div>
        
            </div>
        
        <div id='login_contener'>
     
            <img class="sand" src="../../assets/imgs/sandwich.png" />
            <img class="logo" src="../../assets/imgs/title.png" />
           
        <form id="form_login">
        	 <p id= 'p_login'> Veuillez rentrez vos information de connexion. </p>
             <table>
             
  				<tr>
    				<td><input id="login" type="text" name="username" value="login" size="50" class="text ui-widget-content ui-corner-all" /></td>
    				<td rowspan="2"><input id="button_login" type="submit" value="Connexion"/></td>
  				</tr>
  				<tr>
    				<td><input id="password" type="password" name="password" value="password" size="50" class="text ui-widget-content ui-corner-all" /></td>
  				</tr>
			</table>

        </form>
        </div>  
    </div>
</div>
<?php 
} // div affiché uniquement quand l'utilisateur n'est pas connecté?>

<div id="apps">
	<div id="profil"><a href="index.php/users/view_profil">Profil</a></div>
    <div id="visite_sandwicherie">Voir les differentes sandwicheries</div>
    <div id="news">News</div> <!-- peut etre pas necessaire -->
    <div id="mes_commandes">Mes commandes</div> <!-- peut etre pas necessaire -->
    <div id="ajout_produit">Ajouter un produit</div> <!-- caché par défaut -->
    <div id="ajouter_news">Ajourter une news</div> <!-- caché par défaut -->
</div>
