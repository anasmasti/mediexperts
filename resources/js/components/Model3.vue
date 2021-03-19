<script>
import PrintButton from './PrintButton.vue';
import {store} from '../store/store';
import { mapState } from 'vuex';

export default {
  components: { PrintButton },
  runtimeCompiler: true,
  data() {
    return {
      nForm : null,
      nCabinet : null,
      id_plan : null,
      selected_nrc_entrp: null
    }
  },
  mounted() {
    store.dispatch('FetchClients');
  },
  computed: {
    curr_nrc_entrp() { return store.state.curr_nrc_entrp; },
    clients() { return store.state.clients; },
    reference_plans() { return store.state.reference_plans; },
    actions_by_plan() { return store.state.actions_by_plan; },
    curr_annee_plan() { return store.state.curr_annee_plan; },
    cabinets() { return store.state.cabinets; },
    // ...mapState({
    //   cabinets:state => state.cabinets,
    // })
  },
  methods: {
    handleAction (actionName, value) {
      store.dispatch(actionName, value);
    }
  },
}
</script>


<template>
  <div>
    <!-- BUTTON IMPRIMER/ANNULER -->
    <print-button :backLink="'/'"></print-button>

    <!-- LISTE DE CHOIX -->
    <div style="width:100%;">

      <!-- SELECT ENTREPRISE -->
      <label for="client">Entreprise :</label>
      <select name="client" id="client" style="width:100%; padding: .5rem; border: 1px solid #000;"
        @change="handleAction('FetchReferencesPlan', selected_nrc_entrp); handleAction('SetNrcEntrp', selected_nrc_entrp)"
        v-model="selected_nrc_entrp">
        <option selected disabled>--sélectionner l'Entreprise ..</option>
        <option v-for="cl in clients" :value="cl.nrc_entrp" :key="cl.nrc_entrp">{{ cl.raisoci }}</option>
      </select>

      <!-- SELECT REF PLAN -->
      <div style="width:100%;">
        <label for="plans">Réference plan de formation :</label>
        <select v-if="reference_plans && reference_plans.length" name="plans" id="plans" style="width:100%; padding: .5rem; border: 1px solid #000;"
          @change="handleAction('FetchActionByReference', id_plan)" v-model="id_plan">

          <option selected disabled>-- sélectionner le plan</option>
          <option v-for="pdf in reference_plans" :value="pdf.id_plan" :key="pdf.id_plan">{{ pdf.refpdf }}</option>
        </select>
        <!--  -->
        <select v-else name="plans" id="plans" style="width:100%; padding: .5rem; border: 1px solid #000;">
          <option></option>
        </select>
      </div>

    </div>



    <!-- PAPER -->
    <div class="paper">

      <div class="text-center">
        <h2>Modèle 3</h2>
        <h4 class="uppercase">MODELE D’AVIS D’ANNULATION OU DE MODIFICATION</h4>
        <p class="text-italic">(Sur papier a entête de l’entreprise)</p>
      </div>

      <!-- TABLE -->
      <table style="background-color: #eaeaea">
        <tr>
          <th style="width: 30%" rowspan="6">Avis</th>
          <th style="width: 30%">Anulation</th>
          <th style="width: 30%" colspan="2">--</th>
        </tr>

        <tr>
          <th rowspan="5">Modification</th>
        </tr>

        <tr>
          <th style="width: 15%">De la date de Réalisation</th>
          <th>----</th>
        </tr>
        <tr>
          <th style="width: 15%">De l’organisme de formation</th>
          <th>----</th>
        </tr>
        <tr>
          <th style="width: 15%">De l’organisme de formation</th>
          <th>----</th>
        </tr>
        <tr>
          <th style="width: 15%">Organisation horaire</th>
          <th>----</th>
        </tr>
      </table>
      <!-- END TABLE -->

      <!-- CONTENT -->
      <div style="padding-left: 20px">
        <div style="margin-top: 20px">
          <strong>Thème de l’action :</strong>
          <select name="actions" class="highlighted" id="actions" style="width:50%; padding: .3rem; border: 1px solid #000;"
          @change="handleAction('FetchAllCabinets' , nCabinet)" v-model="nCabinet">
             <option selected disabled>-- Selectionner une action</option>
             <option v-for="action in actions_by_plan" :value="action.nForm" :key="action.nForm">{{ action.nom_theme }}</option>
             <option value=""></option>
          </select>
        </div>

        <!-- NATURE DE L'ACTION -->
        <div class="d-flex" style="margin-top: 20px">
          <strong>Nature de l’action :</strong>

          <div style="margin-left: auto">
            <label>Planifiée</label>
            <input type="checkbox" />
          </div>

          <div style="margin-left: auto">
            <label>Non Planifiée</label>
            <input type="checkbox" />
          </div>

          <div style="margin-left: auto">
            <label>Alpha</label>
            <input type="checkbox" />
          </div>
        </div>
        <!-- END NATURE DE L'ACTION -->

        <!-- EFFECTIF -->
        <div class="d-flex" style="margin-top: 10px">
          <strong>Effectif des participants :</strong>
          <input type="text" class="highlighted" value="" name="nb_partcp_total" />
        </div>
        <!-- END EFFECTIF -->

        <!-- ORGANISME -->
        <div class="d-flex" style="margin-top: 10px">
          <span>• Organisme de formation initial : </span>
          <input type="text" class="highlighted" value="..." />
        </div>
        <div class="d-flex" style="margin-top: 10px">
          <span>Nouvel Organisme de formation : </span>
          <select class="select highlighted" style="width: fit-content; font-size: 16px">
            <option selected disabled>--select organisme</option>
            <option v-for="cabinet in cabinets" :value="cabinet.nCabinet" :key="cabinet.nCabinet">{{ cabinet.raisoci }}</option>
          </select>
        </div>
        <!-- END ORGANISME -->

        <!-- LIEU -->
        <div class="d-flex" style="margin-top: 10px">
          <span>• Lieu de formation initial : </span>

        </div>
        <div class="d-flex" style="margin-top: 10px">
          <span>Nouveau lieu : </span>
          <select name="lieu" id="lieu" class="highlighted" style="width:35%; padding: .3rem; border: 1px solid #000;">
        <option selected disabled>--sélectionner l'Entreprise ..</option>
        <option v-for="cl in clients" :value="cl.nrc_entrp" :key="cl.nrc_entrp">{{ cl.raisoci }}</option>
      </select>
        </div>
        <!-- END LIEU -->

        <!-- DATES -->
        <div style="margin-top: 10px">
          <span>• Dates initiales de réalisation  : </span>
          <div class="d-flex">
            <input type="date" class="highlighted" value="..." />
            <input type="date" class="highlighted" value="..." />
            <input type="date" class="highlighted" value="..." />
            <input type="date" class="highlighted" value="..." />
            <input type="date" class="highlighted" value="..." />
            <input type="date" class="highlighted" value="..." />
          </div>
        </div>
        <div style="margin-top: 10px">
          <span>Nouvelles Dates exactes de réalisation : </span>
          <div class="d-flex">
            <input type="date" class="highlighted" value="..." />
            <input type="date" class="highlighted" value="..." />
            <input type="date" class="highlighted" value="..." />
            <input type="date" class="highlighted" value="..." />
            <input type="date" class="highlighted" value="..." />
            <input type="date" class="highlighted" value="..." />
          </div>
        </div>
        <!-- END DATES -->

        <!-- HORAIRE -->
        <div style="margin-top: 10px">
          <span>•	Organisation horaire initiale :</span>

          <div class="d-flex">
            <div>
              <span>heure début : </span>
              <input type="text" class="highlighted" value="..." />
            </div>
            <div>
              <span>heure fin : </span>
              <input type="text" class="highlighted" value="..." />
            </div>
          </div>
        </div>
        <div style="margin-top: 10px">
          <span>Nouvelle organisation horaire :</span>

          <div class="d-flex">
            <div>
              <span>heure début : </span>
              <input type="text" class="highlighted" value="..." />
            </div>
            <div>
              <span>heure fin : </span>
              <input type="text" class="highlighted" value="..." />
            </div>
          </div>
        </div>
        <!-- END HORAIRE -->

        <div style="margin-top: 50px">
          <strong>#nom du responsable#</strong>
        </div>

        <div class="d-flex" style="margin-top: 50px">
          <strong style="margin-left: auto;">#Cachet de l’entreprise, Signature et qualité du responsable#</strong>
        </div>

      </div>
      <!-- END CONTENT -->


    </div>
    <!-- END PAPER -->

  </div>

</template>

