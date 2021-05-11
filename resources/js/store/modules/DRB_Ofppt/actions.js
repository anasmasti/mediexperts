export const actions = {

    async getListOfDROfppt({commit}) {
        await axios.get(`/list-drb-ofppt`)
          .then(res => {
              commit('FETCH_DBR_OFPPT', res.data)
              console.log('test drb ', data )
          }).catch(err => {
          console.log(err)
      });

  }

}
