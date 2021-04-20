import { data } from "jquery";
import Vue from "vue";
import Vuex from "vuex";

export const actions = {
  // ####################################################### //
  // #################### A C T I O N S #################### //
  // ####################################################### //

  // récupérer la liste des entreprises (clients)
  async FetchClients({ commit }) {
    await axios
      .get("/fill-clients")
      .then(({ data }) => {
        commit("SET_CLIENTS", data);
        console.log("clients : ", data);
      })
      .catch(err => console.error("err FillClients", err));
  },
  async SetNrcEntrp({ commit, nrc }) {
    commit("SET_NRC_ENTRP", nrc);
  },
  //récupérer les réferences plan à partir du client sélectionné
  async FetchReferencesPlan({ commit }, nrcEntrp) {
    await axios
      .get(`/fill-reference-plan`, { params: { nrcEntrp: nrcEntrp } })
      .then(({ data }) => {
        commit("SET_REFERENCE_PLANS", data);
        console.log("reference_plans : ", data);
      })
      .catch(err => console.log("err FillReferencesPlan", err));
  },
  //-----------------------------------------------------------------
  //récupérer les actions à partir du REF sélectionné
  async FetchActionByReference({ commit }, idPlan) {
    await axios
      .get(`/fill-plans-by-reference`, { params: { idPlan: idPlan } })
      .then(({ data }) => {
        commit("SET_ACTION_BY_PLAN", data);
        console.log("actions_by_plan : ", data);
      })
      .then(() => {
        // fill dates action
        //commit('SET_DATES_ACTION');
      })
      .catch(err => console.error("err FillPlanByReference", err));
  },
  async FetchAllCabinets({ commit }) {
    await axios.get(`/fill-all-organisme`).then(({ data }) => {
      commit("SET_ORGANISME", data);
      console.log("Cabinets :", data);
    });
  },
  //récupérer les dates de l'action actuel
  async FetchDatesPlan({ commit }, nForm) {
    await axios
      .get(`/fill-dates-plan`, { params: { nForm: nForm } })
      .then(({ data }) => {
        commit("SET_NB_PARTICIPENTS", data);
        commit("SET_DATES", data);
      })
      .catch(err => console.error("err FillDates", err));
  },
  //Getting Old Avis Modif Informations
  async FetchInitialInfoAvisModif({ commit }, nForm) {
    await axios
      .get(`/fill-avis-modif`, { params: { nForm: nForm } })
      .then(({ data }) => {
        commit("SET_INITIAL_INFO_AVISMODIF", data);
        console.log("initial info :", data);
      })
      .catch(err => {
        console.log("err Fetching Info Initial Avis Modif", err);
      });
  },

  //Posting and puting the new insertions
  async PostPutAvisModif(newInfos) {
    await axios.post(`/store-avis-modif`, )
  },
};
