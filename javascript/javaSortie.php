<script>
  const GRATUIT = Vue.createApp({
    data () {
      return {
      gratuit: <?=$dataSortie[0]['gratuit']?>,
      texte: '<?=$dataSortie[0]['texteSortie']?>'
      }
    }
  })
  GRATUIT.mount('#GRATUIT')
</script>
