export  const mutations = {

  FETCH_DBR_OFPPT(state, data) { state.DRB_Ofppts = data; console.log('drb ofppt' , state.DRB_Ofppts); },
  FETCH_DBR_OFPPT_Edit(state, data) { state.DRB_OfpptEdit = data; },
  FETCH_REGL_ENTREPRISE_INFO (state, data) { state.reglEntreprise = data }
  // SETNDRB(state, data) { state.ndrb = data; },
}


//==========================================================

