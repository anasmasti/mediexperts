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
            >
              <option selected value="modifié">Modification</option>
              <option value="annulé">Annulation</option>
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
                  <input
                    name="annuler"
                    value="annuler"
                    v-model="selected_annuler"
                    type="checkbox"
                    id="annuler"
                  />
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th rowspan="5">Modification</th>
              </tr>
              <tr>
                <th style="width: 5%">De la date de Réalisation</th>
                <th>
                  <input
                    type="checkbox"
                    name="modif"
                    value="false"
                    v-model="selected_modifdate"
                    id="modif_date"
                  />
                </th>
              </tr>
              <tr>
                <th style="width: 5%">De l’organisme de formation</th>
                <th>
                  <input
                    type="checkbox"
                    name="modif"
                    value="false"
                    v-model="selected_modiforganisme"
                    id="modif_organ"
                  />
                </th>
              </tr>
              <tr>
                <th style="width: 5%">De lieu de formation</th>
                <th>
                  <input
                    type="checkbox"
                    name="modif"
                    value="false"
                    v-model="selected_modiflieu"
                    id="modif_lieu"
                  />
                </th>
              </tr>
              <tr>
                <th style="width: 5%">Organisation horaire</th>
                <th>
                  <input
                    type="checkbox"
                    name="modif"
                    value="false"
                    v-model="selected_modifhoraire"
                    id="modif_horaire"
                  />
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
                  value="planifié"
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
          <div class="form-group col-lg-6 col-sm-12">
            <label for="groups">Groupe</label>
            <select
              class="form-control"
              id="groups"
              @change="
                handleAction('model3/FetchInfoGroupe', selected_idForm);
                getPause();
                getSameDates();
              "
              v-model="selected_idForm"
            >
              <option selected disabled>
                ---selectionner Groupe---
              </option>
              <option
                v-for="infogp in Info_AvisModif"
                :value="infogp.id_form"
                :key="infogp.id_form"
              >
                {{ infogp.groupe }}
              </option>
            </select>
          </div>
          <div
            class="col-12 container p-lg-4 mt-3"
            style="background-color: #efefef"
            id="content"
            v-for="info in groupe_info"
            :key="info.id_form"
          >
            <input type="hidden" :value="info.pse_debut" id="pause_debut" />
            <input type="hidden" :value="info.pse_fin" id="pause_fin" />
            <h2>
              <label for="groupe">Groupe </label>
              <strong id="groupe"> {{ info.groupe }} </strong>
            </h2>
            <h5 v-if="checkIndexOfGroup(info.groupe)" class="text-danger">
              Il faut saisir initial, nouvel, lieu et l'organisme pendant la
              saisie du premier groupe
            </h5>
            <h5
              :class="[
                checkIndexOfGroup(info.groupe) ? 'desabled-checkbox' : ''
              ]"
            >
              <div class="row my-3">
                <div class="form-group col-lg-6 col-sm-12">
                  <label>Organisme de formation initial</label>
                  <input
                    type="text"
                    class="form-control targetid"
                    id="initial_organisme"
                    :value="info.organisme"
                  />
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                  <label>Lieu de formation initial </label>
                  <input
                    type="text"
                    id="initial_lieu"
                    class="form-control"
                    :value="info.lieu"
                  />
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                  <label>Nouvel Organisme de formation</label>
                  <select
                    class="form-control"
                    id="nouvel_organisme"
                    v-model="selectedCabinet"
                  >
                    <option selected disabled>
                      ---selectionner l'organisme---
                    </option>
                    <option
                      v-for="cabinet in cabinets"
                      :value="
                        selectedCabinet == false
                          ? info.organisme
                          : cabinet.raisoci
                      "
                      :key="cabinet.nrc_cab"
                    >
                      {{ cabinet.raisoci }}
                    </option>
                  </select>
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                  <label>Nouveau lieu</label>
                  <select class="form-control" name="lieu" id="nouvel_lieu">
                    <option selected disabled
                      >---selectionner le lieu---</option
                    >
                    <option v-for="cl in clients" :key="cl.nrc_entrp">
                      {{ cl.raisoci }}
                    </option>
                  </select>
                </div>
              </div>
            </h5>
            <h5
              v-if="
                checkIndexOfGroup(info.groupe) && info.Has_Same_Dates == true
              "
              class="text-danger"
            >
              Les groups ont les mêmes dates.
            </h5>
            <h5
              :class="[
                checkIndexOfGroup(info.groupe) && info.Has_Same_Dates == true
                  ? 'desabled-checkbox'
                  : ''
              ]"
            >
              <div class="row">
                <div class="form-group col-lg-12 col-sm-12">
                  <h5>
                    <label class="mr-2">Groupes ayant les mêmes dates :</label>
                    Oui
                    <input
                      type="radio"
                      value="true"
                      id="sameDate_oui"
                      name="sameDate"
                      v-model="selected_sameDate"
                    />
                    - Non
                    <input
                      type="radio"
                      value="false"
                      id="sameDate_non"
                      name="sameDate"
                      v-model="selected_sameDate"
                    />
                  </h5>
                </div>
              </div>

              <input type="hidden" id="same_date" v-model="old_SameDate" />

              <div class="row mt-3">
                <!-- {{-- LES DATES INITIALES --}} -->
                <div class="form-group col-lg-12 col-sm-12 mb-0">
                  <h5><label>Dates initiales de réalisation </label></h5>
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
                  <input
                    class="form-control"
                    type="date"
                    id="date2"
                    :value="info.date2"
                  />
                </div>

                <div
                  class="form-group col-lg-3 col-md-6 col-12"
                  v-if="info.date3"
                >
                  <input
                    class="form-control"
                    type="date"
                    id="date3"
                    :value="info.date3"
                  />
                </div>

                <div
                  class="form-group col-lg-3 col-md-6 col-12"
                  v-if="info.date4"
                >
                  <input
                    class="form-control"
                    type="date"
                    id="date4"
                    :value="info.date4"
                  />
                </div>

                <div
                  class="form-group col-lg-3 col-md-6 col-12"
                  v-if="info.date5"
                >
                  <input
                    class="form-control"
                    type="date"
                    id="date5"
                    :value="info.date5"
                  />
                </div>

                <div
                  class="form-group col-lg-3 col-md-6 col-12"
                  v-if="info.date6"
                >
                  <input
                    class="form-control"
                    type="date"
                    id="date6"
                    :value="info.date6"
                  />
                </div>

                <div
                  class="form-group col-lg-3 col-md-6 col-12"
                  v-if="info.date7"
                >
                  <input
                    class="form-control"
                    type="date"
                    id="date7"
                    :value="info.date7"
                  />
                </div>

                <div
                  class="form-group col-lg-3 col-md-6 col-12"
                  v-if="info.date8"
                >
                  <input
                    class="form-control"
                    type="date"
                    id="date8"
                    :value="info.date8"
                  />
                </div>

                <div
                  class="form-group col-lg-3 col-md-6 col-12"
                  v-if="info.date9"
                >
                  <input
                    class="form-control"
                    type="date"
                    id="date9"
                    :value="info.date9"
                  />
                </div>

                <div
                  class="form-group col-lg-3 col-md-6 col-12"
                  v-if="info.date10"
                >
                  <input
                    class="form-control"
                    type="date"
                    id="date10"
                    :value="info.date10"
                  />
                </div>

                <!-- {{-- LES NOUVELLES DATES --}} -->

                <div class="form-group col-lg-12 col-sm-12 mb-0">
                  <h5>
                    <label>Nouvelles Dates exactes de réalisation </label>
                  </h5>
                </div>

                <div class="form-group col-lg-3 col-md-6 col-12">
                  <input
                    class="form-control"
                    type="date"
                    id="newdate1"
                    :value="info.date1"
                  />
                </div>

                <div class="form-group col-lg-3 col-md-6 col-12">
                  <input
                    class="form-control"
                    type="date"
                    id="newdate2"
                    :value="info.date2"
                  />
                </div>

                <div class="form-group col-lg-3 col-md-6 col-12">
                  <input
                    class="form-control"
                    type="date"
                    id="newdate3"
                    :value="info.date3"
                  />
                </div>

                <div class="form-group col-lg-3 col-md-6 col-12">
                  <input
                    class="form-control"
                    type="date"
                    id="newdate4"
                    :value="info.date4"
                  />
                </div>

                <div class="form-group col-lg-3 col-md-6 col-12">
                  <input
                    class="form-control"
                    type="date"
                    id="newdate5"
                    :value="info.date5"
                  />
                </div>

                <div class="form-group col-lg-3 col-md-6 col-12">
                  <input
                    class="form-control"
                    type="date"
                    id="newdate6"
                    :value="info.date6"
                  />
                </div>

                <div class="form-group col-lg-3 col-md-6 col-12">
                  <input
                    class="form-control"
                    type="date"
                    id="newdate7"
                    :value="info.date7"
                  />
                </div>

                <div class="form-group col-lg-3 col-md-6 col-12">
                  <input
                    class="form-control"
                    type="date"
                    id="newdate8"
                    :value="info.date8"
                  />
                </div>

                <div class="form-group col-lg-3 col-md-6 col-12">
                  <input
                    class="form-control"
                    type="date"
                    id="newdate9"
                    :value="info.date9"
                  />
                </div>

                <div class="form-group col-lg-3 col-md-6 col-12">
                  <input
                    class="form-control"
                    type="date"
                    id="newdate10"
                    :value="info.date10"
                  />
                </div>
              </div>
            </h5>

            <!-- {{-- L'HORAIRE INITIALE --}} -->
            <h5 v-if="checkIndexOfGroup(info.groupe)" class="text-danger">
              l'heur initiale est déjà saisie
            </h5>
            <h5
              :class="[
                checkIndexOfGroup(info.groupe) ? 'desabled-checkbox' : ''
              ]"
            >
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
            </h5>
            <h5 v-if="checkIndexOfGroup(info.groupe)" class="text-danger">
              Il faut saisir la nouvelle heur pendent la saisie du premier
              groupe.
            </h5>
            <h5
              :class="[
                checkIndexOfGroup(info.groupe) ? 'desabled-checkbox' : ''
              ]"
            >
              <div class="row">
                <div class="form-group col-lg-12 col-sm-12 d-flex mb-0">
                  <label>Nouvelle organisation horaire </label>
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                  <label>Heure début</label>
                  <div class="input-group date" id="datetimepicker3">
                    <input
                      class="form-control"
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
            </h5>
            <div class="row">
              <!-- selection du pause -->
              <div class="form-group col-lg-6 col-sm-12 mt-3">
                <h5 v-if="checkIndexOfGroup(info.groupe)" class="text-danger">
                  Il faut choisir la pause pendent la saisie du premier groupe.
                </h5>
                <h5
                  :class="[
                    checkIndexOfGroup(info.groupe) ? 'desabled-checkbox' : ''
                  ]"
                >
                  <label for="pause" class="mr-3"> Il y a une pause :</label>
                  Oui
                  <input
                    type="radio"
                    value="true"
                    id="pause_oui"
                    name="pause"
                    v-model="selected_pause"
                  />
                  - Non
                  <input
                    type="radio"
                    value="false"
                    id="pause_non"
                    name="pause"
                    v-model="selected_pause"
                  />
                  <input type="hidden" id="old_pause" v-model="old_pause" />
                </h5>
                <!-- <h1> {{selected_pause}} </h1> -->
              </div>
              <!-- groupe has same date -->
            </div>
          </div>
        </div>
      </div>

      <!-- <input type="hidden" :v-model=""/> -->
      <div class="d-flex justify-content-center">
        <a
          href="#"
          class="btn btn-warning p-2 mx-3"
          @click="storeUpdateModel3()"
          ><i class="fa fa-edit"> </i>&nbsp;Modifier</a>
        <!-- <a href="#" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Modifier</a> -->
        <a href="/print-m3" class="btn btn-info p-2 text-light"
          ><i class="fa fa-print"></i>&nbsp;Imprimer</a>
      </div>
    </form>
  </div>

</template>

<style scoped>
.desabled-checkbox {
  filter: blur(8px);
  -webkit-filter: blur(8px);
  cursor: no-drop;
}
</style>

<script>
import { mapState } from "vuex";

export default {
  runtimeCompiler: true,

  data() {
    return {
      selected_nForm: null,
      selected_idForm: null,
      idForm: null,
      nCabinet: null,
      id_plan: null,
      selected_nrc_entrp: null,
      selectedCabinet: false,
      selectedFormationLieu: false,
      selected_annuler: false,
      selected_modifdate: false,
      selected_modiforganisme: false,
      selected_modiflieu: false,
      selected_modifhoraire: false,
      selected_nature_action: true,
      pause: false,
      selected_pause: false,
      old_pause: false,
      old_SameDate: false,
      selected_sameDate: false,
      sameDate: false
    };
  },

  mounted() {
    this.$store.dispatch("model3/FetchClients");
    this.$store.dispatch("model3/FetchAllCabinets");

  },

  updated() {},

  computed: {
    ...mapState("model3", {
      curr_nrc_entrp: state => state.curr_nrc_entrp,
      clients: state => state.clients,
      reference_plans: state => state.reference_plans,
      actions_by_plan: state => state.actions_by_plan,
      curr_annee_plan: state => state.curr_annee_plan,
      cabinets: state => state.cabinets,
      Info_AvisModif: state => state.Info_AvisModif,
      groupe_info: state => state.groupe_info
    })
  },

  methods: {
    handleAction(actionName, value) {
      this.$store.dispatch(actionName, value);
    },
    getSameDates() {
      setTimeout(() => {
        if (this.Info_AvisModif) {
          this.sameDate = this.Info_AvisModif[0].Has_Same_Dates;
          if (this.sameDate == 0) {
            this.sameDate = false;
            this.selected_sameDate = this.sameDate;
            this.old_SameDate = this.sameDate;
          } else if (this.sameDate == 1) {
            this.sameDate = true;
            this.selected_sameDate = this.sameDate;
            this.old_SameDate = this.sameDate;
          }
        }
      }, 500);
      return this.selected_sameDate, this.old_SameDate;
    },

    getPause() {
      setTimeout(() => {
        if (this.Info_AvisModif) {
          this.pause = this.Info_AvisModif[0].pause;
          if (this.pause == 0) {
            this.pause = false;
            this.old_pause = this.pause;
            this.selected_pause = this.pause;
          } else if (this.pause == 1) {
            this.pause = true;
            this.old_pause = this.pause;
            this.selected_pause = this.pause;
          }
        }
      }, 500);
      return this.selected_pause, this.old_pause;
    },
    // fonction pour l'état d'avis annulation
    getSelected() {
      let annul = document.getElementById("etat");

      if (annul.value.toString() === "annulé") {
        let annuler = document.getElementById("annuler");
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
      if (annul.value.toString() === "modifié") {
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
    async storeUpdateModel3() {
      let date1 = document.getElementById("date1");
      let date2 = document.getElementById("date2");
      let date3 = document.getElementById("date3");
      let date4 = document.getElementById("date4");
      let date5 = document.getElementById("date5");
      let date6 = document.getElementById("date6");
      let date7 = document.getElementById("date7");
      let date8 = document.getElementById("date8");
      let date9 = document.getElementById("date9");
      let date10 = document.getElementById("date10");
      let newdate1 = document.getElementById("newdate1");
      let newdate2 = document.getElementById("newdate2");
      let newdate3 = document.getElementById("newdate3");
      let newdate4 = document.getElementById("newdate4");
      let newdate5 = document.getElementById("newdate5");
      let newdate6 = document.getElementById("newdate6");
      let newdate7 = document.getElementById("newdate7");
      let newdate8 = document.getElementById("newdate8");
      let newdate9 = document.getElementById("newdate9");
      let newdate10 = document.getElementById("newdate10");
      let planifie = document.getElementById("planifie");
      let initial_organisme = document.getElementById("initial_organisme");
      let initial_lieu = document.getElementById("initial_lieu");
      let nouvel_organisme = document.getElementById("nouvel_organisme");
      let nouvel_lieu = document.getElementById("nouvel_lieu");
      let initial_hr_debut = document.getElementById("initial_hr_debut");
      let initial_hr_fin = document.getElementById("initial_hr_fin");
      let new_hr_debut = document.getElementById("new_hr_debut");
      let new_hr_fin = document.getElementById("new_hr_fin");
      let entreprise = document.getElementById("client");
      let ref_plan = document.getElementById("plans");
      let theme = document.getElementById("theme");
      let etat_avis = document.getElementById("etat");
      let groupe = document.getElementById("groupe");
      let pause_debut = $("#pause_debut");
      let pause_fin = $("#pause_fin");

      let infoavismodif = {
        date1: date1 != null ? date1.value : null,
        date2: date2 != null ? date2.value : null,
        date3: date3 != null ? date3.value : null,
        date4: date4 != null ? date4.value : null,
        date5: date5 != null ? date5.value : null,
        date6: date6 != null ? date6.value : null,
        date7: date7 != null ? date7.value : null,
        date8: date8 != null ? date8.value : null,
        date9: date9 != null ? date9.value : null,
        date10: date10 != null ? date10.value : null,
        newdate1: newdate1 != null ? newdate1.value : null,
        newdate2: newdate2 != null ? newdate2.value : null,
        newdate3: newdate3 != null ? newdate3.value : null,
        newdate4: newdate4 != null ? newdate4.value : null,
        newdate5: newdate5 != null ? newdate5.value : null,
        newdate6: newdate6 != null ? newdate6.value : null,
        newdate7: newdate7 != null ? newdate7.value : null,
        newdate8: newdate8 != null ? newdate8.value : null,
        newdate9: newdate9 != null ? newdate9.value : null,
        newdate10: newdate10 != null ? newdate10.value : null,
        entreprise: entreprise.value,
        refPlan: ref_plan.value,
        NomTheme: theme.value,
        typeAction: etat_avis.value,
        annuler: this.selected_annuler,
        modificationDate: this.selected_modifdate,
        modificationOrganisme: this.selected_modiforganisme,
        modificationLieu: this.selected_modiflieu,
        modificationHoraire: this.selected_modifhoraire,
        natureAction: planifie.value,
        organisme: initial_organisme.value,
        lieu: initial_lieu.value,
        heurDebut: initial_hr_debut.value,
        heurFin: initial_hr_fin.value,
        newOrganisme:
          nouvel_organisme.value == false
            ? initial_organisme.value
            : nouvel_organisme.value,
        newLieu:
          nouvel_lieu.value == "---selectionner le lieu---"
            ? initial_lieu.value
            : nouvel_lieu.value,
        newHeurDebut:
          new_hr_debut.value == false
            ? initial_hr_debut.value
            : new_hr_debut.value,
        newHeurFin:
          new_hr_fin.value == false ? initial_hr_fin.value : new_hr_fin.value,
        nForm: this.selected_nForm,
        idForm: this.selected_idForm,
        groupe: groupe.textContent,
        pause: this.selected_pause,
        old_pause: this.old_pause,
        pause_debut: pause_debut != null ? pause_debut.val() : null,
        pause_fin: pause_fin != null ? pause_fin.val() : null,
        sameDates: this.selected_sameDate,
        old_sameDates: this.old_SameDate
      };

      //  return console.log("-*-*-*-*-*-*-*-*-", infoavismodif);
      await axios({
        method: "POST",
        url: "api/store-avis-modif",
        data: JSON.parse(
          JSON.stringify(infoavismodif, function(key, value) {
            return value === "" ? null : value;
          })
        )
      })
        .then(() => {
          this.$toastr.s('Modifié avec succès')
        })
        .catch( (e) => {
          this.$toastr.e("Echec de modification")
          throw e
        });
    },

    // check if group has pause
    checkIndexOfGroup(index) {
      let isCorrect = index !== 1;

      return isCorrect;
    }
  }
};
</script>

<style></style>
