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
    curr_annee_plan: null, // année du plan actuel
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
          console.log("reference_plans : ", this.data)
        })
        .catch((err) => console.log("err FillReferencesPlan", err));
    },
    // récupérer les réferences plan à partir du client sélectionné
    async FetchPlanByReference({commit}, idPlan) {
      await axios.get(`/fill-plans-by-reference`, {params: {idPlan: idPlan}})
        .then(({data}) => {
          commit('SET_REFERENCE_PLANS', data);
          commit('SET_ANNEE_PLAN', data[0].annee);
          console.log("actions_by_plan : ", data);
        })
        .then(() => {
          // fill dates action
          commit('SET_DATES_ACTION');
        })
        .catch((err) => console.error("err FillPlanByReference", err));
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
      console.log("isAllLoaded", this.isAllLoaded);
    },
    // récupérer les dates de l'action actuel
    // async FetchDatesPlan({commit}, nForm) {
    //   await axios.get(`/fill-dates-plan`, {params: {nForm: nForm}})
    //     .then(({data}) => {
    //       this.dates_actions = data;
    //     })
    //     .then(() => {
    //       this.AssignDates({commit}, nForm);
    //     })
    //     .catch((err) => console.error("err FillDates", err));
    // },

  }
})
