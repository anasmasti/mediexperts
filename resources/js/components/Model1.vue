
<script>
export default {
  runtimeCompiler: true,
  data() {
    return {
      clients: [],
      curr_client: null,
      curr_annee: null,
      nrc_entrp: undefined,
      id_plan: undefined,
      reference_plan: [],
      actions_by_ref: [],
      plan_formation: [],
      dates_actions: [],
      current_dates: null,
      isAllLoaded: false,
    }
  },
  mounted() {
    this.FillClients();
  },
  computed: {
  },
  methods: {
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
      await axios.get('/fill-clients')
        .then((res) => {
          this.clients = res.data;
          // console.log("clients : ", this.clients)
        })
        .catch((err) => console.error("err FillClients", err));
    },
    async FillReferencesPlan() {
      console.log('nrc_entrp', this.nrc_entrp)
      await axios.get(`/fill-reference-plan?nrcEntrp=${this.nrc_entrp}`)
        .then((res) => {
          this.reference_plan = res.data;
          this.curr_client = res.data[0].raisoci;
          console.log("reference_plan : ", this.reference_plan)
        })
        .catch((err) => console.log("err FillReferencesPlan", err));
    },
    async FillPlanByReference() {

      await axios.get(`/fill-plans-by-reference?idPlan=${this.id_plan}`)
        .then((res) => {
          this.actions_by_ref = res.data;
          this.curr_annee = res.data[0].annee;
          console.log("actions_by_ref : ", this.actions_by_ref)
        })
        .then(() => {
          // fill dates action
          this.actions_by_ref.forEach((action) => {
            this.FillDates(action.n_form);
          });
        })
        .catch((err) => console.error("err FillPlanByReference", err));
      this.isAllLoaded = true;
      console.log("isAllLoaded", this.isAllLoaded);
    },
    async FillDates(nform) {
      await axios.get(`/fill-dates-plan?nForm=${nform}`)
        .then((res) => {
          this.dates_actions = res.data;
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
            console.log("assign dates action: ", action);
          });
        }
      });
    },
  }, // methods
  computed: {
  } // computed
}
</script>

<template>
  <div class="model1">
    <!-- {{-- PRINT - CANCEL --}} -->
    <div class="hide-from-print">
      <div style="display:flex; justify-content:space-between;">
        <a class="bu-print" id="back" href="/">Retour</a>
        <a class="bu-print" id="buPrintF2" href="#" onclick="window.print()">Imprimer le formulaire</a>
      </div>

      <div style="width:100%;">
        <label for="client">Entreprise :</label>
        <select name="client" id="client" style="width:100%; padding: .5rem; border: 1px solid #000;"
          @change="FillReferencesPlan()" v-model="nrc_entrp">

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
          v-if="reference_plan && reference_plan.length" @change="FillPlanByReference()" v-model="id_plan">

          <!-- {{-- auto filled --}} -->
          <option selected disabled>-- sélectionner le plan</option>
          <option v-for="pdf in reference_plan" :value="pdf.id_plan" :key="pdf.id_plan">{{ pdf.refpdf }}</option>
        </select>
        <select name="plans" id="plans" style="width:100%; padding: .5rem; border: 1px solid #000;" v-else>
          <option>(vide)</option>
        </select>
      </div>

      <div class="btn-group">
        <button class="btn-btn-primary" id="dateBtn" @click="FillReferencesPlan()" style="background: #00ff11; margin: .5rem 0; padding: .5rem;">
          Remplir les dates
        </button>
      </div>

      <div style="width:100%; height:50px;"><!--space--></div>
    </div>
    <!-- **************************** -->

    <!-- {{-- PAPER Model 1 --}} -->
    <div class="paper" style="padding:.5rem; font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff;">

      <div class="container center">
        <h2 style="padding: 5px !important; margin:0;">Modèle 1</h2>
        <p>Fiche récapitulative des Actions de Formations et des Organismes de Formation leur correspondant</p>
      </div>

      <div class="container d-flex flex-nowrap" style="justify-content: space-between;">
        <input class="text-bold" style="width: 45%; text-align:end;" type="text" id="entrp" :value="curr_client ? curr_client : '--'" readonly>
        <input class="text-bold" style="width: 45%; text-align:initial;" type="text" id="year" :value="curr_annee ? curr_annee : '--'" readonly>
      </div>

      <div style="width:100%; height:15px;"><!--space--></div>

      <!-- {{-- FORMATIONS --}} -->
      <table>
        <thead style="text-align:left; font-size:14px;">
          <tr>
            <th style="width:10%">N° Action</th>
            <th style="width:35%">Thème de l'action</th>
            <th style="width:15%">Dates de réalisation</th>
            <th style="width:10%">Organismes de formation</th>
            <th style="width:10%">N° CNSS de l’organisme</th>
          </tr>
        </thead>

        <tbody id="tableFormation" class="center" v-if="actions_by_ref">
          <!-- {{-- auto filled --}} -->
          <tr v-for="(action, idx) in actions_by_ref" :key="`plan${idx}`">
            <td>
              {{action.n_action}}
            </td>
            <td>
              {{action.nom_theme}}
            </td>
            <td :id="action.n_form">
              {{ action.dates && DateFormat(action.dates.date1) || "" }}
              {{ action.dates && DateFormat(action.dates.date2) || "" }}
              {{ action.dates && DateFormat(action.dates.date3) || "" }}
              {{ action.dates && DateFormat(action.dates.date4) || "" }}
              {{ action.dates && DateFormat(action.dates.date5) || "" }}
              {{ action.dates && DateFormat(action.dates.date6) || "" }}
              {{ action.dates && DateFormat(action.dates.date7) || "" }}
              {{ action.dates && DateFormat(action.dates.date8) || "" }}
              {{ action.dates && DateFormat(action.dates.date9) || "" }}
              {{ action.dates && DateFormat(action.dates.date10) || "" }}
              {{ action.dates && DateFormat(action.dates.date11) || "" }}
              {{ action.dates && DateFormat(action.dates.date12) || "" }}
              {{ action.dates && DateFormat(action.dates.date13) || "" }}
              {{ action.dates && DateFormat(action.dates.date14) || "" }}
              {{ action.dates && DateFormat(action.dates.date15) || "" }}
              {{ action.dates && DateFormat(action.dates.date16) || "" }}
              {{ action.dates && DateFormat(action.dates.date17) || "" }}
              {{ action.dates && DateFormat(action.dates.date18) || "" }}
              {{ action.dates && DateFormat(action.dates.date19) || "" }}
              {{ action.dates && DateFormat(action.dates.date20) || "" }}
              {{ action.dates && DateFormat(action.dates.date21) || "" }}
              {{ action.dates && DateFormat(action.dates.date22) || "" }}
              {{ action.dates && DateFormat(action.dates.date23) || "" }}
              {{ action.dates && DateFormat(action.dates.date24) || "" }}
              {{ action.dates && DateFormat(action.dates.date25) || "" }}
              {{ action.dates && DateFormat(action.dates.date26) || "" }}
              {{ action.dates && DateFormat(action.dates.date27) || "" }}
              {{ action.dates && DateFormat(action.dates.date28) || "" }}
              {{ action.dates && DateFormat(action.dates.date29) || "" }}
              {{ action.dates && DateFormat(action.dates.date30) || "" }}
            </td>
            <td>
              {{action.organisme}}
            </td>
            <td>
              {{action.ncnss_cab}}
            </td>
          </tr>
        </tbody>
      </table>


    </div>
    <!-- {{-- END PAPER --}} -->

  </div>
  <!-- end-model1 -->


</template>
