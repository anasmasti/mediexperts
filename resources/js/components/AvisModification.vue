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
           <label>Entreprise</label>
          <select class="form-control" id="client" name="client"
        v-model="selected_nrc_entrp">
        <option selected disabled>---selectionner l'entreprise---</option>
        <option v-for="cl in clients" :value="cl.nrc_entrp" :key="cl.nrc_entrp">{{cl.raisoci}}</option>

          </select>
         </div>

         <div class="form-group col-lg-6 col-sm-12">
      <label>Réference plan de formation </label>
      <select class="form-control" name="plans" id="plans">
        <option selected disabled>---selectionner le plan---</option>
          <option>----</option>
          <option>-----</option>
      </select>
    </div>

 <div class="form-group col-lg-6 col-sm-12">
      <label>État d'avis</label>
      <select class="form-control" id="etat" onkeypress="getSelected()" >
        <option selected disabled>---selectionner l'état---</option>
          <option value="annulation" id="etatAnul">Annulation</option>
          <option value="modification" id="etatModif">Modification</option>
      </select>
    </div>

     <table class="table table-striped col-12 col-lg-6 border" style="margin: 16px">
      <thead>
        <tr>
          <th style="width: 10%" rowspan="6">Avis</th>
          <th style="width: 10%">Anulation</th>
          <th style="width: 10%" colspan="2"> <input type="checkbox" id="annuler"> </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th rowspan="5">Modification</th>
        </tr>
        <tr>
          <th style="width: 5%">De la date de Réalisation</th>
          <th> <input type="checkbox" name="modif" id="modif_a"> </th>
        </tr>
        <tr>
          <th style="width: 5%">De l’organisme de formation</th>
          <th> <input type="checkbox" name="modif" id="modif_b"> </th>
        </tr>
        <tr>
          <th style="width: 5%">De lieu de formation</th>
          <th> <input type="checkbox" name="modif" id="modif_c"> </th>
        </tr>
        <tr>
          <th style="width: 5%">Organisation horaire</th>
          <th> <input type="checkbox" name="modif" id="modif_d"> </th>
        </tr>
      </tbody>
    </table>

     <div class="form-group col-lg-6 col-sm-12">
      <label>Thème de l’action</label>
      <select class="form-control" id="action" name="action">
        <option selected disabled>---selectionner le thème---</option>

      </select>
    </div>


<div class="form-group col-lg-6 col-sm-12">
<label>Nature de l'action</label>
  <div class="form-group">
  <div class="custom-control custom-checkbox">
      <input type="checkbox" name="planifie" id="planifie" class="custom-control-input" checked>
      <label for="planifie" class="custom-control-label">Planifié</label>
  </div>
  <div class="custom-control custom-checkbox">
    <input type="checkbox" name="nonplanifie" id="nonplanifie" class="custom-control-input">
    <label for="nonplanifie" class="custom-control-label">Non planifié</label>
</div>
<div class="custom-control custom-checkbox">
  <input type="checkbox" name="alpha" id="alpha" class="custom-control-input">
  <label for="alpha" class="custom-control-label">Alpha</label>
</div>
  </div>
</div>


 <div class="form-group col-lg-6 col-sm-12">
          <label>Organisme de formation initial</label>
          <input type="text" name="" id="" class="form-control">
    </div>
    <div class="form-group col-lg-6 col-sm-12">
      <label>Nouvel Organisme de formation</label>
      <select class="form-control">
        <option selected disabled>---selectionner l'organisme---</option>
          <option>-----</option>
          <option>------</option>
      </select>
    </div>


       <div class="form-group col-lg-6 col-sm-12">
      <label>Lieu de formation initial </label>
      <input type="text" name="" id="" class="form-control">
</div>
<div class="form-group col-lg-6 col-sm-12">
  <label>Nouveau lieu</label>
  <select class="form-control">
    <option selected disabled>---selectionner le lieu---</option>

  </select>
</div>


<!-- {{-- LES DATES INITIALES --}} -->
<div class="form-group col-lg-3 col-md-6 col-12">
  <label>Dates initiales de réalisation </label>
  <input class="form-control" type="date" >
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
  <label>.</label>
  <input class="form-control" type="date" >
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
  <label>.</label>
  <input class="form-control" type="date" >
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
  <label>.</label>
  <input class="form-control" type="date" >
</div>

<!-- {{-- LES NOUVELLES DATES --}} -->
<div class="form-group col-lg-3 col-md-6 col-12">
  <label>Nouvelles Dates exactes de réalisation </label>
  <input class="form-control" type="date" >
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
  <label>.</label>
  <input class="form-control" type="date" >
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
  <label>.</label>
  <input class="form-control" type="date" >
</div>

<div class="form-group col-lg-3 col-md-6 col-12">
  <label>.</label>
  <input class="form-control" type="date" >
</div>

<!-- {{-- L'HORAIRE INITIALE --}} -->


<div class="form-group col-lg-3 col-sm-12">
  <label >Organisation horaire initiale </label>
  </div>

<div class="form-group col-lg-3 col-sm-12">
  <label>Heure début</label>
  <div class='input-group date' id='datetimepicker3'>
    <input class="form-control" type="time" name="hr_debut" />
    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker"></div>
      <div class="input-group-text"><i class="far fa-clock"></i></div>
    </div>
  </div>

  <div class="form-group col-lg-3 col-sm-12">
    <label>Heure fin</label>
    <div class='input-group date' id='datetimepicker3'>
      <input class="form-control timerpicker" type="time" name="hr_fin" />
      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker"></div>
        <div class="input-group-text"><i class="far fa-clock"></i></div>
      </div>
    </div>
</div>


<div class="row">
<div class="form-group col-lg-3 col-sm-12 d-flex">
  <label >Nouvelle organisation horaire </label>
  </div>


  <div class="form-group col-lg-3 col-sm-12">
    <label>Heure début</label>
    <div class='input-group date' id='datetimepicker3'>
      <input class="form-control" type="time" name="hr_debut" />
      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker"></div>
        <div class="input-group-text"><i class="far fa-clock"></i></div>
      </div>
    </div>
    <!-- {{--  --}} -->
    <div class="form-group col-lg-3 col-sm-12">
      <label>Heure fin</label>
      <div class='input-group date' id='datetimepicker3'>
        <input class="form-control timerpicker" type="time" name="hr_fin" />
        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker"></div>
          <div class="input-group-text"><i class="far fa-clock"></i></div>
        </div>
      </div>
      </div>
    </div>

    <div class="card-footer text-center">

        <a href="/print-m3" class="btn btn-info"><i class="fa fa-print"></i>&nbsp;Imprimer</a>
        <!-- <a href="#" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Modifier</a> -->
</div>

   </form>
</div>

</template>

<script>
import { mapState } from 'vuex';
export default {
  runtimeCompiler: true,

      data(){
          return {
      //csrf token
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      nForm : null,
      nCabinet : null,
      id_plan : null,
      selected_nrc_entrp: null
       }

  },
   mounted() {
    this.$store.dispatch('model3/FetchClients');
  },
  computed: {
    ...mapState('model3',{
      curr_nrc_entrp: state => state.curr_nrc_entrp,
      clients: state => state.clients,
      reference_plans: state => state.reference_plans,
      actions_by_plan: state => state.actions_by_plan,
      curr_annee_plan: state => state.curr_annee_plan,
      cabinets: state => state.cabinets,
    })
  },
  methods: {
    handleAction (actionName, value) {
      this.$store.dispatch(actionName, value);
    }
  }

}
</script>

<style>

</style>
