export const actions = {

    async getListOfDROfppt({commit}) {
        await axios.get(`/list-drb-ofppt`)
          .then(res => {
              commit('FETCH_DBR_OFPPT', res.data)
              console.log('test drb ', data )
          }).catch(err => {
          console.log(err)
      });



  },
//   async getListOfDROfpptEdit({commit}, ndrb) {
//     await axios.get(`edit-drb-ofppt/`, { params: { ndrb: ndrb } })
//       .then(res => {
//           commit('FETCH_DBR_OFPPT_Edit', res.data)
//           console.log('test data ', data )
//       }).catch(err => {
//       console.log(err)
//   });

// },
async getListOfDROfpptEdit({ commit }, ndrb) {
    await axios
      .get(`/edit-drb-ofppt/` + ndrb )
      .then(({ data }) => {
        commit("FETCH_DBR_OFPPT_Edit", data);
        console.log("test edited data : ", data);
      })
      .catch(err => console.log(err));
  },
  async ReglEntrpInfo({ commit } , ndrb) {
    await axios
      .get(`/regEntrp-drb-ofppt/` + ndrb)
      .then(({data}) => {
        commit("FETCH_REGL_ENTREPRISE_INFO", data);
        console.log("regl entreprise info", data);
      })
      .catch(err => console.log("cant get reg entrp info", err));
  }
// async updateListOfDROfpptEdit({commit}, ndrb) {
//     await axios.post(`edit-drb-ofppt` , {
//         params: { ndrb: ndrb } ,
//       })
//       .then(res => {
//           commit('FETCH_DBR_OFPPT_Edit', res.data)
//           console.log('test data ', data )
//       }).catch(err => {
//       console.log(err)
//   });

// }
}

/*
let sellerId = 317737

function getSellerAnalyticsTotals() {
    return axios.get(`http://localhost:8000/api/v1/seller/${sellerId}/analytics`);*/
