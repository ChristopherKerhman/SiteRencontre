<?php

class PrintMessagerie extends GetMessagerie {
  public function listeMessage($data) {
    echo '<lu class="messagerie">';
    foreach ($data as $key => $value) {
      echo '<li><a class="lienTextuel" href="index.php?idNav=43&idContact='.$value['idContact'].'">'.$this->objet[$value['objet']].' - '.dateHeure($value['dateHeure']).'</a></li>';
    }
    echo '</lu>';
  }
  public function affichageOneMessage ($data) {
    echo '<article>
    <p class="texteLisible">
    Le : '.dateHeure($data[0]['dateHeure']).' <br />
    </p>
    <h5 class="texteLisible" >Objet : '.$this->objet[$data[0]['objet']].'</h5>

        <a class="lienTextuel texteLisible" href="mailto:'.$data[0]['email'].'">Répondre à '.$data[0]['email'].'</a>
        <br />
    <p class="texteLisible">
        '.$data[0]['courrielInterne'].'
    </p>
    <form class="formulaire" action="CUD/update/actionContact.php" method="post">
      <label for="etat">Modifier l\'état du message :</label>
      <select id="etat" name="etat">';
      for ($i=0; $i <count($this->etat) ; $i++) {
        if (($i == $data[0]['etat']+1)||($i == 3)) {
          echo '<option value="'.$i.'" selected>'.$this->etat[$i].'</option>';
        } else {
          echo '<option value="'.$i.'">'.$this->etat[$i].'</option>';
        }

      }
      echo'</select>
      <button type="submit" name="button">Classer</button>
    </form>
    </article>';
  }
}
