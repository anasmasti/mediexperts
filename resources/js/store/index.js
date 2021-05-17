import Vue from 'vue';
import Vuex from 'vuex';
import { model3 } from './modules/model3/index';
import { G6 } from './G6';
<<<<<<< HEAD
import { DRB_OFPPT } from './DRB_OFPPT';
=======
import { DRB_Ofppt } from './modules/DRB_Ofppt/index';
>>>>>>> 12cc41ce0e25ecc65b0ec0cafa971fc65dd2b8c2

Vue.use(Vuex)

export const store = new Vuex.Store({
  modules: {
    model3,
    G6,
<<<<<<< HEAD
    DRB_OFPPT
=======
    DRB_Ofppt
>>>>>>> 12cc41ce0e25ecc65b0ec0cafa971fc65dd2b8c2
  },
})
