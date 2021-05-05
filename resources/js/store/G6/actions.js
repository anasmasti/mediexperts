import { data } from "jquery";
import Vue from "vue";
import Vuex from "vuex";

export const actions = {

async FetchClients({ commit }) {
  await axios
    .get("/fill-clients")
    .then(({ data }) => {
      commit("SET_CLIENTS", data);
      console.log("clients : ", data);
    })
    .catch(err => console.error("err FillClients", err));
},

async FetchReferencesPlan({ commit }, nrcEntrp) {
  await axios
    .get(`/fill-reference-plan`, { params: { nrcEntrp: nrcEntrp } })
    .then(({ data }) => {
      commit("SET_REFERENCE_PLANS", data);
      console.log("reference_plans : ", data);
    })
    .catch(err => console.log("err FillReferencesPlan", err));
},

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

async FecthSelectedRefG6Info ( {commit} , idPlan) {
  await axios
    .get(`/fill-g6-info` , {params: { idPlan : idPlan } })
    .then(({data}) => {
      commit("SET_G6_INFO" , data)
      console.log("G6 INFO", data)
    })
    .catch(err => console.log("Error Geting G6 info" , err));
},
}
