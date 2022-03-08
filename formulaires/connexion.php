<div id="VERROU" class="formulaire">
<form class="formulaire" action="securite/connexion.php" method="post">
  <label for="speudo">Votre pseudo</label>
  <input id="speudo" class="inputFormulaire" type="text" name="login" placeholder="Votre pseudo" required>
  <label for="mdp">Votre mot de passe</label>
  <input id="speudo" class="inputFormulaire" type="password" name="motDePasse" placeholder="Votre mot de passe" required>
  <button type="submit" name="button">Connexion</button>
</form>
<button v-if="!cle" type="button" name="button" v-on:click="cle = true">Mot de passe oublié ?</button>
<button v-else type="button" name="button" v-on:click="cle = false">Fermer</button>
  <form v-if="cle" class="formulaire"  action="CUD/Update/lostMDP.php" method="post">
    <label for="email">Votre mail de sécurité :</label>
    <input id="email" type="text" name="email" required>
    <button type="submit" name="button">Créer la procédure</button>
  </form>
<button v-if="!cle2" type="button" name="button" v-on:click="cle2 = true">Réinitialisé votre mot de passe ?</button>
<button v-else type="button" name="button" v-on:click="cle2 = false">Fermer</button>
    <form v-if="cle2" class="formulaire"  action="CUD/Update/changeMDP.php" method="post">
      <label for="email">Votre mail de sécurité : </label>
      <input id="email" type="text" name="email" required>
      <label for="token">Votre token :</label>
      <input id="token" type="text" name="token" required>
      <label for="mdp">Votre nouveau mot de passe :</label>
      <input id="mdp" type="password" name="mdp" required>
      <button type="submit" name="button">Réactiver votre compte</button>
    </form>
</div>
<?php include 'javascript/verrou.php'; ?>
