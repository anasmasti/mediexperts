
export const actions = {

 async FetchAllDrf({commit}) {
  await axios
  .get("/get-all-drf")
  .then(({ data }) => {
    commit("SET_DRF", data);
    console.log("DRFS : ", data);
  })
  .catch(err => console.error("err DRFS", err));
  },
  async getSelectedDrfId( {commit},nDrf) {
    await axios
    .get(`/get-drf-of/${nDrf}`, { params : {nDrf : nDrf} } )
    .then(({ data }) => {
      commit("SET_DRF_BY_ID", data);
      console.log("drf by ID : ", data);
    })
    .catch(err => console.error("err can get drf by ID", err));
  },

  async getSelectedDrf({commit}) {
    await axios
      .get('/get-drf-by-id')
      .then(({ data }) => {
        commit("SET_DRF_BY_ID", data);
        console.log("drf by ID : ", data);
      })
      .catch(err => console.error("err can get drf by ID", err));
  },
}

