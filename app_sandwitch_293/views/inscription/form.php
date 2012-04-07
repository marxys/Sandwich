
<div id="inscription">
	<p class="updateTips"> Indiquez vos données utilisateur pour vous inscrire :  </p>
	<form id="form_login" method="post" action="index.php/users/inscription/">
    
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
    <input id="button" type="submit" value="Connexion"/>
    </form>
  
</div>
<?php // Si déjà connecté, ne pas laissé voir les formulaires.
/*
	Page d'acceuil : Contient le formulaire de login et l'acceuil par transparence en dessous.
	
*/
