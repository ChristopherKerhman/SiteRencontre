<?php
require 'objets/getSorties.php';
require 'objets/printSortie.php';
$idSortie = filter($_GET['idSortie']);
$oneSortie = new PrintSortie();
$dataSortie = $oneSortie->oneSortie($idSortie);
 ?>
 <form class="formulaire" action="CUD/Update/sortie.php" method="post">
   <h3>Modifier une sortie <?=$_SESSION['login']; ?> ?</h3>
   <label for="titreSortie">Titre de votre sortie</label>
   <input id="titreSortie" type="text" name="titreSortie" value="<?=$dataSortie[0]['titreSortie']?>" required>
   <label for="texteSortie">Description de votre sortie</label>
   <textarea id="texteSortie" name="texteSortie" rows="8" cols="80"><?=$dataSortie[0]['texteSortie']?></textarea>
 <div id="GRATUIT">
   <ul id="price">
 <li>
   <label for="gratuit">La sortie est elle gratuite ? <?php if($dataSortie[0]['gratuit'] > 0) {echo 'Non';} else { echo 'Oui'; } ?></label>
     <select id="gratuit" name="gratuit" v-model="gratuit" value="<?=$dataSortie[0]['gratuit']?>">
       <?php if($dataSortie[0]['gratuit'] >0) {
         echo '    <option value="0" >Oui</option>
              <option value="1" selected>Non</option>';
       } else {
         echo '    <option value="0" selected>Oui</option>
              <option value="1" >Non</option>';
       } ?>

     </select>
 </li>
 <li v-if="gratuit == 1">
   <label for="prix">Prix par personne de votre sortie ?</label>
     <input id="prix" type="number" name="prix" min="1" max="120" value="<?=$dataSortie[0]['prix']?>"> €
 </li>
 </ul>
 </div>
 <div>
 <label for="nombreMax">Nombre de personne maximum ?</label>
 <input id="nombreMax" type="number" name="nombreMax" min="3" max="120" value="<?=$dataSortie[0]['nombreMax']?>"> personnes</div>
   <h4>Date et heure </h4>
 <label for="dateHeureSortie">Date de la sortie ?</label>
 <input type="date" name="dateSortie" min="<?php echo date('Y-m-d'); ?>" value="<?=$dataSortie[0]['dateSortie']?>" required>
 <label for="heureSortie">Heure du rendez-vous ?</label>
 <input id="heureSortie" type="time" name="heureSortie" value="<?=$dataSortie[0]['heureSortie']?>" required>
 </div>
   <h4>Adresse </h4>
   <label for="lieu">adresse de la sortie ?</label>
   <input id="lieu" type="text" name="lieu" value="<?=$dataSortie[0]['lieu']?>" required>
   <label for="codePostal">Numéro du département de la sortie ?</label>
   <select id="codePostal" name="codePostal">
     <?php
     for ($i=1; $i <= 103 ; $i++) {
       if($dataSortie[0]['codePostal'] == $i){
         echo '<option value="'.$i.'" selected>'.$i.'</option>';
       } else {
            echo '<option value="'.$i.'">'.$i.'</option>';
       }

     }

      ?>
   </select>
 <div>
 <label for="adult">Sortie interdit aux mineurs ?</label>
 <select name="adult">
   <?php if($dataSortie[0]['adult'] >0) {
     echo '    <option value="0" >Non</option>
          <option value="1" selected>Oui</option>';
   } else {
     echo '    <option value="0" selected>Non</option>
          <option value="1" >Oui</option>';
   } ?>

 </select>

 <label for="partager">Partager cette sortie ?</label>
 <select id="partager" name="partager">
   <?php if($dataSortie[0]['partager'] >0) {
     echo '    <option value="0" >Non</option>
          <option value="1" selected>Oui</option>';
   } else {
     echo '    <option value="0" selected>Non</option>
          <option value="1">Oui</option>';
   } ?>
 </select>

 <?php if($pass == 1) { ?>
   <label for="pass">Pass Sanitaire obligatoire ?</label>
 <select id="pass" name="passSanitaire">
   <?php if($dataSortie[0]['passSanitaire'] > 0) {
     echo '    <option value="1" selected>Oui</option>
          <option value="0">Non</option>';
   } else {
     echo '    <option value="1" >Oui</option>
          <option value="0" selected>Non</option>';
   } ?>
 </select>
 <?php } ?>
 <?php
 // Liste des sorties disponible
 $triType = "SELECT `idTypeSortie`, `typeSortie` FROM `types` WHERE `valide` = 1 ORDER BY `typeSortie`";
 $param = [];
 $triTypesSorties = new readDB($triType, $param);
 $dataTypesSortie = $triTypesSorties->read();

  ?>
 <label for="type">Type de sortie ?</label>
 <select id="type" name="type">
   <?php foreach ($dataTypesSortie as $key => $value) {
     if ($dataSortie[0]['type'] == $value['idTypeSortie']) {
       echo '<option value="'.$value['idTypeSortie'].'" selected>'.$value['typeSortie'].'</option>';
     } else {
     echo '<option value="'.$value['idTypeSortie'].'">'.$value['typeSortie'].'</option>';
    }
   } ?>
 </select>
 </div>
  <input type="hidden" name="idSortie" value="<?=$dataSortie[0]['idSortie']?>">
 <input type="hidden" name="idNav" value="<?=$idNav?>">
   <button type="submit" name="button">Modifier</button>
 </form>
 <script>
   const GRATUIT = Vue.createApp({
     data () {
       return {
       gratuit: 0
       }
     }
   })
   GRATUIT.mount('#GRATUIT')
 </script>
