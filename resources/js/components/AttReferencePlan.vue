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
    <div class="paper" style="padding:.5rem; font-family:Calibri, 'Segoe UI', Geneva, Verdana, sans-serif; background-color: #fff; font-size: 20px">

      <div class="container">
        <h3 class="text-center" style="text-decoration: underline; padding: 40px 0;">ATTESTATION DE REFERENCE</h3>
        <div style="text-align: justify; text-justify: initial; font-weight: 300;">
          Nous soussignés,
          « <strong class="highlighted-danger" id="entrp">{{ curr_client_raisoci || '(Entreprise)' }}</strong> »,

          <span class="highlighted-danger" id="entrpFormJury">
            {{ curr_client_formjury || '(forme juridique entrp.)' }}
          </span>

          au capital de
          <span class="highlighted-danger" id="entrpCapital">
            {{ curr_client_capt_soci || '(capital entrp.)' }}
          </span> Dirhams,

          dont le siège est sis à
          <span class="highlighted-danger" id="entrpSiege">
            {{ curr_client_sg_soci || '(siège entreprise)' }}
          </span>

          représentée par Son
          <span class="highlighted-danger" id="entrpDgFonction">
            {{ curr_client_fonct_dg1 || '(fonction directeur entrp.)' }}
          </span>

          <select class="select highlighted" style="font-size: 16px;">
            <option value="">M.</option>
            <option value="">Mme.</option>
          </select>

          <span class="highlighted-danger" id="entrpDgNom">
            {{ curr_client_nom_dg1 || '(nom directeur entrp.)' }}
          </span>,

          attestons par la présente que le Cabinet
          <span id="cabinet" class="select text-bold highlighted-danger" style="font-size: 18px;" >
            {{ curr_cabinet_raisoci || '(organisme)' }}
          </span>,

          <span class="highlighted-danger" id="cabinetFormJury">
            {{ curr_cabinet_formjury || '(organisme forme jury)' }}
          </span>

          au capital de
          <span class="highlighted-danger" id="cabinetCapital">
            {{ curr_cabinet_capt_soci || '(capital organisme)' }}
          </span> Dirhams,

          inscrit au registre de commerce de
          <span>
            {{ curr_client_ville || '(ville)' }}
          </span> sous le numéro
          <span class="highlighted-danger" id="cabinetRC">
            {{ curr_cabinet_nrc || '(RC organisme)' }}
          </span>

          et inscrit à la CNSS sous le numéro
          <span class="highlighted-danger" id="cabinetCnss">
            {{ curr_cabinet_ncnss || '(CNSS organisme)' }}
          </span>,

          dont le siège social est sis au
          <span class="highlighted-danger">
            {{ curr_cabinet_adress || '(adresse organisme)' }}
          </span>

          a réalisé pour le compte de notre société au titre de l’année
          <span class="highlighted-danger" id="anneeMiss">
            {{ curr_annee || '(année)' }}
          </span>,

          d’un budget de
          <strong class="highlighted-danger">
            {{ curr_bdg_total + ' Dirhams' || '(bdg total plan)' }}
          </strong>
          sur
          <span class="highlighted-danger" id="jourMiss">
            {{ curr_nb_jour || '(nb jours)' }}
          </span> jours de formation.
        </div>


        <p style="text-align: justify; text-justify: initial; font-weight: 300;">
          L’ensemble des séminaires ayant été assurés se présentent comme suit :
        </p>

        <!-- {{-- FORMATIONS --}} -->
        <table>
          <thead style="text-align:left;">
            <tr>
              <th style="width:50%">Thème</th>
              <th style="width:30%">Dates</th>
              <th style="width:20%">Nombre de jours</th>
            </tr>
          </thead>

          <tbody id="tableFormation" class="center" v-if="actions_by_ref">
            <!-- {{-- auto filled --}} -->
            <tr v-for="(action, idx) in actions_by_ref" :key="`plan${idx}`">
              <td>
                {{action.nom_theme}}
              </td>
              <td :id="action.n_form">
                <!-- <span v-if="action.dates && action.dates.date1" style="display: block">{{ action.dates && DateFormat(action.dates.date1) || "" }} </span>
                <span v-if="action.dates && action.dates.date2" style="display: block">{{ action.dates && DateFormat(action.dates.date2) || "" }} </span>
                <span v-if="action.dates && action.dates.date3" style="display: block">{{ action.dates && DateFormat(action.dates.date3) || "" }} </span>
                <span v-if="action.dates && action.dates.date4" style="display: block">{{ action.dates && DateFormat(action.dates.date4) || "" }} </span>
                <span v-if="action.dates && action.dates.date5" style="display: block">{{ action.dates && DateFormat(action.dates.date5) || "" }} </span>
                <span v-if="action.dates && action.dates.date6" style="display: block">{{ action.dates && DateFormat(action.dates.date6) || "" }} </span>
                <span v-if="action.dates && action.dates.date7" style="display: block">{{ action.dates && DateFormat(action.dates.date7) || "" }} </span>
                <span v-if="action.dates && action.dates.date8" style="display: block">{{ action.dates && DateFormat(action.dates.date8) || "" }} </span>
                <span v-if="action.dates && action.dates.date9" style="display: block">{{ action.dates && DateFormat(action.dates.date9) || "" }} </span>
                <span v-if="action.dates && action.dates.date10" style="display: block">{{ action.dates && DateFormat(action.dates.date10) || "" }} </span>
                <span v-if="action.dates && action.dates.date11" style="display: block">{{ action.dates && DateFormat(action.dates.date11) || "" }} </span>
                <span v-if="action.dates && action.dates.date12" style="display: block">{{ action.dates && DateFormat(action.dates.date12) || "" }} </span>
                <span v-if="action.dates && action.dates.date13" style="display: block">{{ action.dates && DateFormat(action.dates.date13) || "" }} </span>
                <span v-if="action.dates && action.dates.date14" style="display: block">{{ action.dates && DateFormat(action.dates.date14) || "" }} </span>
                <span v-if="action.dates && action.dates.date15" style="display: block">{{ action.dates && DateFormat(action.dates.date15) || "" }} </span>
                <span v-if="action.dates && action.dates.date16" style="display: block">{{ action.dates && DateFormat(action.dates.date16) || "" }} </span>
                <span v-if="action.dates && action.dates.date17" style="display: block">{{ action.dates && DateFormat(action.dates.date17) || "" }} </span>
                <span v-if="action.dates && action.dates.date18" style="display: block">{{ action.dates && DateFormat(action.dates.date18) || "" }} </span>
                <span v-if="action.dates && action.dates.date19" style="display: block">{{ action.dates && DateFormat(action.dates.date19) || "" }} </span>
                <span v-if="action.dates && action.dates.date20" style="display: block">{{ action.dates && DateFormat(action.dates.date20) || "" }} </span>
                <span v-if="action.dates && action.dates.date21" style="display: block">{{ action.dates && DateFormat(action.dates.date21) || "" }} </span>
                <span v-if="action.dates && action.dates.date22" style="display: block">{{ action.dates && DateFormat(action.dates.date22) || "" }} </span>
                <span v-if="action.dates && action.dates.date23" style="display: block">{{ action.dates && DateFormat(action.dates.date23) || "" }} </span>
                <span v-if="action.dates && action.dates.date24" style="display: block">{{ action.dates && DateFormat(action.dates.date24) || "" }} </span>
                <span v-if="action.dates && action.dates.date25" style="display: block">{{ action.dates && DateFormat(action.dates.date25) || "" }} </span>
                <span v-if="action.dates && action.dates.date26" style="display: block">{{ action.dates && DateFormat(action.dates.date26) || "" }} </span>
                <span v-if="action.dates && action.dates.date27" style="display: block">{{ action.dates && DateFormat(action.dates.date27) || "" }} </span>
                <span v-if="action.dates && action.dates.date28" style="display: block">{{ action.dates && DateFormat(action.dates.date28) || "" }} </span>
                <span v-if="action.dates && action.dates.date29" style="display: block">{{ action.dates && DateFormat(action.dates.date29) || "" }} </span>
                <span v-if="action.dates && action.dates.date30" style="display: block">{{ action.dates && DateFormat(action.dates.date30) || "" }} </span> -->
                De {{ action.dates && action.dates.date_debut }} à {{ action.dates && action.dates.date_fin }}
              </td>
              <td>
                {{action.nb_jour}}
              </td>
            </tr>
          </tbody>
        </table>

        <p style="text-align: justify; text-justify: initial; line-height: 1.7rem; font-weight: 300; margin-top: 50px">
          Le cabinet conseil
          <strong id="cabinet_2">
            {{ curr_cabinet_raisoci || '(organisme)' }}
          </strong> a répondu à nos attentes et a donné entière satisfaction.
        </p>

        <p style="text-align: justify; text-justify: initial; line-height: 1.7rem; font-weight: 300;">
          La présente attestation est établie pour servir et valoir ce que de droit.
        </p>


        <div id="footer" class="container" style="position:fixed !important; bottom:0; width:100%; padding-bottom:20px;">
          <p style="margin: 20px; margin-left: 50%">
            Fait à
            <span>
              {{ curr_client_ville || '(ville)' }}
            </span> le
            <input type="date" name="" id="lastDate" style="width: 45%; font-size: 17px;" />

            <!-- DIRECTEUR ET FONCTION -->
            <!-- <div class="text-center" style="margin: 20px; margin-left: 50%;">
              <select class="select highlighted" style="font-size: 16px;">
                <option value="">M.</option>
                <option value="">Mme.</option>
              </select>
              <span class="highlighted-danger" id="entrpDgNom2">
                {{ curr_client_nom_dg1 || '(nom dg)' }}
              </span>
              <p class="highlighted-danger" style="display: block;" id="entrpDgFonction2">
                {{ curr_client_fonct_dg1 || '(nom dg)' }}
              </p>
            </div> -->

            <!-- DIRECTION ET ENTREPRISE -->
            <div class="text-center" style="margin: 20px; margin-left: 50%;">
              <span class="select highlighted" style="font-size: 16px;">
                Direction
              </span>
              <p class="highlighted-danger" style="display: block;">
                {{ curr_client_raisoci || '(entreprise)' }}
              </p>
            </div>

        </div>

      </div>

    </div>
    <!-- END PAPER -->
  </div>


</template>

<script>
export default {
  runtimeCompiler: true,
  data() {
    return {
      // clients data
      clients: [],
      nrc_entrp: undefined,
      curr_client: null,
      curr_client_raisoci: null,
      curr_client_nrc: null,
      curr_client_formjury: null,
      curr_client_capt_soci: null,
      curr_client_sg_soci: null,
      curr_client_ville: null,
      curr_client_fonct_dg1: null,
      curr_client_nom_dg1: null,

      // cabinet data
      curr_cabinet_nrc: null,
      curr_cabinet_raisoci: null,
      curr_cabinet_capt_soci: null,
      curr_cabinet_formjury: null,
      curr_cabinet_ncnss: null,
      curr_cabinet_adress: null,
      curr_cabinet_ville: null,

      // plan data
      id_plan: undefined,
      curr_annee: null,
      curr_nb_jour: null,
      curr_bdg_total: 0,
      reference_plan: [],
      actions_by_ref: [],
      plan_formation: [],
      dates_actions: [],
      current_dates: null,
      isAllLoaded: false,

      //title of page
      title: {
        ref_plan: '',
      },
    }
  },
  mounted() {
    this.FillClients();
  },

  updated() {
     document.title = `AR - ${this.title.ref_plan}`
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
      this.ChangeFontSize();
      console.log('nrc_entrp', this.nrc_entrp)
      await axios.get(`/fill-reference-plan?nrcEntrp=${this.nrc_entrp}`)
        .then((res) => {
          this.reference_plan = res.data;
          this.curr_client_nrc = this.clients.nrc_entrp;
          this.curr_client_capt_soci = res.data[0].capt_soci;
          this.curr_client_ville = res.data[0].ville;
          this.curr_client_raisoci = res.data[0].raisoci.toUpperCase();
          this.curr_client_formjury = res.data[0].formjury;
          this.curr_client_sg_soci = res.data[0].sg_soci;
          this.curr_client_fonct_dg1 = res.data[0].fonct_dg1;
          this.curr_client_nom_dg1 = res.data[0].nom_dg1;

          console.log("reference_plan : ", this.reference_plan)
        })
        .catch((err) => console.log("err FillReferencesPlan", err));
    },
    async FillPlanByReference() {
      await this.ResetAll();
      await axios.get(`/fill-plans-by-reference?idPlan=${this.id_plan}`)
        .then((res) => {
          this.actions_by_ref = res.data;
          this.curr_annee = res.data[0].annee;
          this.curr_cabinet_raisoci = res.data[0].organisme;
          this.FillCabinetInfo();
          console.log("actions_by_ref : ", this.actions_by_ref)
          this.title.ref_plan = this.actions_by_ref[0].refpdf
        })
        .then(() => {
          // fill dates action
          this.actions_by_ref.forEach((action) => {
            // affecter les dates de chaque formation
            this.FillDates(action.n_form);
            // calculer le budget total
            this.curr_bdg_total += (action.bdg_total * action.nb_grp);
            this.curr_nb_jour += action.nb_jour;
          });
        })
        .catch((err) => console.error("err FillPlanByReference", err));
      this.isAllLoaded = true;
      console.log("isallloaded", this.isAllLoaded);
    },
    async FillCabinetInfo() {
      await axios.get(`/fill-cabinet-info?raisociCab=${this.curr_cabinet_raisoci}`)
        .then((res) => {
          this.curr_cabinet_nrc = res.data.nrc_cab;
          this.curr_cabinet_raisoci = res.data.raisoci.toUpperCase();
          this.curr_cabinet_capt_soci = res.data.cap_soci;
          this.curr_cabinet_formjury = res.data.formjury;
          this.curr_cabinet_ncnss = res.data.ncnss;
          this.curr_cabinet_adress = res.data.adress;
          this.curr_cabinet_ville = res.data.ville;
          console.log('cabinet :', res.data);
        })
        .catch((err) => console.error("err FillCabinetInfo", err));
    },
    async FillDates(nform) {
      await axios.get(`/fill-dates-plan?nForm=${nform}`)
        .then((res) => {
          this.dates_actions = res.data;
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
                if (i == 1) {
                  Object.assign(action.dates, { [`date_debut`]: this.DateFormat(forma[`date${i}`]) });
                  console.log("date_debut", action.dates.date_debut);
                }
                if (forma[`date${i}`]) {
                  Object.assign(action.dates, { [`date_fin`]: this.DateFormat(forma[`date${i}`]) });
                  console.log("date_fin", action.dates.date_fin);
                }
              }
            }
            console.log("assign dates action: ", action);
          });
        }
      });
    },
    async ResetAll() {
      // rétablir bdg total à 0
      this.curr_bdg_total = this.curr_nb_jour = 0;
    },
    ChangeFontSize() {
      if (this.actions_by_ref.length <= 3) {
        document.querySelector('.paper').setAttribute('style', 'font-size: 18px; line-height: 2rem; font-family: \'Arial\', sans-serif;');
      }
      else if (this.actions_by_ref.length <= 5) {
        document.querySelector('.paper').setAttribute('style', 'font-size: 16px; line-height: 2rem; font-family: \'Arial\', sans-serif;');
      } else {
        document.querySelector('.paper').setAttribute('style', 'font-size: 15.5px; line-height: initial; font-family: \'Arial\', sans-serif;');
      }
    }
  }, // methods
  computed: {
  } // computed
}
</script>

