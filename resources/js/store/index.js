import Vue from 'vue';
import Vuex from 'vuex';
import { model3 } from './modules/model3/index';
import { G6 } from './G6';

Vue.use(Vuex)

export const store = new Vuex.Store({
  modules: {
    model3,
    G6
  },
})
