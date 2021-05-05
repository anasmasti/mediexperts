import {data} from 'jquery';

export const mutations = {

SET_CLIENTS(state, data) { state.clients = data; },
SET_REFERENCE_PLANS(state, data) { state.reference_plans = data; },
SET_ACTION_BY_PLAN(state, data) { state.actions_by_plan = data; },
SET_G6_INFO(state, data) {state.G6_info = data}

}
