

<?php if($type > 0){ ?>
		<div id="explications">
		<p>Vous pouvez ici modifier vos informations utilisateur</p>
		</div>
        <div id="info_user">
        	<form method="post" action="/index.php/users/edit_profil">
                 <label for="prenom">Prénom : </label>
                <input id="prenom" type="text" name="prenom" value="<?php echo $user['prenom']?>" size="50" class="text ui-widget-content ui-corner-all" /><br/>
                <label for="nom">Nom : </label>
                <input id="nom" type="text" name="nom" value="<?php echo $user['nom']?>" size="50" class="text ui-widget-content ui-corner-all" />
                <br />
                <label for="login"> Nom d'utilisateur : </label>
                <input id="login_record" type="text" name="login" value="<?php echo $user['login']?>" size="50" class="text ui-widget-content ui-corner-all" /><br/>
                <label for="email"> Adresse e-mail : </label>
                <input id="email" type="text" name="email" value=<?php echo $user['email']?> size="50" class="ui-widget-content ui-corner-all"/><br/>
                <?php if($type == 2){ ?>
                <label for="etablissement_nom">Nom de l'établissement: </label>
                <input id="etablissement_nom" type="text" name="etablissement_nom" value="<?php echo $etablissement['nom'];?>"size="50" class="text ui-widget-content ui-corner-all" /><br/>
                 <label for="slogan">Slogan : </label>
                <input id="slogan" type="text" name="slogan" value="<?php echo $etablissement['slogan'];?>" size="50" class="text ui-widget-content ui-corner-all" /><br/>
                <label for="adresse">Adresse de l'établissement : </label>
                <input id="adresse" type="text" name="adresse" value="<?php echo $etablissement['adresse'];?>" size="50" class="text ui-widget-content ui-corner-all" /><br/>
                <label for="gps">Coordonnées GPS: </label>
                <input id="gps" type="text" name="gps" value="<?php echo $etablissement['gps'];?>" size="50" class="text ui-widget-content ui-corner-all" /><br/>
                <?php } ?>
                <input type="submit" value="Envoyer" class="bouton"/>
            </form>
        </div>    
        <div id="edit_mdp">
        	<p>Vous pouvez ici modifier votre mot de passe </p>
        	<form method="post" action="/index.php/users/edit_password">
            	<label for="ancien_mdp"> Ancien mot de passe </label>
            	<input id="ancien_mdp" type="password" name="ancien_mdp"class="text ui-widget-content ui-corner-all"/><br/>
                <label for="nouveau_mdp"> Nouveau mot de passe </label>
                <input id="nouveau_mdp" type="password" name="nouveau_mdp" class="text ui-widget-content ui-corner-all" /><br/>
                <label for="confirmer_mdp"> Confirmer mot de passe </label>
                <input id="confirmer_mdp" type="password" name="confirmer_mdp" class="text ui-widget-content ui-corner-all"/><br/><br/>
                <input type="submit" value="Envoyer" class="bouton"/>
            </form>
        </div>
        <a href="/index.php"class="bouton">Retour</a>
<?php }?>

<script> 
$(document).ready(function(){
	$(":submit").button();
	$("a").button();
});
</script>