<template>
<div>
<print-button :backLink="'/'"></print-button>
    <div style="width:100%;" class="hide-from-print">
      <!-- SELECT ENTREPRISE -->
      <label class="hide-from-print" for="client">Entreprise :</label>
      <select
        class="hide-from-print"
        name="client"
        id="client"
        style="width:100%; padding: .5rem; border: 1px solid #000;"
        @change="
          handleAction('G6/FetchReferencesPlan', selected_nrc_entrp);
        "
        v-model="selected_nrc_entrp"
      >
        <option selected disabled>--sélectionner l'Entreprise --</option>
        <option
          v-for="cl in clients"
          :value="cl.nrc_entrp"
          :key="cl.nrc_entrp"
          >{{ cl.raisoci }}</option
        >
      </select>
      <!-- SELECT REF PLAN -->
      <div style="width:100%;" class="hide-from-print">
        <label for="plans">Réference plan de formation :</label>
        <select
          v-if="reference_plans && reference_plans.length"
          class="hide-from-print"
          name="plans"
          id="plans"
          style="width:100%; padding: .5rem; border: 1px solid #000;"
          @change="handleAction('G6/FetchActionByReference', id_plan),
          handleAction('G6/FecthSelectedRefG6Info', id_plan),
          CalculNombreActionRealise(),SetTitle()
          "
          v-model="id_plan"
        >
          <option selected disabled>-- sélectionner le plan</option>
          <option
            v-for="pdf in reference_plans"
            :value="pdf.id_plan"
            :key="pdf.id_plan"
            >{{ pdf.refpdf }}</option
          >
        </select>
        <!--  -->
        <select
          v-else
          name="plans"
          id="plans"
          style="width:100%; padding: .5rem; border: 1px solid #000;"
        >
          <option></option>
        </select>
      </div>
    </div>
    <div class="center">
       <h2>G6 : Déclaration de réalisation des actions de formation</h2>
    </div>
  <div v-for="(info, index) in G6_info" :key="index">
  <div class="rows">
    <div>
      <label for="entrepriseDirecteur" style="font-size:15px">Je soussigné (Nom du représentant légal de l’entreprise) :</label>
      <span style="background-color:yellow"> {{ info.nom_dg1 }} </span>
    </div>
    <div style="margin-top:5px">
      <label for="raison_social" style="font-size:15px"> Raison Social :</label>
      <span style="background-color:yellow"> {{ info.raisoci }} </span>
    </div>
    <div style="margin-top:5px">
      <label for="Fonction" style="font-size:15px">Fonction :</label>
      <span style="background-color:yellow"> {{ info.fonct_dg1 }} </span>
    </div>
    <div style="margin-top:5px">
      <label for="year" style="font-size:15px">
        J’atteste sur l’honneur que le bilan de réalisation du plan de formation de notre entreprise au titre de l’exercice <span style="background-color:yellow">{{ info.annee }}</span>  Se présente comme suit :
      </label>
    </div>
    <div style="margin-top:5px">
      <label style="font-size:15px">Nombre des actions réalisées (1)  = </label>
      <span style="background-color:yellow"> {{ nombreActionReas }} </span>
    </div>
    <div style="margin-top:5px">
      <label style="font-size:15px">Nombre total des actions prévues (2)  = </label>
      <span style="background-color:yellow"> {{ actions_by_plan.length }} </span>
    </div>
    <div style="margin-top:5px">
      <label style="font-size:15px">Taux de réalisation (1) / (2) (**) =</label>
      <span style="background-color:yellow"> {{ nombreActionReas == 0 ? tauxReas = 0 : tauxReas }} %</span>
    </div>
  </div>

  <div class="table" style="margin-top:10px" >
    <table>
      <thead class="center" style="font-weight: bold;">
        <td>
          Actions prévues dans le plan de formation année  <span>{{ info.annee }}</span>
        </td>
        <td>
          Action réalisée (*)
        </td>
        <td>
        Dossier de remboursement déposé à l’UG CSF (*)
        </td>
        <td>
          Observations (Raisons expliquant la non réalisation)
        </td>
      </thead>
      <tr class="center" v-for="(action , index) in actions_by_plan" :key="index">
        <td> {{action.nom_theme}} </td>
        <td v-if="action.etat_formation == 'réalisé' "> Oui </td>
        <td v-if="action.etat_formation != 'réalisé' "> Non </td>
        <td v-if="action.etat_formation == 'réalisé' ">
          <input name="UG_CSF" list="id_UG_CSF" style="text-align:center;">
          <datalist id="id_UG_CSF">
            <option value="Oui"></option>
            <option value="Non"></option>
            <option value="En cours "></option>
          </datalist>
          <!-- <select name="UG_CSF" id="UG_CSF" style="">
            <option value="Oui">Oui</option>
            <option value="Non">Non</option>
          </select> -->
        </td>
        <td v-if="action.etat_formation != 'réalisé' ">Non</td>
        <td>
          <input style="width:auto" type="text" id="observation">
          <!-- <textarea name="observation" id="observation" cols="2" rows="3" placeholder="Observation"></textarea> -->
        </td>
      </tr>
    </table>
  </div>
  <div id="last_info">
    <label>(*) Oui / Non </label> <br>
    <label>(**) Ce taux doit être au minimum de 30% pour l’exercice <span style="background-color:yellow;"> {{ info.annee }} </span></label> <br>
    <label style="font-weight: bold;">
      NB : L’acceptation du financement de l’ingénierie de l’année N par le CCE du GIAC dépend du taux de réalisation du plan de formation de l’année N-1
    </label>
  </div>
  <div class="d-flex" style="margin-left:45%;margin-top:35px;">
    <label for="Directeur"> DIRECTION :
      <span style="background-color:yellow" > {{ info.raisoci }} </span>  <br> <br>
      <label style="margin-top:10px;">Fait le : <span style="background-color:yellow;"> ......................................... </span> Cachet de l’entreprise et signature</label>
</label>

  </div>
  </div>
</div>
</template>

<script>
import PrintButton from "./PrintButton.vue";
import { mapState } from "vuex";

export default {
  components: { PrintButton },
  runtimeCompiler: true,

  data() {
    return {
        //variables
        selected_nrc_entrp :  null,
        id_plan: null,
        nombreActionReas: null,
        tauxReas: null,
        title: "",
    };
  },

updated () {

},

mounted () {
  this.$store.dispatch("G6/FetchClients");
},

computed : {
    ...mapState("G6", {
        clients: state => state.clients,
        reference_plans: state => state.reference_plans,
        actions_by_plan: state => state.actions_by_plan,
        G6_info: state => state.G6_info,
})
},

methods : {
  handleAction(actionName, value) {
    this.$store.dispatch(actionName, value);
  },

  CalculNombreActionRealise () {
    setTimeout(() => {
     let item
     let counter = 0
     let taux_realisation
     let data = this.actions_by_plan
     let total_prevus = data.length
        for (item in data) {
          if (data[item].etat_formation == 'réalisé') {
        counter = counter + 1
        }
      }
      taux_realisation = Math.round(parseFloat((counter / total_prevus) * 100).toPrecision(4));
      this.nombreActionReas = counter
      this.tauxReas = taux_realisation
      return this.nombreActionReas, this.tauxReas
    }, 2000);

  },
  SetTitle() {
    setTimeout(() => {
      for (let i = 0; i < this.G6_info.length; i++) {
        this.title = this.G6_info[0].refpdf
      }
      console.log("title", this.title);
      document.title = `G6 - ${this.title}`
    }, 1000);
  }
},

}
</script>
