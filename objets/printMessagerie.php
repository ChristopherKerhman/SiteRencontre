<?php

class PrintMessagerie extends GetMessagerie {
  public function listeMessage($data) {
    echo '<lu class="messagerie">';
    foreach ($data as $key => $value) {
      echo '<li><a class="lienTextuel" href="index.php?idNav=43&idContact='.$value['idContact'].'">'.$this->objet[$value['objet']].' - '.dateHeure($value['dateHeure']).'</a></li>';
    }
    echo '</lu>';
  }
  public function affichageOneMessage ($data, $idNav) {
    echo '<article>';
    echo'<h3>Lecture des messages</h3>

    <ul class="texteLisible">
      <li>Etat du message : '.$this->etat[$data[0]['etat']].'</li>
      <li>Le : '.dateHeure($data[0]['dateHeure']).' <br /></li>
    </ul>


    <h5 class="texteLisible" >Objet : '.$this->objet[$data[0]['objet']].'</h5>

        <a class="lienTextuel texteLisible" href="mailto:'.$data[0]['email'].'">Répondre à '.$data[0]['email'].'</a>
        <br />
    <p class="texteLisible">
        '.$data[0]['courrielInterne'].'
    </p>

        <form class="formulaire" action="CUD/Update/actionContact.php" method="post">
      <label for="etat">Modifier l\'état du message :</label>
      <select id="etat" name="etat">';
      for ($i=0; $i <count($this->etat) ; $i++) {
        if (($i == $data[0]['etat'])) {
          echo '<option value="'.$i.'" selected>'.$this->etat[$i].'</option>';
        } else {
          echo '<option value="'.$i.'">'.$this->etat[$i].'</option>';
        }

      }
      echo'</select>
      <input type="hidden" name="idContact" value="'.$data[0]['idContact'].'" />
      <input type="hidden" name="idNav" value="'.$idNav.'" />
      <button type="submit" name="button">Classer</button>
    </form>';
    if($data[0]['etat'] == 2) {
      echo '<form class="formulaire" action="CUD/Delette/delContact.php" method="post">
        <input type="hidden" name="idContact" value="'.$data[0]['idContact'].'" />
        <button type="submit" name="button">Effacer</button>
      </form>';
    }
    echo'</article>';


  }
}
