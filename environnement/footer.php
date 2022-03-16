
</main>
<footer>
<nav>

Copyrigth &copy; <?=date('Y')?> &nbsp;
<?php if(empty($_SESSION['RGPD'])){
  $rgpdMessage = 'Le site ne génère qu\'un cookie de session.';
} else {
  $rgpdMessage = 'Vous êtes loggée sur le site le cookie de session est actif.';
}
echo $rgpdMessage;
 ?>
</nav>
</footer>
</body>
</html>

<?php $conn = null; ?>
