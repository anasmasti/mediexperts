<script>
export default {
  data() {
    return {

    }
  },
  props: {
    backLink: { type: String, required: true }
  }
}
</script>

<template>
    <!-- {{-- PRINT - CANCEL --}} -->
    <div class="hide-from-print">
      <div style="display:flex; justify-content:space-between;">
        <a class="bu-print" id="back" :href="backLink">Retour</a>
        <a class="bu-print" id="buPrint" href="#" onclick="window.print()">Imprimer le formulaire</a>
      </div>
    </div>
    <!-- **************************** -->
</template>


<style>
</style>
