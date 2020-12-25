
<script>
export default {
  runtimeCompiler: true,
  data() {
    return {
      clients: [],
      nrc_entrp: undefined, id_plan: undefined,
      reference_plan: [],
      actions_by_ref: [],
      plan_formation: [],
      dates_actions: [],
      isAllLoaded: false,
    }
  },
  mounted() {
    this.FillClients();
  },
  methods: {
    async FillClients() {
      await axios.get('/fill-clients')
        .then((res) => {
          this.clients = res.data;
          // console.log("clients : ", this.clients)
        })
        .catch((err) => console.error("err FillClients", err));
    },
    async FillReferencesPlan(e) {
      await axios.get(`/fill-reference-plan?nrcEntrp=${this.nrc_entrp}`)
        .then((res) => {
          this.reference_plan = res.data;
          // console.log("reference_plan : ", this.reference_plan)
        })
        .catch((err) => console.log("err FillReferencesPlan", err));
    },
    async FillPlanByReference() {
      await axios.get(`/fill-plans-by-reference?idPlan=${this.id_plan}`)
        .then((res) => {
          this.actions_by_ref = res.data;
          console.log("actions_by_ref : ", this.actions_by_ref)
          // fill dates action
          this.actions_by_ref.forEach((action) => {
            this.FillDates(action.n_form);
          });
        })
        .catch((err) => console.error("err FillPlanByReference", err));
      this.isAllLoaded = true;
      console.log("isallloaded", this.isAllLoaded);
      // await this.AssignDates();
    },
    async FillDates(nform) {
      await axios.get(`/fill-dates-plan?nForm=${nform}`)
        .then((res) => {
          this.dates_actions = res.data;
        })
        .catch((err) => console.error("err FillDates", err));
    },
    async AssignDates(nForm) {
      var fillDates = "";
      await this.dates_actions.forEach(forma => {
        if (forma.n_form == nForm) {
          fillDates += `<span>${forma.n_form}</span><br />`;
          for (let i = 1; i < 30; i++) {
            let date_index = `date${i}`;
            if (forma[date_index])
              fillDates += `<span>${DateFormat(forma[date_index])}</span><br />`;
          }
        }
        document.getElementById(nForm).innerHTML += fillDates;
      });
    }
  } // methods
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
        <input class="text-bold" style="width: 45%; text-align:end;" type="text" name="entrp" id="entrp" value="..." readonly>
        <input class="text-bold" style="width: 45%; text-align:initial;" type="text" name="year" id="year" value="annee.." readonly>
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

        <tbody id="tableFormation" class="center">
          <!-- {{-- auto filled --}} -->
          <tr v-for="(action, idx) in actions_by_ref" :key="'plan'+idx">
            <td>
              {{action.n_action}}
            </td>
            <td>
              {{action.nom_theme}}
            </td>
            <td :id="action.n_form">
              <!-- <span v-for="(forma, idx) in dates_actions" :key="`forma${idx}`">
                <span v-if="action.n_form == forma.n_form">
                  <span v-for="item in items" :key="item.id">
                    {{ item }}
                  </span>
                </span>
              </span> -->
              <!-- {{ AssignDates(action.n_form) }} -->
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
