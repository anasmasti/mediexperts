export const getters = {

  initialDates: state => {

    let initInfo = [], oldInfo = [], dates = [], result

    initInfo = state.Info_AvisModif
    oldInfo = state.Old_AvisModif

    for (let i = 0; i < initInfo.length; i++) {
      if (oldInfo.length != 0) {
        for (let j = 0; j < oldInfo.length; j++) {
          result = initInfo[i].id_form == oldInfo[j].id_form;
          if (result) dates = oldInfo
          if (!result) dates = [initInfo[i], oldInfo[j]]
        }
      }
      if (oldInfo.length == 0) dates = initInfo;
    }
    return dates
  },

  GetNbTotalBenif: state => {
    let initialInfo = [], sum = 0, item

    initialInfo = state.Info_AvisModif

    for (item in initialInfo) {
      sum += parseFloat(initialInfo[item].nb_benif);

    }

    return sum;
  },

  // getOnlyDates: state => {
  //   let initInfo = [], oldInfo = [],  myDates = [], result

  //   initInfo = state.Info_AvisModif
  //   oldInfo = state.Old_AvisModif

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
