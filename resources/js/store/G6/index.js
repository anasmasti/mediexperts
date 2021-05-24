import Vue from 'vue';
import Vuex from 'vuex';
import { state } from './state';
import { mutations } from './mutations';
import { actions } from './actions';


Vue.use(Vuex);

export const G6 = {
  namespaced: true,
  state,
  mutations,
  actions,

}
