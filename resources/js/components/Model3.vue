<template>
  <div>
    <!-- BUTTON IMPRIMER/ANNULER -->
    <print-button :backLink="'/'"></print-button>
    <!-- LISTE DE CHOIX -->
    <div style="width: 100%" class="hide-from-print">
      <!-- SELECT ENTREPRISE -->
      <label class="hide-from-print" for="client">Entreprise :</label>
      <select
        class="hide-from-print"
        name="client"
        id="client"
        style="width: 100%; padding: 0.5rem; border: 1px solid #000"
        @change="
          handleAction('model3/FetchReferencesPlan', selected_nrc_entrp);
          handleAction('model3/SetNrcEntrp', selected_nrc_entrp);
        "
        v-model="selected_nrc_entrp"
      >
        <option selected disabled>--sélectionner l'Entreprise --</option>
        <option v-for="cl in clients" :value="cl.nrc_entrp" :key="cl.nrc_entrp">
          {{ cl.raisoci }}
        </option>
      </select>

      <!-- SELECT REF PLAN -->
      <div style="width: 100%" class="hide-from-print">
        <label for="plans">Réference plan de formation :</label>
        <select
          v-if="reference_plans && reference_plans.length"
          class="hide-from-print"
          name="plans"
          id="plans"
          style="width: 100%; padding: 0.5rem; border: 1px solid #000"
          @change="handleAction('model3/FetchActionByReference', id_plan)"
          v-model="id_plan"
        >
          <option selected disabled>-- sélectionner le plan</option>
          <option
            v-for="pdf in reference_plans"
            :value="pdf.id_plan"
            :key="pdf.id_plan"
          >
            {{ pdf.refpdf }}
          </option>
        </select>
        <!--  -->
        <select
          v-else
          name="plans"
          id="plans"
          style="width: 100%; padding: 0.5rem; border: 1px solid #000"
        >
          <option></option>
        </select>
      </div>

      <div class="hide-from-print" style="width: 100%">
        <label for="plans">Selectionner Thème de l’action :</label>
        <select
          name="actions"
          id="actions"
          style="width: 100%; padding: 0.5rem; border: 1px solid #000"
          @change="
            handleAction('model3/FetchInitialInfoAvisModif', nForm);
            handleAction('model3/FetchOldAvisInfo', nForm);
          "
          v-model="nForm"
        >
          <option selected disabled>-- Selectionner une action</option>
          <option
            v-for="action in actions_by_plan"
            :value="action.n_form"
            :key="action.nForm"
          >
            {{ action.nom_theme }}
          </option>
        </select>
      </div>

      <button
        class="hide-from-print"
        style="background-color: #eaeaea; padding: 0.5rem; margin-top: 10px"
        type="button"
        @click="
          handleAction('model3/GetSelectedTheme', nForm),
            CalculNbTotalBenif(),
            initialDates(),
            handleAction('model3/GetNomResponsable', selected_nrc_entrp)
        "
      >
        Remplir les informations
      </button>
    </div>

    <!-- PAPER -->
    <div class="paper">
      <div class="text-center">
        <h2>Modèle 3</h2>
        <div>{{duplicated_Info}}}</div>
        <h4 class="uppercase">MODELE D’AVIS D’ANNULATION OU DE MODIFICATION</h4>
      </div>
      <!-- TABLE -->
      <table style="background-color: #eaeaea">
        <tr>
          <th style="width: 30%" rowspan="6">Avis</th>
          <th style="width: 30%">Annulation</th>
          <th style="width: 30%" colspan="2">
            <strong v-if="this.duplicated_Info.typeAction === 'annulé'"
              >X</strong
            >
          </th>
        </tr>

        <tr>
          <th rowspan="5">Modification</th>
        </tr>

        <tr>
          <th style="width: 15%">De la date de Réalisation</th>
          <th>
            <strong v-if="this.duplicated_Info.dateDeRealisation">X</strong>
          </th>
        </tr>
        <tr>
          <th style="width: 15%">De l’organisme de formation</th>
          <th>
            <strong v-if="this.duplicated_Info.organismeDeFormation">X</strong>
          </th>
        </tr>
        <tr>
          <th style="width: 15%">De lieu de formation</th>
          <th>
            <strong v-if="this.duplicated_Info.lieuDeFormation">X</strong>
          </th>
        </tr>
        <tr>
          <th style="width: 15%">Organisation horaire</th>
          <th>
            <strong v-if="this.duplicated_Info.organisationHoraire">X</strong>
          </th>
        </tr>
      </table>

      <!-- END TABLE -->

      <!-- CONTENT -->
      <div style="padding-left: 20px">
        <div style="margin-top: 20px; display: inline-block; width: 100vw">
          <strong>Thème de l’action : </strong>
          <div v-for="(theme, i) in nom_theme" :key="i">
            <p id="selected_theme" style="width: calc(100vw - 25vw)">
              {{ !nom_theme ? "--" : theme.nom_theme }}
            </p>
          </div>
        </div>

        <!-- NATURE DE L'ACTION -->
        <div class="d-flex" style="margin-top: 20px">
          <strong>Nature de l’action :</strong>

          <div style="margin-left: 100px">
            <label>Planifiée</label>
            <input type="checkbox" checked />
          </div>
          <div style="margin-left: 100px">
            <label>Non Planifiée</label>
            <input type="checkbox" />
          </div>
          <div style="margin-left: 100px">
            <label>Alpha</label>
            <input type="checkbox" />
          </div>
        </div>
        <!-- END NATURE DE L'ACTION -->

        <!-- EFFECTIF -->
        <div style="margin-top: 20px">
          <strong>Effectif des participants :</strong>
          <input
            type="text"
            :value="total_benif"
            name="nb_partcp_total"
            id="nb_benif"
            disabled
          />
        </div>
        <!-- <h1>---------- {{mydata}}</h1> -->

        <!-- END EFFECTIF -->

        <!-- ORGANISME -->
        <div class="d-flex" style="margin-top: 10px">
          <strong>Organisme de formation initial : </strong>
          <input
            type="text"
            :value="duplicated_Info.initialOrganisme"
            disabled
          />
        </div>
        <div class="d-flex" style="margin-top: 10px">
          <strong>Nouvel Organisme de formation : </strong>
          <input
            type="text"
            :value="
              duplicated_Info.newOrganisme == duplicated_Info.initialOrganisme
                ? '--'
                : duplicated_Info.newOrganisme"
            disabled
          />
        </div>
        <!-- END ORGANISME -->

        <!-- LIEU -->
        <div class="d-flex" style="margin-top: 10px">
          <strong>Lieu de formation initial : </strong>
          <input
            type="text"
            style="width: 550px"
            :value="duplicated_Info.initialLieu"
            disabled
          />
        </div>
        <div class="d-flex" style="margin-top: 10px">
          <strong>Nouveau lieu : </strong>
          <input
            type="text"
            style="width: 550px"
            :value="
              duplicated_Info.newLieu == duplicated_Info.initialLieu
                ? '--'
                : duplicated_Info.newLieu
            "
            disabled
          />
        </div>
        <!-- END LIEU -->

        <!-- DATES -->
        <div style="margin-top: 10px" v-if="duplicated_Info.hasSameDates">
          <strong>Dates initiales de réalisation : </strong>
          <!-- <div v-if="duplicated_Info.dateDeRealisation">--</div> -->
          <div>
            <p
              style="
                display: flex !important;
                flex-wrap: nowrap !important;
                line-height: 1px;
              "
            >
              <span v-if="duplicated_Info.dates.date1"
                >{{ duplicated_Info.dates.date1 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date2"
                >{{ duplicated_Info.dates.date2 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date3"
                >{{ duplicated_Info.dates.date3 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date4"
                >{{ duplicated_Info.dates.date4 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date5"
                >{{ duplicated_Info.dates.date5 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date6"
                >{{ duplicated_Info.dates.date6 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date7"
                >{{ duplicated_Info.dates.date7 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date8"
                >{{ duplicated_Info.dates.date8 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date9"
                >{{ duplicated_Info.dates.date9 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date10"
                >{{
                  duplicated_Info.dates.date10 | moment("DD/MM/YYYY")
                }};</span
              >
            </p>
          </div>
        </div>
        <div style="margin-top: 10px" v-if="!duplicated_Info.hasSameDates">
          <strong>Dates initiales de réalisation : </strong>
          <!-- <div v-if="duplicated_Info.dateDeRealisation">--</div> -->
          <div>
            <div v-for="(initd, index) in initDates" :key="index">
              <p
                style="
                  display: flex !important;
                  flex-wrap: nowrap !important;
                  line-height: 1px;
                "
              >
                <span v-if="initd.old_date1"
                  >{{ initd.new_date1 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.old_date2"
                  >{{ initd.new_date2 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.old_date3"
                  >{{ initd.new_date3 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.old_date4"
                  >{{ initd.new_date4 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.old_date5"
                  >{{ initd.new_date5 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.old_date6"
                  >{{ initd.new_date6 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.old_date7"
                  >{{ initd.new_date7 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.old_date8"
                  >{{ initd.old_date8 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.old_date9"
                  >{{ initd.old_date9 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.old_date10"
                  >{{ initd.old_date10 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.date1"
                  >{{ initd.date1 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.date2"
                  >{{ initd.date2 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.date3"
                  >{{ initd.date3 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.date4"
                  >{{ initd.date4 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.date5"
                  >{{ initd.date5 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.date6"
                  >{{ initd.date6 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.date7"
                  >{{ initd.date7 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.date8"
                  >{{ initd.date8 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.date9"
                  >{{ initd.date9 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initd.date10"
                  >{{ initd.date10 | moment("DD/MM/YYYY") }};</span
                >
              </p>
            </div>
          </div>
        </div>
        <div style="margin-top: 10px" v-if="!duplicated_Info.hasSameDates">
          <strong>Nouvelles Dates exactes de réalisation : </strong>
          <div v-if="!duplicated_Info.dateDeRealisation">--</div>
          <div v-if="duplicated_Info.dateDeRealisation">
            <div
              class=""
              v-for="initinf in Info_AvisModif"
              :key="initinf.id_form"
            >
              <p
                style="
                  display: flex !important;
                  flex-wrap: nowrap !important;
                  line-height: 1px;
                "
              >
                <span v-if="initinf.date1"
                  >{{ initinf.date1 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initinf.date2"
                  >{{ initinf.date2 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initinf.date3"
                  >{{ initinf.date3 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initinf.date4"
                  >{{ initinf.date4 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initinf.date5"
                  >{{ initinf.date5 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initinf.date6"
                  >{{ initinf.date6 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initinf.date7"
                  >{{ initinf.date7 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initinf.date8"
                  >{{ initinf.date8 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initinf.date9"
                  >{{ initinf.date9 | moment("DD/MM/YYYY") }};</span
                >
                <span v-if="initinf.date10"
                  >{{ initinf.date10 | moment("DD/MM/YYYY") }};</span
                >
              </p>
            </div>
          </div>
        </div>
        <div style="margin-top: 10px" v-if="duplicated_Info.hasSameDates">
          <strong>Nouvelles Dates exactes de réalisation : </strong>
          <div v-if="!duplicated_Info.dateDeRealisation">--</div>
          <div v-if="duplicated_Info.dateDeRealisation">
            <p
              style="
                display: flex !important;
                flex-wrap: nowrap !important;
                line-height: 1px;
              "
            >
              <span v-if="duplicated_Info.dates.date1"
                >{{ duplicated_Info.dates.date1 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date2"
                >{{ duplicated_Info.dates.date2 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date3"
                >{{ duplicated_Info.dates.date3 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date4"
                >{{ duplicated_Info.dates.date4 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date5"
                >{{ duplicated_Info.dates.date5 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date6"
                >{{ duplicated_Info.dates.date6 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date7"
                >{{ duplicated_Info.dates.date7 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date8"
                >{{ duplicated_Info.dates.date8 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date9"
                >{{ duplicated_Info.dates.date9 | moment("DD/MM/YYYY") }};</span
              >
              <span v-if="duplicated_Info.dates.date10"
                >{{
                  duplicated_Info.dates.date10 | moment("DD/MM/YYYY")
                }};</span
              >
            </p>
          </div>
        </div>
        <!-- END DATES -->

        <!-- HORAIRE -->
        <div style="margin-top: 10px">
          <strong>Organisation horaire initiale :</strong>

          <div class="d-flex">
            <div>
              <span>heure début : </span>
              <input
                type="text"
                class=""
                :value="duplicated_Info.heurDebutInitial"
                disabled
              />
            </div>
            <div>
              <span>heure fin : </span>
              <input
                type="text"
                class=""
                :value="duplicated_Info.heurFinInitial"
                disabled
              />
            </div>
          </div>
          <div class="d-flix">
            <p v-if="this.duplicated_Info.old_pause">
              Avec pause déjeuner de : 1 heure
            </p>
          </div>
        </div>
        <div style="margin-top: 10px">
          <strong>Nouvelle organisation horaire :</strong>

          <div class="d-flex">
            <div>
              <span>heure début : </span>
              <input
                type="text"
                :value="duplicated_Info.heurDebutNew"
                disabled
              />
            </div>
            <div>
              <span>heure fin : </span>
              <input type="text" :value="duplicated_Info.heurFinNew" disabled />
            </div>
          </div>
          <div class="d-flix">
            <p v-if="this.duplicated_Info.pause">
              Avec pause déjeuner de : 1 heure
            </p>
          </div>
        </div>
        <!-- END HORAIRE -->

        <div style="margin-top: 50px">
          <strong
            >Nom du responsable :
            <span v-for="(resp, index) in nom_responsable" :key="index">{{
              nom_responsable == null ? "--" : resp.nom_resp
            }}</span></strong
          >
        </div>

        <div class="d-flex" style="margin-top: 50px">
          <strong style="margin-left: auto"
            >Cachet de l’entreprise, Signature et qualité du responsable</strong
          >
        </div>
      </div>
      <!-- END CONTENT -->
    </div>
    <!-- END PAPER -->
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
      nForm: null,
      nCabinet: null,
      id_plan: null,
      selected_nrc_entrp: null,
      total_benif: null,
      initDates: "",

      //Initial and new Info that Duplicated
      duplicated_Info: {
        initialOrganisme: "",
        newOrganisme: "",
        initialLieu: "",
        newLieu: "",
        heurPauseDebutInitial: "",
        heurPauseFinInitial: "",
        heurPauseDebutNew: "",
        heurFinNew: "",
        dateDeRealisation: false,
        organismeDeFormation: false,
        lieuDeFormation: false,
        organisationHoraire: false,
        typeAction: "",
        pause: false,
        old_pause: false,
        dates: {
          date1: "",
          date2: "",
          date3: "",
          date4: "",
          date5: "",
          date6: "",
          date7: "",
          date8: "",
          date9: "",
          date10: "",
        },
        hasSameDates: true,
      },
      title: {
        ref: "",
        theme: "",
      },
    };
  },

  updated() {},

  mounted() {
    this.$store.dispatch("model3/FetchClients");
  },

  computed: {
    ...mapState("model3", {
      curr_nrc_entrp: (state) => state.curr_nrc_entrp,
      clients: (state) => state.clients,
      reference_plans: (state) => state.reference_plans,
      actions_by_plan: (state) => state.actions_by_plan,
      curr_annee_plan: (state) => state.curr_annee_plan,
      cabinets: (state) => state.cabinets,
      Info_AvisModif: (state) => state.Info_AvisModif,
      Old_AvisModif: (state) => state.Old_AvisModif,
      nom_responsable: (state) => state.nom_responsable,
      nom_theme: (state) => state.nom_theme,
    }),
  },
  methods: {
    handleAction(actionName, value) {
      this.$store.dispatch(actionName, value);
    },

    initialDates() {
      this.initDates = this.$store.getters["model3/initialDates"];
    },

    CalculNbTotalBenif() {
      this.total_benif = this.$store.getters["model3/GetNbTotalBenif"];

      if (this.Info_AvisModif) {
        // Inserting duplicated Information in duplicated_Info object
        this.duplicated_Info.initialOrganisme =
          this.Old_AvisModif.length != 0
            ? this.Old_AvisModif[0].old_organisme
            : this.Info_AvisModif[0].organisme;
        this.duplicated_Info.initialLieu =
          this.Old_AvisModif != 0
            ? this.Old_AvisModif[0].old_lieu
            : this.Info_AvisModif[0].lieu;
        this.duplicated_Info.heurDebutInitial =
          this.Old_AvisModif != 0
            ? this.Old_AvisModif[0].old_hr_debut
            : this.Info_AvisModif[0].hr_debut;
        this.duplicated_Info.heurFinInitial =
          this.Old_AvisModif != 0
            ? this.Old_AvisModif[0].old_hr_fin
            : this.Info_AvisModif[0].hr_fin;
        this.duplicated_Info.old_pause =
          this.Old_AvisModif != 0 ? this.Old_AvisModif[0].old_pause : false;

        this.duplicated_Info.newOrganisme = this.Info_AvisModif[0].organisme;
        this.duplicated_Info.newLieu = this.Info_AvisModif[0].lieu;
        this.duplicated_Info.heurDebutNew = this.Info_AvisModif[0].hr_debut;
        this.duplicated_Info.heurFinNew = this.Info_AvisModif[0].hr_fin;

        this.duplicated_Info.dateDeRealisation =
          this.Info_AvisModif[0].date_realisation;
        this.duplicated_Info.organismeDeFormation =
          this.Info_AvisModif[0].organisme_formations;
        this.duplicated_Info.lieuDeFormation =
          this.Info_AvisModif[0].lieu_formations;
        this.duplicated_Info.organisationHoraire =
          this.Info_AvisModif[0].horaire_formations;
        this.duplicated_Info.typeAction = this.Info_AvisModif[0].type_action;
        this.duplicated_Info.pause = this.Info_AvisModif[0].pause;
        this.duplicated_Info.hasSameDates =
          this.Info_AvisModif[0].Has_Same_Dates;

        (this.duplicated_Info.dates.date1 = this.Info_AvisModif[0].date1),
          (this.duplicated_Info.dates.date2 = this.Info_AvisModif[0].date2),
          (this.duplicated_Info.dates.date3 = this.Info_AvisModif[0].date3),
          (this.duplicated_Info.dates.date4 = this.Info_AvisModif[0].date4),
          (this.duplicated_Info.dates.date5 = this.Info_AvisModif[0].date5),
          (this.duplicated_Info.dates.date6 = this.Info_AvisModif[0].date6),
          (this.duplicated_Info.dates.date7 = this.Info_AvisModif[0].date7),
          (this.duplicated_Info.dates.date8 = this.Info_AvisModif[0].date8),
          (this.duplicated_Info.dates.date9 = this.Info_AvisModif[0].date9),
          (this.duplicated_Info.dates.date10 = this.Info_AvisModif[0].date10);
      }

      //set title of model 3
      this.title.ref = this.actions_by_plan[0].refpdf;

      setTimeout(() => {
        this.title.theme =
          document.getElementById("selected_theme").textContent;
        document.title = `Avis.Modif - ${this.title.ref} - ${this.title.theme}`;
      }, 500);
    },
  },
};
</script>
