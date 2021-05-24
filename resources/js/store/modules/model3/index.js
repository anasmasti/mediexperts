import Vue from 'vue';
import Vuex from 'vuex';
import { state } from './state';
import { mutations } from './mutations';
import { actions } from './actions';
import { getters } from './getters';

Vue.use(Vuex);

export const model3 = {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,

}
