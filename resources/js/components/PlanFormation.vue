<template>
  <div class="plan-formation">
    <div class="hide-from-print">
      <!-- {{-- PRINT - CANCEL --}} -->
      <print-button :backLink="'/'"></print-button>

      <div style="width: 100%">
        <label for="client">Entreprise :</label>
        <select
          name="client"
          id="client"
          style="width: 100%; padding: 0.5rem; border: 1px solid #000"
          v-on:change="FillReferencesPlan()"
          v-model="nrc_entrp"
        >
          <option selected disabled>--sélectionner l'Entreprise ..</option>
          <!-- @foreach ($client as $cl)
            <option value="{{$cl->nrc_entrp}}">{{$cl->raisoci}}</option>
          @endforeach -->
          <option
            v-for="cl in clients"
            :value="cl.nrc_entrp"
            :key="cl.nrc_entrp"
          >
            {{ cl.raisoci }}
          </option>
        </select>
      </div>
      <div style="width: 100%">
        <label for="plans">Réference plan de formation :</label>
        <select
          name="plans"
          id="plans"
          style="width: 100%; padding: 0.5rem; border: 1px solid #000"
          v-if="reference_plan && reference_plan.length"
          v-on:change="
            FillPlanByReference();
            ResetCoutTotalPlan();
          "
          v-model="id_plan"
        >
          <!-- {{-- auto filled --}} -->
          <option selected disabled>-- sélectionner le plan</option>
          <option
            v-for="pdf in reference_plan"
            :value="pdf.id_plan"
            :key="pdf.id_plan"
          >
            {{ pdf.refpdf }}
          </option>
        </select>
        <select
          name="plans"
          id="plans"
          style="width: 100%; padding: 0.5rem; border: 1px solid #000"
          v-else
        >
          <option>(vide)</option>
        </select>
      </div>

      <div class="btn-group">
        <button
          class="btn-btn-primary"
          id="dateBtn"
          v-on:click="FillReferencesPlan()"
          style="background: #00ff11; margin: 0.5rem 0; padding: 0.5rem"
        >
          Remplir les dates
        </button>
      </div>

      <div style="width: 100%; height: 50px"><!--space--></div>
    </div>
    <!-- **************************** -->

    <div
      class=""
      style="
        padding: 0.5rem;
        font-family: Calibri, 'Segoe UI', Geneva, Verdana, sans-serif;
        background-color: #fff;
        font-size: 13px;
      "
    >
      <div class="hide-from-print" style="width: 100%; height: 10px">
        <!--space-->
      </div>
      <table>
        <thead>
          <tr>
            <td style="width: 3%" class="td">N° Action</td>
            <td style="width: 10%" class="td">Domaine</td>
            <td style="width: 10%" class="td">Thème</td>
            <td style="width: 5%" class="td">Dates de réalisation</td>
            <td style="width: 5%" class="td">Organisme de formation</td>
            <td style="width: 5%" class="td">N° CNSS de l'organisme</td>
            <td style="width: 3%" class="td">Effectif</td>
            <td style="width: 3%" class="td">Cadres</td>
            <td style="width: 3%" class="td">Employés</td>
            <td style="width: 3%" class="td">Ouvriers</td>
            <td style="width: 3%" class="td">Durée par groupe</td>
            <td style="width: 10%" class="td">Lieu de formation</td>
            <td style="width: 3%" class="td">Nbre de groupe</td>
            <td style="width: 4%" class="td">Coût unitaire (DH)</td>
            <td style="width: 4%" class="td">Coût estimatif (DH)</td>
          </tr>
        </thead>

        <tbody id="tableActions" class="center" v-if="actions_by_ref">
          <!-- {{-- auto filled --}} -->
          <tr v-for="(action, idx) in actions_by_ref" :key="`plan${idx}`">
            <td v-if="action.type_action != 'annulé'">{{ action.n_action }}</td>
            <td v-if="action.type_action != 'annulé'">{{ action.nom_domain }}</td>
            <td v-if="action.type_action != 'annulé'">{{ action.nom_theme }}</td>
            <td v-if="action.type_action != 'annulé'" :id="action.n_form">
              {{ (action.dates && DateFormat(action.dates.date1)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date2)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date3)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date4)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date5)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date6)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date7)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date8)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date9)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date10)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date11)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date12)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date13)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date14)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date15)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date16)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date17)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date18)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date19)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date20)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date21)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date22)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date23)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date24)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date25)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date26)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date27)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date28)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date29)) || "" }}
              {{ (action.dates && DateFormat(action.dates.date30)) || "" }}
            </td>
            <td v-if="action.type_action != 'annulé'">{{ action.organisme }}</td>
            <td v-if="action.type_action != 'annulé'">{{ action.ncnss_cab }}</td>
            <td v-if="action.type_action != 'annulé'">{{ action.nb_partcp_total }}</td>
            <td v-if="action.type_action != 'annulé'">{{ action.nb_cadre }}</td>
            <td v-if="action.type_action != 'annulé'">{{ action.nb_employe }}</td>
            <td v-if="action.type_action != 'annulé'">{{ action.nb_ouvrier }}</td>
            <td v-if="action.type_action != 'annulé'">{{ action.nb_jour }}</td>
            <td v-if="action.type_action != 'annulé'">{{ action.lieu }}</td>
            <td v-if="action.type_action != 'annulé'">{{ action.nb_grp }}</td>
            <td v-if="action.type_action != 'annulé'">{{ action.bdg_jour }}</td>
            <td v-if="action.type_action != 'annulé'">{{ action.bdg_total * action.nb_grp }}</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
              <strong>
                {{ "Total " + coutTotalPlan }}
              </strong>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- {{-- END PAPER --}} -->
  </div>
</template>

<script>
import PrintButton from "./PrintButton.vue";
export default {
  components: {
    "print-button": PrintButton,
  },
  runtimeCompiler: true,
  name: "plan-formation",
  data() {
    return {
      clients: [],
      curr_client: null,
      curr_annee: null,
      coutTotalPlan: 0,
      nrc_entrp: undefined,
      id_plan: undefined,
      reference_plan: [],
      actions_by_ref: [],
      plan_formation: [],
      dates_actions: [],
      current_dates: null,
      isAllLoaded: false,

      //title of page
      title: {
        ref_plan: "",
      },
    };
  },

  //une fois le composant est monté
  mounted() {
    this.FillClients();
  },

  updated() {
    document.title = `AR - ${this.title.ref_plan}`;
  },

  computed: {},
  methods: {
    DateFormat(date) {
      if (date) {
        let datestring = date.replace(/[^\w\s]/gi, "");
        let year =
          datestring.charAt(0) +
          datestring.charAt(1) +
          datestring.charAt(2) +
          datestring.charAt(3);
        let month = datestring.charAt(4) + datestring.charAt(5);
        let day = datestring.charAt(6) + datestring.charAt(7);
        return day + "/" + month + "/" + year;
      } else {
        // console.error("date is", date)
      }
    },
    //async
    async FillClients() {
      this.coutTotalPlan = 0;
      await axios
        .get("/fill-clients")
        .then((res) => {
          this.clients = res.data;
          // console.log("clients : ", this.clients)
        })
        .catch((err) => console.error("err FillClients", err));
    },
    async FillReferencesPlan() {
      await axios
        .get(`/fill-reference-plan?nrcEntrp=${this.nrc_entrp}`)
        .then((res) => {
          this.reference_plan = res.data;
          this.curr_client = res.data[0].raisoci;
          console.log("reference_plan : ", this.reference_plan);
        })
        .catch((err) => console.log("err FillReferencesPlan", err));
    },
    async FillPlanByReference() {
      await axios
        .get(`/fill-plans-by-reference?idPlan=${this.id_plan}`)
        .then((res) => {
          this.actions_by_ref = res.data;
          this.curr_annee = res.data[0].annee;
          console.log("actions_by_ref : ", this.actions_by_ref);
          this.title.ref_plan = this.actions_by_ref[0].refpdf;
        })
        .then(() => {
          // fill dates action
          this.actions_by_ref.forEach((action) => {
            // calculer le cout estimatif
            if (action.type_action != "annulé") {
              this.coutTotalPlan += action.bdg_total * action.nb_grp;
              this.FillDates(action.n_form);
            }
          });
        })
        .catch((err) => console.error("err FillPlanByReference", err));
      this.isAllLoaded = true;
      console.log("isallloaded", this.isAllLoaded);
    },
    async FillDates(nform) {
      await axios
        .get(`/fill-dates-plan?nForm=${nform}`)
        .then((res) => {
          this.dates_actions = res.data;
        })
        .then(() => {
          this.AssignDates(nform);
        })
        .catch((err) => console.error("err FillDates", err));
    },
    async AssignDates(nform) {
      await this.actions_by_ref.forEach((action) => {
        if (action.n_form == nform) {
          this.dates_actions.forEach((forma) => {
            if (forma.n_form == nform) {
              Object.assign(action, { dates: {} });
              for (let i = 1; i < 30; i++) {
                //************************ vvv [dynamic key assignement] vvv */
                Object.assign(action.dates, {
                  [`date${i}`]: forma[`date${i}`],
                });
              }
            }
            console.log("assign dates action: ", action);
          });
        }
      });
    },
    ResetCoutTotalPlan() {
      this.coutTotalPlan = 0;
    },
  }, // methods
  computed: {}, // computed
};
</script>


