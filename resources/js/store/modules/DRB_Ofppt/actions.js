export const actions = {
  async getListOfDROfppt({ commit }) {
    await axios
      .get(`/list-drb-ofppt`)
      .then(({data}) => {
        commit("FETCH_DBR_OFPPT", data);
      })
      .catch(err => {
        console.log(err);
      });
  },

  async getListOfDROfpptEdit({ commit }, ndrb) {
    await axios
      .get(`/edit-drb-ofppt/` + ndrb)
      .then(({ data }) => {
        commit("FETCH_DBR_OFPPT_Edit", data);
        console.log();
      })
      .catch(err => console.log(err));
  },
  async ReglEntrpInfo({ commit }, ndrb) {
    await axios
      .get(`/regEntrp-drb-ofppt/` + ndrb)
      .then(({ data }) => {
        commit("FETCH_REGL_ENTREPRISE_INFO", data);
      })
      .catch(err => console.log("cant get reg entrp info", err));
  },

  async DeleteDrf({ commit, state }, ndrb) {
    await axios
      .delete(`/delete-drf/` + ndrb)
      .then( () => {
         let data = state.DRB_Ofppts;
         let result = (data.filter( item => item.n_drf != ndrb));
         commit("FETCH_DBR_OFPPT", result);
      })
      .catch(err => console.log("cant delete drf", err));
  },
  async rechercher({ commit }, ndrb){
    await axios
      .get("/search-drf/" + ndrb)
      .then(({ data }) => {
        commit("FETCH_DRBOFPPT_RECHERCHE", data);
        console.log();
      })
      .catch(err => console.log(err));
  }
};
