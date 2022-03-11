
</main>
<footer>
<div id="RGPD">
  <div class="rgpd" v-if="!Modal && !rgpd">
  Acceptez vous le cookie de session de ce site ?
  <div class="formulaire">
    <button type="button" name="button" v-on:click="rgpd = true, Modal = true, valide">Oui</button>
    <button type="button" name="button" v-on:click="rgpd = false, Modal = true">Non</button>
  </div>
  </div>
  <p v-if="rgpd">Vous avez accepté le cookie de sesssion du site.</p>
  <p v-else>Vous n'avez pas accepté le cookie de session du site.</p>
</div>
<nav>
    Copyrigth &copy; <?=date('Y')?>

</nav>
</footer>
<?php
if(empty($_SESSION['RGPD'])) {
 ?>
 <script>
   const RGPD = Vue.createApp({
     data () {
       return {
       Modal: false,
       rgpd: false
       }
     },
     methods: {
       valide(){
         <?php $_SESSION['RGPD'] = true; ?>
       }
     }
   })
   RGPD.mount('#RGPD')
 </script>
 <?php
} else {

?>
<script>
  const RGPD = Vue.createApp({
    data () {
      return {
      Modal: <?=$_SESSION['RGPD']?>,
      rgpd: <?=$_SESSION['RGPD']?>
      }
    }
  })
  RGPD.mount('#RGPD')
</script>

<?php
 }?>

</body>


</html>
<?php $conn = null; ?>
