import { data } from "jquery";

export const mutations = {
  // ########################################################### //
  // #################### M U T A T I O N S #################### //
  // ########################################################### //

  SET_CLIENTS(state, data) { state.clients = data; },
  SET_NRC_ENTRP(state, data) { state.curr_nrc_entrp = data; },
  SET_REFERENCE_PLANS(state, data) { state.reference_plans = data; },
  SET_ACTION_BY_PLAN(state, data) { state.actions_by_plan = data; },
  SET_ANNEE_PLAN(state, data) { state.curr_annee_plan = data; },
  SET_ORGANISME(state, data) {state.cabinets = data;},
  SET_NB_PARTICIPENTS(state,data) {state.nb_participents = data},
  SET_INITIAL_INFO_AVISMODIF(state, data) {state.Info_AvisModif = data},
  SET_INFO_GROUPE(state, data) {state.groupe_info = data},
  SET_OLD_AVIS_MODFI_INFO(state , data) {state.Old_AvisModif = data},
  SET_NOM_RESPONSABLE(state, data) {state.nom_responsable = data},
  SET_NOM_THEME(state , data) {state.nom_theme = data}
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
}
