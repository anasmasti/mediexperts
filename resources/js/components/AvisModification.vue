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
                handleAction('model3/FetchReferencesPlan', selected_nrc_entrp);
                handleAction('model3/SetNrcEntrp', selected_nrc_entrp);
              "
              v-model="selected_nrc_entrp"
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
              @change="handleAction('model3/FetchActionByReference', id_plan)"
              v-model="id_plan"
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
                  <input name="annuler" :value="true" type="checkbox" id="annuler" />
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th rowspan="5">Modification</th>
              </tr>
              <tr>
                <th style="width: 5%">De la date de Réalisation</th>
                <th><input type="checkbox" name="modif" id="modif_date" /></th>
              </tr>
              <tr>
                <th style="width: 5%">De l’organisme de formation</th>
                <th><input type="checkbox" name="modif" id="modif_organ" /></th>
              </tr>
              <tr>
                <th style="width: 5%">De lieu de formation</th>
                <th><input type="checkbox" name="modif" id="modif_lieu" /></th>
              </tr>
              <tr>
                <th style="width: 5%">Organisation horaire</th>
                <th>
                  <input type="checkbox" name="modif" id="modif_horaire" />
                </th>
              </tr>
            </tbody>
          </table>

          <div class="form-group col-lg-6 col-sm-12">
            <label>Thème de l’action</label>
            <select
              class="form-control"
              id="theme"
              @change="
                handleAction('model3/FetchInitialInfoAvisModif', selected_nForm)
              "
              v-model="selected_nForm"
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
              <strong id="groupe">Groupe {{ index + 1 }}</strong>
            </h3>
            <div class="row my-3">
              <div class="form-group col-lg-6 col-sm-12">
                <label>Organisme de formation initial</label>
                <input
                  type="text"
                  id="initial_organisme"
                  class="form-control"
                  :value="Info_AvisModif.length != 0 ? info.organisme : ''"
                />
                <h1>organisme. {{infosAvisModif.organisme}}</h1>
              </div>
              <div class="form-group col-lg-6 col-sm-12">
                <label>Lieu de formation initial </label>
                <input
                  type="text"
                  id="initial_lieu"
                  class="form-control"
                  :value="Info_AvisModif.length != 0 ? info.lieu : ''"
                />
              </div>
              <div class="form-group col-lg-6 col-sm-12">
                <label>Nouvel Organisme de formation</label>
                <select class="form-control" id="nouvel_organisme" v-model="selectedCabinet">
                  <option selected disabled>
                    ---selectionner l'organisme---
                  </option>
                  <option
                    v-for="cabinet in cabinets"
                    :value="
                      selectedCabinet == false
                        ? info.organisme
                        : cabinet.raisoci"
                    :key="cabinet.nrc_cab"
                  >
                    {{ cabinet.raisoci }}
                  </option>
                </select>
              </div>
              <div class="form-group col-lg-6 col-sm-12">
                <label>Nouveau lieu</label>
                <select
                  class="form-control"
                  name="lieu"
                  id="nouvel_lieu"
                  v-model="selectedFormationLieu"
                >
                  <option selected disabled>---selectionner le lieu---</option>
                  <option
                    v-for="cl in clients"
                    :value="
                      selectedFormationLieu == false ? info.lieu : cl.raisoci
                    "
                    :key="cl.nrc_entrp"
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

              <div
                class="form-group col-lg-3 col-md-6 col-12"
                v-if="info.date1"
              >
                <input
                  class="form-control"
                  type="date"
                  id="date1"
                  :value="info.date1"
                />
              </div>

              <div
                class="form-group col-lg-3 col-md-6 col-12"
                v-if="info.date2"
              >
                <input class="form-control" type="date" id="date2" :value="info.date2" />
              </div>

              <div
                class="form-group col-lg-3 col-md-6 col-12"
                v-if="info.date3"
              >
                <input class="form-control" type="date" id="date3" :value="info.date3" />
              </div>

              <div
                class="form-group col-lg-3 col-md-6 col-12"
                v-if="info.date4"
              >
                <input class="form-control" type="date" id="date4" :value="info.date4" />
              </div>

              <div
                class="form-group col-lg-3 col-md-6 col-12"
                v-if="info.date5"
              >
                <input class="form-control" type="date" id="date5" :value="info.date5" />
              </div>

              <div
                class="form-group col-lg-3 col-md-6 col-12"
                v-if="info.date6"
              >
                <input class="form-control" type="date" id="date6" :value="info.date6" />
              </div>

              <div
                class="form-group col-lg-3 col-md-6 col-12"
                v-if="info.date7"
              >
                <input class="form-control" type="date" id="date7" :value="info.date7" />
              </div>

              <div
                class="form-group col-lg-3 col-md-6 col-12"
                v-if="info.date8"
              >
                <input class="form-control" type="date" id="date8" :value="info.date8" />
              </div>

              <div
                class="form-group col-lg-3 col-md-6 col-12"
                v-if="info.date9"
              >
                <input class="form-control" type="date" id="date9" :value="info.date9" />
              </div>

              <div
                class="form-group col-lg-3 col-md-6 col-12"
                v-if="info.date10"
              >
                <input class="form-control" type="date" id="date10" :value="info.date10" />
              </div>

              <!-- {{-- LES NOUVELLES DATES --}} -->
              <div class="form-group col-lg-12 col-sm-12 mb-0">
                <label>Nouvelles Dates exactes de réalisation </label>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" id="newdate1" :value="info.date1" />
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" id="newdate2" :value="info.date2" />
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" id="newdate3" :value="info.date3" />
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" id="newdate4" :value="info.date4" />
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" id="newdate5" :value="infor.date5"/>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" id="newdate6" :value="info.date6" />
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" id="newdate7" :value="info.date7" />
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" id="newdate8" :value="info.date8" />
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" id="newdate9" :value="info.date9" />
              </div>

              <div class="form-group col-lg-3 col-md-6 col-12">
                <input class="form-control" type="date" id="newdate10" :value="info.date10" />
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
                  <input
                    class="form-control"
                    type="time"
                    id="initial_hr_debut"
                    name="hr_debut"
                    :value="info.hr_debut"
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
                    id="initial_hr_fin"
                    name="hr_fin"
                    :value="info.hr_fin"
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
                  <input class="form-control"
                  type="time"
                  id="new_hr_debut"
                  name="hr_debut"
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
                    id="new_hr_fin"
                    name="hr_fin"
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
      <div>
        <input type="text" />
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
  updated() {
    this.storeUpdateModel3();
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

    // update the Model 3 and save archive data
    storeUpdateModel3() {

      let date1 =
        document.getElementById("date1") != null
          ? document.getElementById("date1").value
          : null;
      let date2 =
        document.getElementById("date2") != null
          ? document.getElementById("date2").value
          : null;
      let date3 =
        document.getElementById("date3") != null
          ? document.getElementById("date3").value
          : null;
      let date4 =
        document.getElementById("date4") != null
          ? document.getElementById("date4").value
          : null;
      let date5 =
        document.getElementById("date5") != null
          ? document.getElementById("date5").value
          : null;
      let date6 =
        document.getElementById("date6") != null
          ? document.getElementById("date6").value
          : null;
      let date7 =
        document.getElementById("date7") != null
          ? document.getElementById("date7").value
          : null;
      let date8 =
        document.getElementById("date8") != null
          ? document.getElementById("date8").value
          : null;
      let date9 =
        document.getElementById("date9") != null
          ? document.getElementById("date9").value
          : null;
      let date10 =
        document.getElementById("date10") != null
          ? document.getElementById("date10").value
          : null;
      let newdate1 =
        document.getElementById("newdate1") != null
          ? document.getElementById("newdate1").value
          : null;
      let newdate2 =
        document.getElementById("newnewdate2") != null
          ? document.getElementById("newdate2").value
          : null;
      let newdate3 =
        document.getElementById("newdate3") != null
          ? document.getElementById("newdate3").value
          : null;
      let newdate4 =
        document.getElementById("newdate4") != null
          ? document.getElementById("newdate4").value
          : null;
      let newdate5 =
        document.getElementById("newdate5") != null
          ? document.getElementById("newdate5").value
          : null;
      let newdate6 =
        document.getElementById("newdate6") != null
          ? document.getElementById("newdate6").value
          : null;
      let newdate7 =
        document.getElementById("newdate7") != null
          ? document.getElementById("newdate7").value
          : null;
      let newdate8 =
        document.getElementById("newdate8") != null
          ? document.getElementById("newdate8").value
          : null;
      let newdate9 =
        document.getElementById("newdate9") != null
          ? document.getElementById("newdate9").value
          : null;
      let newdate10 =
        document.getElementById("newdate10") != null
          ? document.getElementById("newdate10").value
          : null;
      let action_annuler =
        document.getElementById("annuler") != false
          ? document.getElementById("annuler").value
          : false;
      let action_modifdate =
        document.getElementById("modif_date") != false
          ? document.getElementById("modif_date").value
          : false;
      let action_modiforgan =
        document.getElementById("modif_organ") != false
          ? document.getElementById("modif_organ").value
          : false;
      let action_modiflieu =
        document.getElementById("modif_lieu") != false
          ? document.getElementById("modif_lieu").value
          : false;
      let action_modifhoraire =
        document.getElementById("modif_horaire") != false
          ? document.getElementById("modif_horaire").value
          : false;
      let planifie =
        document.getElementById("planifie") != false
          ? document.getElementById("planifie").value
          : false;
      let initial_organisme =
        document.getElementById("initial_organisme") != null
          ? document.getElementById("initial_organisme").value
          : null;
      let initial_lieu =
        document.getElementById("initial_lieu") != null
          ? document.getElementById("initial_lieu").value
          : null;
      let nouvel_organisme =
        document.getElementById("nouvel_organisme") != null
          ? document.getElementById("nouvel_organisme").value
          : null;
      let nouvel_lieu =
        document.getElementById("nouvel_lieu") != null
          ? document.getElementById("nouvel_lieu").value
          : null;
      let initial_hr_debut =
        document.getElementById("initial_hr_debut") !=null
          ? document.getElementById("initial_hr_debut").value
          : null;
      let initial_hr_fin =
        document.getElementByI("initial_hr_fin") != null
          ? document.getElementById("initial_hr_fin").value
          : null;
      let new_hr_debut =
        document.getElementById("new_hr_debut") != null
          ? document.getElementById("new_hr_debut").value
          : null;
      let new_hr_fin =
        document.getElementById("new_hr_fin") != null
          ? doucment.getElementById("new_hr_fin").value
          : null;
      let entreprise =
        document.getElementById("client") != null
          ? doucment.getElementById("client").value
          : null;
      let ref_plan =
        document.getElementById("plans") != null
          ? doucment.getElementById("plans").value
          : null;
      let theme =
        document.getElementById("theme") != null
          ? doucment.getElementById("theme").value
          : null;
      let etat_avis =
        document.getElementById("etat") != null
          ? document.getElementById("etat").value
          : null;
      let groupe =
        document.getElementById("groupe") != null
          ? document.getElementById("groupe").value
          : null;

      var infoavismodif = {
        'date1': date1,
        'date2': date2,
        'date3': date3,
        'date1': date4,
        'date2': date5,
        'date6': date6,
        'date7': date7,
        'date8': date8,
        'date9': date9,
        'date10': date10,
        'newdate1': newdate1,
        'newdate2': newdate2,
        'newdate3': newdate3,
        'newdate4': newdate4,
        'newdate5': newdate5,
        'newdate6': newdate6,
        'newdate7': newdate7,
        'newdate8': newdate8,
        'newdate9': newdate9,
        'newdate10': newdate10,
        'entreprise': entreprise,
        'refPlan': ref_plan,
        'NomTheme': theme,
        'type action': etat_avis,
        'annuler': action_annuler,
        'modificationDate': action_modifdate,
        'modificationOrganisme': action_modiforgan,
        'modificationLieu': action_modiflieu,
        'modificationHoraire': action_modifhoraire,
        'natureAction': planifie,
        'organisme': initial_organisme,
        'lieu': initial_lieu,
        'heurDebut': initial_hr_debut,
        'heurFin': initial_hr_fin,
        'newOrganisme': nouvel_organisme,
        'newLieu': nouvel_lieu,
        'newHeurDebut': new_hr_debut,
        'newHeurFin': new_hr_fin
      }

      return console.log("--------------------", infoavismodif);

    },
  },
}

</script>

<style></style>
