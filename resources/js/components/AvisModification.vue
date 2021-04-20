<template>
  <div class="card card-dark">
    <!-- card-header -->
    <div class="card-header">
      <h3 class="card-title">Annuler ou modifier l'état d'avis</h3>
    </div>
    <br />
    <form role="form" action="#" method="POST">
      <div class="card-body">
        <div class="row">
          <div class="form-group col-lg-6 col-sm-12">
            <label>Entreprise</label>
            <select
              class="form-control"
              id="client"
              name="client"
              @change="
                handleAction('model3/FetchReferencesPlan', infosAvisModif.selected_nrc_entrp);
                handleAction('model3/SetNrcEntrp', infosAvisModif.selected_nrc_entrp);
              "
              v-model="infosAvisModif.selected_nrc_entrp"
            >
              <option selected disabled>---selectionner l'entreprise---</option>
              <option
                v-for="cl in clients"
                :value="cl.nrc_entrp"
                :key="cl.nrc_entrp"
              >
                {{ cl.raisoci }}
              </option>
            </select>
          </div>

          <div class="form-group col-lg-6 col-sm-12">
            <label>Réference plan de formation </label>
            <select
              class="form-control"
              name="plans"
              id="plans"
              @change="handleAction('model3/FetchActionByReference', infosAvisModif.id_plan)"
              v-model="infosAvisModif.id_plan"
            >
              <option selected disabled>---selectionner le plan---</option>
              <option
                v-for="pdf in reference_plans"
                :value="pdf.id_plan"
                :key="pdf.id_plan"
              >
                {{ pdf.refpdf }}
              </option>
            </select>
          </div>

          <div class="form-group col-lg-6 col-sm-12">
            <label>État d'avis</label>
            <select
              class="form-control"
              id="etat"
              @change="
                getSelected();
                getDisabled();
              "
              v-model="infosAvisModif.type_action"
            >
              <option selected disabled>---selectionner l'état---</option>
              <option value="annulation">Annulation</option>
              <option value="modification">Modification</option>
            </select>
          </div>

          <table
            class="table table-striped col-12 col-lg-11 border"
            style="margin: 16px"
          >
            <thead>
              <tr>
                <th style="width: 10%" rowspan="6">Avis</th>
                <th style="width: 10%">Anulation</th>
                <th style="width: 10%" colspan="2">
                  <input name="annuler" :value="true" v-model="infosAvisModif.selected_input_annuler" type="checkbox" id="annuler" />
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th rowspan="5">Modification</th>
              </tr>
              <tr>
                <th style="width: 5%">De la date de Réalisation</th>
                <th><input type="checkbox" name="modif" id="modif_date" v-model="infosAvisModif.date_realisation"/></th>
              </tr>
              <tr>
                <th style="width: 5%">De l’organisme de formation</th>
                <th><input type="checkbox" name="modif" id="modif_organ" v-model="infosAvisModif.organisme_formations"/></th>
              </tr>
              <tr>
                <th style="width: 5%">De lieu de formation</th>
                <th><input type="checkbox" name="modif" id="modif_lieu" v-model="infosAvisModif.lieu_formations"/></th>
              </tr>
              <tr>
                <th style="width: 5%">Organisation horaire</th>
                <th>
                  <input type="checkbox" name="modif" id="modif_horaire" v-model="infosAvisModif.horaire_formations"/>
                </th>
              </tr>
            </tbody>
          </table>

          <div class="form-group col-lg-6 col-sm-12">
            <label>Thème de l’action</label>
            <select
              class="form-control"
              @change="
                handleAction('model3/FetchInitialInfoAvisModif', infosAvisModif.selected_nForm)
              "
              v-model="infosAvisModif.selected_nForm"
            >
              <option selected disabled>---selectionner le thème---</option>
              <option
                v-for="action in actions_by_plan"
                :value="action.n_form"
                :key="action.n_form"
              >
                {{ action.nom_theme }}
              </option>
            </select>
          </div>

          <div class="form-group col-lg-6 col-sm-12">
            <label>Nature de l'action</label>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input
                  type="checkbox"
                  name="planifie"
                  id="planifie"
                  class="custom-control-input"
                  v-model="infosAvisModif.nature_action"
                  checked
                />
                <label for="planifie" class="custom-control-label"
                  >Planifié</label
                >
              </div>
              <div class="custom-control custom-checkbox">
                <input
                  type="checkbox"
                  name="nonplanifie"
                  id="nonplanifie"
                  class="custom-control-input"
                />
                <label for="nonplanifie" class="custom-control-label"
                  >Non planifié</label
                >
              </div>
              <div class="custom-control custom-checkbox">
                <input
                  type="checkbox"
                  name="alpha"
                  id="alpha"
                  class="custom-control-input"
                />
                <label for="alpha" class="custom-control-label">Alpha</label>
              </div>
            </div>
          </div>

          <div
            class="cole-12 container p-lg-4 mt-3"
            style="background-color: #efefef"
            v-for="(info, index) in Info_AvisModif"
            :key="index"
          >
            <h3>
              <strong>Groupe {{ index + 1 }}</strong>
            </h3>
            <div class="row my-3">
              <div class="form-group col-lg-6 col-sm-12">
                <label>Organisme de formation initial</label>
                <input
                  type="text"
                  class="form-control"
                  :value="info.organisme"
                  :v-model="info.organisme == infosAvisModif.organisme"
                />
                <h1>organisme. {{infosAvisModif.organisme}}</h1>
              </div>
              <div class="form-group col-lg-6 col-sm-12">
                <label>Lieu de formation initial </label>
                <input
                  type="text"
                  class="form-control"
                  :value="Info_AvisModif.length != 0 ? info.lieu : ''"
                  :v-model="infosAvisModif.lieu"
                />
              </div>

               <div class="form-group col-lg-6 col-sm-12">
            <label>Nouvel Organisme de formation</label>
            <select class="form-control" v-model="selectedCabinet">
              <option selected disabled>---selectionner l'organisme---</option>
              <option
                v-for="cabinet in cabinets"
                :value="selectedCabinet == false ? info.organisme: cabinet.raisoci"
                :key="cabinet.nrc_cab"
                :v-model="infosAvisModif.new_organisme"
              >
                {{ cabinet.raisoci }}
              </option>
            </select>
                <h1>organisme. {{ infosAvisModif.new_organisme }}</h1>

          </div>
          <div class="form-group col-lg-6 col-sm-12">
            <label>Nouveau lieu</label>
            <select class="form-control" name="lieu" id="lieu"  v-model="selectedFormationLieu">
              <option selected disabled>---selectionner le lieu---</option>
              <option
                v-for="cl in clients"
                :value="selectedFormationLieu == false ? info.lieu : cl.raisoci"
                :key="cl.nrc_entrp"
                :v-model="infosAvisModif.new_lieu"
              >
                {{ cl.raisoci }}
              </option>
            </select>
          </div>
            </div>
            <div class="row">
              <!-- {{-- LES DATES INITIALES --}} -->
              <div class="form-group col-lg-12 col-sm-12 mb-0">
                <label>Dates initiales de réalisation </label>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12" v-if="info.date1">
                <input class="form-control" type="date" :value="info.date1" :v-model="infosAvisModif.date1"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12" v-if="info.date2">
                <input class="form-control" type="date" :value="info.date2" :v-model="infosAvisModif.date2"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12" v-if="info.date3">
                <input class="form-control" type="date" :value="info.date3" :v-model="infosAvisModif.date3"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12" v-if="info.date4">
                <input class="form-control" type="date" :value="info.date4" :v-model="infosAvisModif.date4"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12" v-if="info.date5">
                <input class="form-control" type="date" :value="info.date5" :v-model="infosAvisModif.date5"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12" v-if="info.date6">
                <input class="form-control" type="date" :value="info.date6" :v-model="infosAvisModif.date6"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12" v-if="info.date7">
                <input class="form-control" type="date" :value="info.date7" :v-model="infosAvisModif.date7"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12" v-if="info.date8">
                <input class="form-control" type="date" :value="info.date8" :v-model="infosAvisModif.date8"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12" v-if="info.date9">
                <input class="form-control" type="date" :value="info.date9" :v-model="infosAvisModif.date9"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12" v-if="info.date10">
                <input class="form-control" type="date" :value="info.date10" :v-model="infosAvisModif.date10"/>
              </div>

              <!-- {{-- LES NOUVELLES DATES --}} -->
              <div class="form-group col-lg-12 col-sm-12 mb-0">
                <label>Nouvelles Dates exactes de réalisation </label>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" :value="info.date1" :v-model="infosAvisModif.new_date1"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" :value="info.date2" :v-model="infosAvisModif.new_date2"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" :value="info.date3" :v-model="infosAvisModif.new_date3"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" :value="info.date4" :v-model="infosAvisModif.new_date4"/>
              </div>

               <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" :value="info.date5" :v-model="infosAvisModif.new_date5"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" :value="info.date6" :v-model="infosAvisModif.new_date6"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" :value="info.date7" :v-model="infosAvisModif.new_date7"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" :value="info.date8" :v-model="infosAvisModif.new_date8"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" :value="info.date9" :v-model="infosAvisModif.new_date9"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" :value="info.date10" :v-model="infosAvisModif.new_date10"/>
              </div>
            </div>

            <!-- {{-- L'HORAIRE INITIALE --}} -->
            <div class="row mt-3">
              <div class="form-group col-lg-12 col-sm-12 mb-0">
                <label>Organisation horaire initiale </label>
              </div>

              <div class="form-group col-lg-6 col-sm-12">
                <label>Heure début</label>
                <div class="input-group date" id="datetimepicker3">
                  <input class="form-control" type="time" name="hr_debut"
                  :value="info.hr_debut"
                  :v-model="infosAvisModif.hr_debut"
                  />
                  <div
                    class="input-group-append"
                    data-target="#timepicker"
                    data-toggle="datetimepicker"
                  ></div>
                  <div class="input-group-text">
                    <i class="far fa-clock"></i>
                  </div>
                </div>
              </div>

              <div class="form-group col-lg-6 col-sm-12">
                <label>Heure fin</label>
                <div class="input-group date" id="datetimepicker3">
                  <input
                    class="form-control timerpicker"
                    type="time"
                    name="hr_fin"
                    :value="info.hr_fin"
                    :v-model="infosAvisModif.hr_fin"
                  />
                  <div
                    class="input-group-append"
                    data-target="#timepicker"
                    data-toggle="datetimepicker"
                  ></div>
                  <div class="input-group-text">
                    <i class="far fa-clock"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-lg-12 col-sm-12 d-flex mb-0">
                <label>Nouvelle organisation horaire </label>
              </div>

              <div class="form-group col-lg-6 col-sm-12">
                <label>Heure début</label>
                <div class="input-group date" id="datetimepicker3">
                  <input class="form-control" type="time" name="hr_debut"
                  v-model="infosAvisModif.new_hr_debut"
                  />
                  <div
                    class="input-group-append"
                    data-target="#timepicker"
                    data-toggle="datetimepicker"
                  ></div>
                  <div class="input-group-text">
                    <i class="far fa-clock"></i>
                  </div>
                </div>
              </div>
              <!-- {{--  --}} -->

              <div class="form-group col-lg-6 col-sm-12">
                <label>Heure fin</label>
                <div class="input-group date" id="datetimepicker3">
                  <input
                    class="form-control timerpicker"
                    type="time"
                    name="hr_fin"
                    v-model="infosAvisModif.new_hr_fin"
                  />
                  <div
                    class="input-group-append"
                    data-target="#timepicker"
                    data-toggle="datetimepicker"
                  ></div>
                  <div class="input-group-text">
                    <i class="far fa-clock"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <input type="hidden" :v-model=""/> -->
      <div class="card-footer text-center">
        <a href="/print-m3" class="btn btn-info"
          ><i class="fa fa-print"></i>&nbsp;Imprimer</a
        >
      </div>
        <div class="card-footer text-center">
        <a href="#" class="btn btn-info" @click="StoreOldAndUpdateNew()"
          ><i class="fa fa-print"></i>&nbsp;Modifier</a
        >
        <!-- <a href="#" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Modifier</a> -->
      </div>
    </form>
  </div>
</template>


<script>
import { mapState } from "vuex";

export default {
  runtimeCompiler: true,

  data () {
    return {
      selected_nForm: null,
      idForm: null,
      nCabinet: null,
      id_plan: null,
      selected_nrc_entrp: null,
      selectedCabinet: false,
      selectedFormationLieu: false,
      infosAvisModif: {
       nForm: "",
        selected_nrc_entrp:"",
        id_plan:"",
        selected_nForm:"",
        nature_action:"",
        selected_input_annuler:false,
        type_action:"",
        date_realisation:false,
        organisme_formations:false,
        lieu_formations:false,
        horaire_formations:false,
        hr_debut:"",
        hr_fin:"",
        pse_debut:"",
        pse_fin:"",
        organisme:"",
        lieu:"",
        groupe:"",
        date1:"",
        date2:"",
        date3:"",
        date4:"",
        date5:"",
        date6:"",
        date7:"",
        date8:"",
        date9:"",
        date10:"",
        new_hr_debut:"",
        new_hr_fin:"",
        new_pse_debut:"",
        new_pse_fin:"",
        new_organisme:"",
        new_lieu:"",
        new_groupe:"",
        new_date1:"",
        new_date2:"",
        new_date3:"",
        new_ate4:"",
        new_date5:"",
        new_date6:"",
        new_date7:"",
        new_date8:"",
        new_date9:"",
        new_date10:""
      }

    };
  },

  mounted() {
    this.$store.dispatch("model3/FetchClients");
    this.$store.dispatch("model3/FetchAllCabinets");
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
    }),
  },

  methods: {
    handleAction(actionName, value) {
      this.$store.dispatch(actionName, value);
    },
    // fonction pour l'état d'avis annulation
    getSelected() {
      let annul = document.getElementById("etat");

      if (annul.value.toString() === "annulation") {
        let annuler = document.getElementById("annuler");
        annuler.checked = true;
        annuler.disabled = false;

        // récupérer les id des checkbox
        let chk_dateR = document.getElementById("modif_date");
        let chk_organ = document.getElementById("modif_organ");
        let chk_lieu = document.getElementById("modif_lieu");
        let chk_horaire = document.getElementById("modif_horaire");

        // make checkbox disabled
        chk_dateR.disabled = true;
        chk_organ.disabled = true;
        chk_lieu.disabled = true;
        chk_horaire.disabled = true;
      }
    },

    // fonction pour l'état d'avis modification
    getDisabled() {
      let annul = document.getElementById("etat");
      if (annul.value.toString() === "modification") {
        let annuler = document.getElementById("annuler");
        annuler.checked = false;
        annuler.disabled = true;

        // récupérer les id des checkbox
        let chk_dateR = document.getElementById("modif_date");
        let chk_organ = document.getElementById("modif_organ");
        let chk_lieu = document.getElementById("modif_lieu");
        let chk_horaire = document.getElementById("modif_horaire");

        // make checkbox enabled
        chk_dateR.disabled = false;
        chk_organ.disabled = false;
        chk_lieu.disabled = false;
        chk_horaire.disabled = false;
      }
    },
    StoreOldAndUpdateNew() {
    // this.$store.dispatch("model3/PostPutAvisModif", infosAvisModif);
    console.log(this.infosAvisModif);
    },
  },
}

</script>

<style></style>
