

<?php if($type > 0){ ?>
		<div id="explications">
		<p>Vous pouvez ici modifier vos informations utilisateur</p>>
		</div>
        <div id="info_user">
        	<form method="post" action="index.php/users/edit_profil">
                 <label for="prenom">Prénom : </label>
                <input id="prenom" type="text" name="prenom" value=<?php echo $user['prenom']?> size="50" class="text ui-widget-content ui-corner-all" />
                <br />
                <label for="nom">Nom : </label>
                <input id="nom" type="text" name="nom" value=<?php echo $user['nom']?> size="50" class="text ui-widget-content ui-corner-all" />
                <br />
                <label for="login"> Nom d'utilisateur : </label>
                <input id="login_record" type="text" name="login" value=<?php echo $user['username']?> size="50" class="text ui-widget-content ui-corner-all" />
                <label for="email"> Adresse e-mail : </label>
                <input id="email" type="text" name="email" value=<?php echo $user['email']?> size="50" class="ui-widget-content ui-corner-all"/>
                <?php if($type == 2){ ?>
                    <label for="etablissement">Nom de l'établissement: </label>
                    <input id="etablissement_nom" type="text" name="etablissement_nom" value=<?php echo $etablissement['nom']?> size="50" class="text ui-widget-content ui-corner-all" />
                    <label for="prenom">Slogan : </label>
                <input id="slogan" type="text" name="slogan" value=<?php echo $etablissement['slogan']?> size="50" class="text ui-widget-content ui-corner-all" />
                <label for="addresse">Adresse de l'établissement : </label>
                <input id="addresse" type="text" name="addresse" value=<?php $etablissement['addresse']?> size="50" class="text ui-widget-content ui-corner-all" />
                <label for="addresse">Coordonnées GPS: </label>
                <input id="gps" type="text" name="coordonnées gps" value=<?php $etablissement['gps']?> size="50" class="text ui-widget-content ui-corner-all" />
                <?php } ?>
                <input type="submit" value="Envoyer"/>
            </form>
        </div>    
        <div id="edit_mdp">
        	<form method="post" action="index.php/users/edit_password">
            	<label for="ancien_mdp"> Ancien mot de passe </label>
            	<input id="ancien_mdp" type="password" name="ancien_mdp"/>
                <label for="nouveau_mdp"> Nouveau mot de passe </label>
                <input id="nouveau_mdp" type="password" name="nouveau_mdp"  />
                <label for="confimer_mdp"> Confirmer mot de passe </label>
                <input id="confirmer_mdp" type="password" name="confirmer_mdp" />
                <input type="submit" value="Envoyer"/>
            </form>
        </div>
<?php }?>
