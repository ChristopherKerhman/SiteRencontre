<form class="formulaire" action="CUD/Create/inscription.php" method="post">
      <h3>Formulaire d'inscription</h3>
      <h4>Votre identité</h4>
      <label for="login">Speudonyme sur le site</label>
      <input id="login" class="inputFormulaire" type="text" name="login" required>
      <label for="codePostal">Numéro du département de résidence ?</label>
      <select id="codePostal" name="departement">
        <?php
        for ($i=1; $i <= 103 ; $i++) {
          echo '<option value="'.$i.'">'.$i.'</option>';
        }

         ?>
      </select>
      <label for="nom">Nom</label>
      <input id="nom" class="inputFormulaire" type="text" name="nom" required>
      <label for="prenom">Prenom</label>
      <input id="prenom" class="inputFormulaire" type="text" name="prenom" required>
      <label for="email">Votre email</label>
      <input id="email" class="inputFormulaire" type="text" name="email" placeholder="mail@user.fr" required>
      <label for="genre">Votre genre</label>
      <select id="genre" name="genre">
        <option value="0">Féminins</option>
        <option value="1">Masculin</option>
        <option value="2">Non genré</option>
      </select>
      <label for="mdp">Mot de passe</label>
      <input id="mdp" class="inputFormulaire" type="text" name="mdp" required>
      <div>
        <label for="CGU">Accepter les CGU du site ?</label>
        <input type="checkbox" name="valide">
      </div>

    <button type="submit" name="button">Créer un compte</button>
</form>
<div id="VERROU" class="postion_button">
    <button v-show="!cle" type="button" name="button" v-on:click="cle = true">Activer votre compte</button>
      <form v-if="cle" class="formulaire"  action="CUD/Update/inscription.php" method="post">
        <label for="token">Token de sécurité ?</label>
        <input type="password" name="token" required>
        <button type="submit" name="button">Activer votre compte</button>
      </form>
</div>
<?php include 'javascript/verrou.php'; ?>
