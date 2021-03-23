import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
  strict: true,
  // ################################################### //
  // #################### S T A T E #################### //
  // ################################################### //
  state: {
    curr_nrc_entrp: null, // numero rc actuel d'entreprise
    clients: [], // liste des entreprise
    reference_plans: [], // liste contenant les références du plan
    actions_by_plan: [], // list des action de formations
   // actions_by_ref: [],
    curr_annee_plan: null, // année du plan actuel
    cabinets : [],
    info_initial : []

  },
  mutations: {
    // ########################################################### //
    // #################### M U T A T I O N S #################### //
    // ########################################################### //
    SET_CLIENTS(state, data) { state.clients = data; },
    SET_NRC_ENTRP(state, data) { state.curr_nrc_entrp = data; },
    SET_REFERENCE_PLANS(state, data) { state.reference_plans = data; },
    SET_ACTION_BY_PLAN(state, data) { state.actions_by_plan = data; },
    SET_ANNEE_PLAN(state, data) { state.curr_annee_plan = data; },
    SET_ORGANISME(state, data) {state.cabinets = data;},
    SET_NB_PARTICIPENTS(state,data) {state.nb_participents = data}
    // SET_DATES_ACTION(state) {
    //   state.actions_by_plan.forEach((action) => {
    //     this.FillDates(action.n_form);
    //   });
    // },
    // SET_CLIENTS(state, data) { state.clients = data; },
    // SET_CLIENTS(state, data) { state.clients = data; },
    // SET_CLIENTS(state, data) { state.clients = data; },
    // SET_CLIENTS(state, data) { state.clients = data; },
    // SET_CLIENTS(state, data) { state.clients = data; }
  },
  actions: {
    // ####################################################### //
    // #################### A C T I O N S #################### //
    // ####################################################### //

    // récupérer la liste des entreprises (clients)
    async FetchClients({commit}) {
      await axios.get('/fill-clients')
        .then(({data}) => {
          commit('SET_CLIENTS', data);
          console.log("clients : ", data)
        })
        .catch((err) => console.error("err FillClients", err));
    },
    async SetNrcEntrp({commit, nrc}) {
      commit('SET_NRC_ENTRP', nrc);
    },
    //récupérer les réferences plan à partir du client sélectionné
    async FetchReferencesPlan({commit}, nrcEntrp) {
      await axios.get(`/fill-reference-plan`, {params: {nrcEntrp: nrcEntrp}})
        .then(({data}) => {
          commit('SET_REFERENCE_PLANS', data);
          console.log("reference_plans : ", data)
        })
        .catch((err) => console.log("err FillReferencesPlan", err));
    },
    //-----------------------------------------------------------------
    //récupérer les actions à partir du REF sélectionné
    async FetchActionByReference({commit}, idPlan) {
      await axios.get(`/fill-plans-by-reference`, {params: {idPlan: idPlan}})
        .then(({data}) => {
          commit('SET_ACTION_BY_PLAN', data);
          //commit('SET_ANNEE_PLAN', data[0].annee);
          console.log("actions_by_plan : ", data);
        })
        .then(() => {
          // fill dates action
          //commit('SET_DATES_ACTION');
        })
        .catch((err) => console.error("err FillPlanByReference", err));
    },
    async FetchAllCabinets({commit}) {
      await axios.get(`/fill-all-organisme`)
      .then(({data}) => {
       commit('SET_ORGANISME', data);
       console.log("Cabinets :" , data)
      });
    },
    //récupérer les dates de l'action actuel
    async FetchDatesPlan({commit}, nForm) {
      await axios.get(`/fill-dates-plan`, {params: {nForm: nForm}})
        .then(({data}) => {
          commit('SET_NB_PARTICIPENTS' , data);
          commit('SET_DATES' , data);
        })
        .catch((err) => console.error("err FillDates", err));
    },
  }
})
