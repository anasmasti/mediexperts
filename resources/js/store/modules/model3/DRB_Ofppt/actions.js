export const actions = {
    async getListOfDemandeRemboursementOfppt({commit}) {
        await axios.get(`/list-drb-ofppt`)
          .then(res => {
              commit('FETCH_DBR_OFPPT', res.data)
          }).catch(err => {
          console.log(err)
      });
  }
}
