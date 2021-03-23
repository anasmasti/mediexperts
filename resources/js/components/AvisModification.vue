<template>
<div class="card card-dark">
  <!-- card-header -->
  <div class="card-header">
    <h3 class="card-title">Annuler ou modifier l'état d'avis</h3>
  </div><br>
   <form role="form" action="#" method="POST">
    <input type="hidden" name="_token" v-bind:value="csrf" />
     <!-- {{ csrf_field() }} -->
    <div class="card-body">
      <div class="row">


    <div class="form-group col-lg-6 col-sm-12">
      <label>État d'avis</label>
      <select class="form-control" id="etat" onkeypress="getSelected()" >
        <option selected disabled>---selectionner l'état---</option>
          <option value="annulation" id="etatAnul">Annulation</option>
          <option value="modification" id="etatModif">Modification</option>
      </select>
    </div>
      </div>
    </div>
   </form>
</div>
</template>

<script>
export default {
      data(){
          return {
            //csrf token
             csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
       }
  }
}
</script>

<style>

</style>
