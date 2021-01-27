<script>
export default {
  runtimeCompiler: true,
  data() {
    return {
      clients: [],
      curr_client: null,
      curr_annee: null,
      nrc_entrp: undefined, id_plan: undefined,
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
          this.curr_annee = res.data[0].annee;
          console.log("reference_plan : ", this.reference_plan)
        })
        .catch((err) => console.log("err FillReferencesPlan", err));
    },
    async FillPlanByReference() {
      await axios.get(`/fill-plans-by-reference?idPlan=${this.id_plan}`)
        .then((res) => {
          this.actions_by_ref = res.data;
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
      console.log("isallloaded", this.isAllLoaded);
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
  <div class="att-reference-plan">
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
          v-if="reference_plan && reference_plan.length" v-on:change="FillPlanByReference()" v-model="id_plan">

          <!-- {{-- auto filled --}} -->
          <option selected disabled>-- sélectionner le plan</option>
          <option v-for="pdf in reference_plan" :value="pdf.id_plan" :key="pdf.id_plan">{{ pdf.refpdf }}</option>
        </select>
        <select name="plans" id="plans" style="width:100%; padding: .5rem; border: 1px solid #000;" v-else>
          <option>(vide)</option>
        </select>
      </div>

      <div class="btn-group">
        <button class="btn-btn-primary" id="dateBtn" v-on:click="FillReferencesPlan()" style="background: #00ff11; margin: .5rem 0; padding: .5rem;">
          Remplir les dates
        </button>
      </div>

      <div style="width:100%; height:50px;"><!--space--></div>
    </div>
      <!-- **************************** -->

    <!-- paper -->
    <div class="" style="padding:.5rem; font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff; font-size: 20px">

      <div class="container">
        <h3 class="text-center" style="text-decoration: underline; padding: 50px 0;">ATTESTATION DE REFERENCE</h3>
        <p style="text-align: justify; text-justify: initial; line-height: 1.7rem; font-weight: 300;">
          Nous soussignés,
          « <strong class="" id="entrp">(Entreprise)</strong> » ,
          <span id="entrpFormJury">(forme juridique entrp.)</span>
          au capital de
          <span class="" id="entrpCapital">(capital entrp.)</span> Dirhams,
          dont le siège est sis à
          <span class="" id="entrpSiege">(siège entreprise)</span>
          représentée par Son
          <span class="" id="entrpDgFonction">(fonction directeur entrp.)</span>
          <select class="select highlighted" style="font-size: 18px;">
            <option value="">M.</option>
            <option value="">Mme.</option>
          </select>
          <span class="" id="entrpDgNom">(nom directeur entrp.)</span>,

          attestons par la présente que le Cabinet
          <select id="cabinet" class="select text-bold highlighted" style="font-size: 18px;">
            ...
          </select>,
          <span class="" id="cabinetFormJury">
            ...
          </span>
          au capital de
          <span class="" id="cabinetCapital">
            ...
          </span> Dirhams,
          inscrit au registre de commerce de Casablanca sous le numéro
          <span class="" id="cabinetRC">...</span>
          et inscrit à la CNSS sous le numéro
          <span class="" id="cabinetCnss">...</span>,
          dont le siège social est sis au
          <span class="" id="cabinetAdress">...</span>

          a réalisé pour le compte de notre société au titre de l’année
          <span class="" id="anneeMiss">(année mission)</span>,
          d’un budget de
          <strong class="" id="montantMiss">(montant HT mission)</strong>
          <strong> Dirhams</strong>
          sur
          <span class="" id="jourMiss">(nb. jour mission)</span> jours de formation.
        </p>

        <p style="text-align: justify; text-justify: initial; line-height: 1.7rem; font-weight: 300; padding: 40px 0px 10px 0px;">
          L’ensemble des séminaires ayant été assurés se présentent comme suit :
        </p>

        <p style="text-align: justify; text-justify: initial; line-height: 1.7rem; font-weight: 300; padding: 40px 0px 10px 0px;">
          Le cabinet conseil <strong id="cabinet_2">...</strong> a répondu à nos attentes et a donné entière satisfaction.
        </p>

        <p style="text-align: justify; text-justify: initial; line-height: 1.7rem; font-weight: 300;">
          La présente attestation est établie pour servir et valoir ce que de droit.
        </p>

        <div id="footer" class="container" style="position:fixed !important; bottom:0; width:100%; padding-bottom:150px;">
          <p style="margin: 20px; margin-left: 50%">
            Fait à Casablanca le
            <input type="date" name="" id="lastDate" style="width: 50%; font-size: 17px;" />

            <div class="text-center" style="margin: 20px; margin-left: 50%;">
              <select class="select highlighted" style="font-size: 18px;">
                <option value="">M.</option>
                <option value="">Mme.</option>
              </select>
              <span id="entrpDgNom2">(.......)</span>
              <p style="display: block;" id="entrpDgFonction2">(.......)</p>
            </div>

        </div>

      </div>

    </div>
    <!-- END PAPER -->
  </div>


</template>
