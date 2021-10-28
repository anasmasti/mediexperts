export const getters = {

  newDates: state => {
    let initInfo, newInfo, dates, result
    
    initInfo = newInfo = dates = []

    initInfo = state.Info_AvisModif
    newInfo = state.NewAvisModif

    for (let i = 0; i < initInfo.length; i++) {
      if (newInfo.length != 0) {
        for (let j = 0; j < newInfo.length; j++) {
          result = initInfo[i].id_form == newInfo[j].id_form;
          if (result) dates = newInfo
          if (!result) dates = [initInfo[i], newInfo[j]]
        }
      }
      if (newInfo.length == 0) dates = initInfo;
    }
    return dates[0]
  },

  // newDates: state => {
  //   let initInfo, newInfo, dates, result
    
  //   initInfo = newInfo = dates = []

  //   initInfo = state.Info_AvisModif
  //   newInfo = state.NewAvisModif

  //   for (let i = 0; i < initInfo.length; i++) {
  //     if (newInfo.length != 0) {
  //       for (let j = 0; j < newInfo.length; j++) {
  //         result = initInfo[i].id_form == newInfo[j].id_form;
  //         if (result) dates = newInfo
  //         if (!result) dates = [initInfo[i], newInfo[j]]
  //       }
  //     }
  //     if (newInfo.length == 0) dates = initInfo;
  //   }
  //   console.log('---', dates);
  //   return dates
  // },

  GetNbTotalBenif: state => {
    let initialInfo = [], sum = 0, item

    initialInfo = state.Info_AvisModif

    for (item in initialInfo) {
      sum += parseFloat(initialInfo[item].nb_benif);
    }

    return sum;
  },

  // getOnlyDates: state => {
  //   let initInfo = [], newInfo = [],  myDates = [], result

  //   initInfo = state.Info_AvisModif
  //   newInfo = state.NewAvisModif

  //   for (let i = 0; i < initInfo.length; i++) {

  //     initInfo[i] = [
  //        initInfo[i].date1,
  //        initInfo[i].date2,
  //        initInfo[i].date3,
  //        initInfo[i].date4,
  //        initInfo[i].date5,
  //        initInfo[i].date6,
  //        initInfo[i].date7,
  //        initInfo[i].date8,
  //        initInfo[i].date9,
  //        initInfo[i].date10,
  //       ];


  //     myDates.push(initInfo[i])


  //   }

  //   for (let j = 0; j < myDates.length; j++) {

  //     result = JSON.stringify(myDates[j]) == JSON.stringify(myDates[j+1])

  //     if ( result ) return myDates[0]

  //     console.log('-------',  myDates );

  //     return myDates[j]

  //   }


  // }

}
