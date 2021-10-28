
<script>
export default {
  runtimeCompiler: true,
  name: 'plan-formation',
  data() {
    return {
      clients: [],
      curr_client: null,
      curr_annee: null,
      coutTotalPlan: 0,
      nrc_entrp: undefined, id_plan: undefined,
      reference_plan: [],
      actions_by_ref: [],
      plan_formation: [],
      dates_actions: [],
      current_dates: null,
      isAllLoaded: false,
      lieu: '',
      annee: ''
    }
  },
  mounted() {
    this.FillClients();
  },
  computed: {
  },
  methods: {
    async setLieuAndAnnee()  {
      let data = await this.actions_by_ref
      this.lieu = data[0].lieu
      this.annee = data[0].annee
      // console.log('Teeeeeest'  , data);
      // console.log('----L A---',this.lieu,this.annee);
    },
    DateFormat(date) {
      if (date) {
        let datestring = date.replace(/[^\w\s]/gi, '');
        let year = datestring.charAt(0) + datestring.charAt(1) + datestring.charAt(2) + datestring.charAt(3);
        let month = datestring.charAt(4) + datestring.charAt(5);
        let day = datestring.charAt(6) + datestring.charAt(7);
        return (day+'/'+month+'/'+year);
      } else {
        // console.error("date is", date)
      }
    },
    async FillClients() {
      this.coutTotalPlan = 0;
      await axios.get('/fill-clients')
        .then((res) => {
          this.clients = res.data;
          //console.log("clients : ", this.clients)
        })
        .catch((err) => console.error("err FillClients", err));
    },
    async FillReferencesPlan() {
      // console.log('nrc_entrp', this.nrc_entrp);
      await axios.get(`/fill-reference-plan?nrcEntrp=${this.nrc_entrp}`)
        .then((res) => {
          this.reference_plan = res.data;
          this.curr_client = res.data[0].raisoci;
          // console.log("reference_plan : ", this.reference_plan)
        })
        .catch((err) => console.log("err FillReferencesPlan", err));
    },
    async FillPlanByReference() {
      console.log("actions_by_ref : ", this.actions_by_ref)
      await axios.get(`/fill-plans-by-reference?idPlan=${this.id_plan}`)
        .then((res) => {
          this.actions_by_ref = res.data;
          this.curr_annee = res.data[0].annee;
          console.log("actions_by_ref : ", this.actions_by_ref)
        })
        .then(() => {
          // fill dates action
          this.actions_by_ref.forEach((action) => {
            // calculer le cout estimatif
            this.coutTotalPlan += action.bdg_total;
            this.FillDates(action.n_form);
          });
        })
        .catch((err) => console.error("err FillPlanByReference", err));
      this.isAllLoaded = true;
      // console.log("isallloaded", this.isAllLoaded);
    },
    async FillDates(nform) {
      await axios.get(`/fill-dates-plan?nForm=${nform}`)
        .then((res) => {
          this.dates_actions = res.data;
          console.log(this.dates_actions);
        })
        .then(() => {
          this.AssignDates(nform);
        })
        .catch((err) => console.error("err FillDates", err));
    },
    async AssignDates(nform) {
      await this.actions_by_ref.forEach(action => {
        if (action.n_form == nform) {
          this.dates_actions.forEach(forma => {
            if (forma.n_form == nform) {
              Object.assign(action, {dates: {}});
              for (let i = 1; i < 30; i++) {
                //************************ vvv [dynamic key assignement] vvv */
                Object.assign(action.dates, {[`date${i}`]: forma[`date${i}`]});
              }
            }
            // console.log("assign dates action: ", action);
          });
        }
      });
    },
    ResetCoutTotalPlan() {
      this.coutTotalPlan = 0;
    }
  }, // methods
  computed: {

  } // computed
}
</script>

<template>
<div class="avis-affichage">
  <!-- {{-- PRINT - CANCEL --}} -->
  <div class="hide-from-print">
    <div style="display:flex; justify-content:space-between;">
      <a class="bu-print" id="back" href="/">Retour</a>
      <a class="bu-print" id="buPrintF2" href="#" onclick="window.print()">Imprimer le formulaire</a>
    </div>

    <div style="width:100%;">
      <label for="client">Entreprise :</label>
      <select name="client" id="client" style="width:100%; padding: .5rem; border: 1px solid #000;"
        v-on:change="FillReferencesPlan()" v-model="nrc_entrp">

        <option selected disabled>--sélectionner l'Entreprise ..</option>
        <!-- @foreach ($client as $cl)
          <option value="{{$cl->nrc_entrp}}">{{$cl->raisoci}}</option>
        @endforeach -->
        <option v-for="cl in clients" :value="cl.nrc_entrp" :key="cl.nrc_entrp">{{ cl.raisoci }}</option>
      </select>
    </div>

    <div style="width:100%;">
      <label for="plans">Réference plan de formation :</label>
      <select name="plans" id="plans" style="width:100%; padding: .5rem; border: 1px solid #000;"
        v-if="reference_plan && reference_plan.length" v-on:change="FillPlanByReference(); ResetCoutTotalPlan();" v-model="id_plan">

        <!-- {{-- auto filled --}} -->
        <option selected disabled>-- sélectionner le plan</option>
        <option v-for="pdf in reference_plan" :value="pdf.id_plan" :key="pdf.id_plan">{{ pdf.refpdf }}</option>
      </select>
      <select name="plans" id="plans" style="width:100%; padding: .5rem; border: 1px solid #000;" v-else>
        <option>(vide)</option>
      </select>
    </div>

    <div class="btn-group">
      <button class="btn-btn-primary" id="dateBtn" v-on:click="FillReferencesPlan(),setLieuAndAnnee();" style="background: #00ff11; margin: .5rem 0; padding: .5rem;">
        Remplir les dates
      </button>
    </div>

    <div style="width:100%; height:50px;"><!--space--></div>
  </div>
  <!-- **************************** -->



  <div class="paper" style="padding:.5rem; font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff;">

    <div class="container center">
      <h1 style="padding: 5px !important; margin:0; font-size: 24px;">
        « Société:
        <strong id="entrp"> {{lieu}}</strong>
        »
      </h1>
    </div>

    <div class="container text-center">
      <h3 class="text-bold" style="text-transform: uppercase; margin-bottom: 10px !important;">
        Plan de formation:
        <span name="year" id="year"> {{annee}}</span>
      </h3>

    </div>

    <div style="width:100%; height:15px;"><!--space--></div>

    <div class="container text-center" style="padding: 0px 50px 20px 50px;">
      <span>Nous informons l’ensemble du personnel que le plan de formation relatif à l’année: <span id="year2">{{annee}}</span> se présente comme suit :</span>
    </div>

    <!-- {{-- FORMATIONS --}} -->
    <table>
      <thead style="font-size:14px;">
        <tr>
          <th style="width:70%; padding: 1rem; font-size: 16px">Thème de l'action</th>
          <th style="width:30%; padding: 1rem; font-size: 16px">Dates de réalisation</th>
        </tr>
      </thead>

      <tbody id="tableFormation" class="center">
        <tr v-for="(action, idx) in actions_by_ref" :key="`plan${idx}`">
          <td class="padding: .3rem;">{{action.nom_theme}}</td>
          <td :id="action.n_form">
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date1)  || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date2)  || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date3)  || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date4)  || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date5)  || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date6)  || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date7)  || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date8)  || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date9)  || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date10) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date11) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date12) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date13) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date14) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date15) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date16) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date17) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date18) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date19) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date20) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date21) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date22) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date23) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date24) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date25) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date26) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date27) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date28) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date29) || "" }}</p>
            <p style="margin: .1rem !important;">{{ action.dates && DateFormat(action.dates.date30) || "" }}</p>
          </td>
        </tr>
      </tbody>
    </table>


  </div>

</div>



</template>
