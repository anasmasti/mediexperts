export const getters = {

  initialDates: state => {

  let initInfo = [], oldInfo = [], result, dates = []

  initInfo = state.Info_AvisModif
  oldInfo = state.Old_AvisModif

  for (let i = 0; i < initInfo.length; i++) {
      if ( oldInfo.length != 0 ) {
          for (let j = 0; j < oldInfo.length; j++) {
              result = initInfo[i].id_form != oldInfo[j].id_form;
              console.log("result" , result);
              if (!result) {
                dates = oldInfo
              }
              else if (result) {
                dates = [initInfo[i], oldInfo[j]]
              }
          }
      }
    }
    return dates
  },

  GetNbTotalBenif: state => {
    let initialInfo = [] , total_benif , sum = 0 , item

    initialInfo = state.Info_AvisModif

      for(item in initialInfo)
      {
        sum += parseFloat(initialInfo[item].nb_benif);

      }

      return sum;
  }

}
