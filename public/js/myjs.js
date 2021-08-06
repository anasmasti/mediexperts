//const {Alert} = require("bootstrap");

// ALLOW ONLY NUMBERS
function isNumberKey(evt) {
    let charCode = (evt.which) ? evt.which : event.keyCode
        // console.log("charCode : ", charCode);
    if (charCode > 31 && (charCode < 43 || charCode > 57))
        return false;

    return true;
}

function CalcQuotePart() {
    console.log(document.getElementById("prc_cote_part").value);
    let prcQuote = document.getElementById("prc_cote_part");
    let quoteInput = document.getElementById("cote_part_entrp");
    let bdgInput = document.getElementById("bdg_accord");

    if (prcQuote.value == "30%" && $('quoteInput').is('[readonly]') == false) {
        quoteInput.value = ((bdgInput.value * 30 / 100) + (bdgInput.value * 20 / 100)).toFixed(2);
        quoteInput.readOnly = true;
    } else if (prcQuote.value == "20%") {
        quoteInput.value = ((bdgInput.value * 20 / 100) + (bdgInput.value * 20 / 100)).toFixed(2);
        quoteInput.readOnly = true;
    }
}

function CalcBdgAccordTTC() {
    let bdgAccordVal = parseInt(document.getElementById('bdg_accord').value);
    let bdgLetter = document.getElementById('bdg_letter');
    let montantTTC = (bdgAccordVal + (bdgAccordVal * .2));
    bdgLetter.value = NumberToLetter(montantTTC.toFixed(2)).toUpperCase();
    //console.log(`${bdgAccordVal} + (${bdgAccordVal} * .2) = `, montantTTC);
}

//CHECK DATE
function checkDate() {
    let inputedDate = document.getElementById("date-more").value;
    let currentDate = new Date();

    if (new Date(inputedDate).getTime() >= currentDate.getTime()) {
        alert("La date doit être inférieur à la date d'aujourd'hui");
        document.getElementById("date-more").value = currentDate.getTime();
    }
}
function CalcBdgJourn() {
    let bdgLetter = document.getElementById("bdg_letter");
    let bdgTotal = document.getElementById("bdg_total");
    let bdgJour = document.getElementById("bdg_jour");
    let nbJour = document.getElementById("nb_jour");
    let nbHeure = document.getElementById("nb_heure");
    let nb_dates = document.getElementById("nb_dates");
    setTimeout(() => {
    //   bdgTotal.value = (((nbHeure.value * nbJour.value) / 6) * bdgJour.value).toFixed(2);
    //   bdgLetter.value = NumberToLetter(((bdgJour.value * nbJour.value) + bdgTotal.value * .2).toFixed(2), "DIRHAM", "Centimes").toUpperCase();
    bdgTotal.value = (((nbHeure.value * nb_dates.value) / 6) * bdgJour.value).toFixed(2);
    bdgLetter.value = NumberToLetter((( Number(bdgTotal.value) * 0.2 ) + Number(bdgTotal.value) ), "DIRHAM", "Centimes").toUpperCase();


    }, 1000);

}

function DateFormat(date) {
    let datestring = date.replace(/[^\w\s]/gi, '');
    let year = datestring.charAt(0) + datestring.charAt(1) + datestring.charAt(2) + datestring.charAt(3);
    let month = datestring.charAt(4) + datestring.charAt(5);
    let day = datestring.charAt(6) + datestring.charAt(7);
    return (day + '/' + month + '/' + year);
}

function NbHeurValidation (){
  let nbHeur = document.getElementById("nb_heure");
  let nbDates = document.getElementById("nb_dates");

  if (nbHeur.value == 0){
    nbDates.disabled = true;
    document.getElementById("nb_dates_msg").innerHTML ='<p><i class="fas fa-info-circle"></i> Remplir Nombre Heures Premièrement </p>'
    setTimeout(() => {
      document.getElementById("nb_dates_msg").innerHTML =''
    }, 5000);
  }
  else if (nbHeur.value != 0){
    nbDates.disabled = false;
  }
}
function CalcNbJour() {

  let NbHeurs = document.getElementById("nb_heure");
  let NbDates = document.getElementById("nb_dates");
  let nbJour = document.getElementById("nb_jour");

  nbJour.value = ((NbHeurs.value * NbDates.value)/ 6);
  nbjour = parseFloat(nbJour.value);

  if (Number.isInteger(nbjour)){
    document.getElementById("nb_dates_msg").innerHTML ='<p class="text-success"><i class="fas fa-check-circle"></i> Nombre Dates valide </p>'
    setTimeout(() => {
      document.getElementById("nb_dates_msg").innerHTML =''
    }, 5000);
  }
  else{
    document.getElementById("nb_dates_msg").innerHTML ='<p><i class="fas fa-info-circle"></i> Nombre Dates est Invalide </p>'
    setTimeout(() => {
      document.getElementById("nb_dates_msg").innerHTML =''
    }, 5000);
  }
}

function ValidationNbDatesIfSameDates() {

  let hasSameDates = document.getElementById("same_dates")
  let nbDates = document.getElementById("nb_dates")
  let nbGrp = document.getElementById("nb_grp")

  if (hasSameDates.checked == true && nbDates.value % nbGrp.value != 0 ) {

    document.getElementById("sameDateError").innerHTML = '<p><i class="fas fa-info-circle"></i> Nombre dates est invalide pour les groupes ayant même dates</p>'
    hasSameDates.checked = false

  }else {
    document.getElementById("sameDateError").innerHTML = '<p class="text-success"><i class="fas fa-check-circle"></i> Nombre dates valide pour les groupes ayant même dates</p>'

    setTimeout(() => {
      document.getElementById("sameDateError").innerHTML = ''
    }, 5000);
  }
}


//***************************************************************************************************/
//***************************************************************************************************/
//***************************************************************************************************/
//***************************************************************************************************/
//***************************************************************************************************/
//                  ******      *******
//                  **    **    **
//                  **     **   ******
//                  *     **    **
//                  ******      **
//***************************************************************************************************/
//***************************************************************************************************/
//***************************************************************************************************/
//***************************************************************************************************/
//***************************************************************************************************/

function checkEtat() {
    let typeMiss = document.getElementById("type_miss").value.toLowerCase();
    let gcRattach = document.getElementById("gc_rattach").value.toLowerCase();
    //console.log("check etat changes");
    //---------------------------------------------------------------------------------------------------------------------------------------
    //--- IF
    if (typeMiss == "ingénierie de formation") {
        //*** SHOW IF ***
        //with radio
        $('#tr_f_etude_IF').fadeIn(200);
        $('#tr_l_tierpay_IF').fadeIn(200);
        $('#tr_d_fact_proforama_if').fadeIn(200);
        $('#tr_d_propal_IF').fadeIn(200);
        $('#tr_ct_IF').fadeIn(200);
        //giac agroalimentaire
        // if (gcRattach.toLowerCase() == "giac agroalimentaire") {
        //     $('#tr_d_df_IF').fadeIn(200);
        //     $('label[for=dem_approb_if], input#dem_approb_if').fadeIn(200);
        // } else {
        //     $('#tr_d_df_IF').fadeOut(200);
        //     $('label[for=dem_approb_if], input#dem_approb_if').fadeOut(200);
        // }
        //with check
        $('label[for=av_realis_IF], input#av_realis_IF').fadeIn(200);
        $('label[for=planing_IF], input#planing_IF').fadeIn(200);
        $('label[for=p_garde_IF], input#p_garde_IF').fadeIn(200);
        $('label[for=model_1], input#model_1').fadeIn(200);
        $('label[for=f2], input#f2').fadeIn(200);
        // input text
        $('label[for=bdg_pf], input#bdg_pf').fadeIn(200);
        //--------------------------------------------------------
        //*** HIDE DS ***
        //with radio
        $('#tr_f_etude_DS').fadeOut(200);
        $('#tr_l_tierpay_DS').fadeOut(200);
        $('#tr_d_fact_proforama_ds').fadeOut(200);
        $('#tr_d_propal_DS').fadeOut(200);
        $('#tr_ct_DS').fadeOut(200);

        //with check
        $('label[for=av_realis_DS], input#av_realis_DS').fadeOut(200);
        $('label[for=planing_DS], input#planing_DS').fadeOut(200);
        $('label[for=p_garde_DS], input#p_garde_DS').fadeOut(200);

        //giac 1
        if (gcRattach == "giac 1") {
            $('#tr_d_df_IF').stop().fadeIn(200);
            $('#tr_d_df_DS').stop().fadeOut(200);
            $('label[for=dem_approb_if], input#dem_approb_if').fadeOut(200);
            $('label[for=dem_approb_ds], input#dem_approb_ds').fadeOut(200);
        }
        //giac agroalimentaire
        else if (gcRattach.toLowerCase() == "giac agroalimentaire") {
            $('#tr_d_df_IF').fadeIn(200);
            $('label[for=dem_approb_if], input#dem_approb_if').fadeIn(200);
            $('#tr_d_df_DS').fadeOut(200);
            $('label[for=dem_approb_ds], input#dem_approb_ds').fadeOut(200);
        } else {
            $('#tr_d_df_DS').fadeOut(200);
            $('label[for=dem_approb_ds], input#dem_approb_ds').fadeOut(200);
            $('#tr_d_df_IF').fadeOut(200);
            $('label[for=dem_approb_if], input#dem_approb_if').fadeOut(200);
        }


    } //********************** END FOR IF ************************************************************************************************************

    //---------------------------------------------------------------------------------------------------------------------------------------
    //--- DS
    else if (typeMiss == "diagnostic stratégique") {
        //*** SHOW DS ***
        //with radio
        $('#tr_f_etude_DS').fadeIn(200);
        $('#tr_l_tierpay_DS').fadeIn(200);
        $('#tr_d_fact_proforama_ds').fadeIn(200);
        $('#tr_d_propal_DS').fadeIn(200);
        $('#tr_ct_DS').fadeIn(200);
        //with check
        $('label[for=av_realis_DS], input#av_realis_DS').fadeIn(200);
        $('label[for=planing_DS], input#planing_DS').fadeIn(200);
        $('label[for=p_garde_DS], input#p_garde_DS').fadeIn(200);
        // input text
        $('label[for=bdg_pf], input#bdg_pf').fadeOut(200);
        //--------------------------------------------------------
        //*** HIDE IF ***
        //with radio
        $('#tr_f_etude_IF').fadeOut(200);
        $('#tr_l_tierpay_IF').fadeOut(200);
        $('#tr_d_fact_proforama_if').fadeOut(200);
        $('#tr_d_propal_IF').fadeOut(200);
        $('#tr_ct_IF').fadeOut(200);
        $('label[for=model_1], input#model_1').fadeOut(200);
        $('label[for=f2], input#f2').fadeOut(200);
        //with check
        $('label[for=av_realis_IF], input#av_realis_IF').fadeOut(200);
        $('label[for=planing_IF], input#planing_IF').fadeOut(200);
        $('label[for=p_garde_IF], input#p_garde_IF').fadeOut(200);

        // giac 1
        if (gcRattach.toString() == "giac 1") {
            $('#tr_d_df_DS').stop().fadeIn(200);
            $('#tr_d_df_IF').stop().fadeOut(200);
            $('label[for=dem_approb_if], input#dem_approb_if').fadeOut(200);
            $('label[for=dem_approb_ds], input#dem_approb_ds').fadeOut(200);
        }
        //giac agroalimentaire
        else if (gcRattach.toLowerCase() == "giac agroalimentaire") {
            $('#tr_d_df_DS').fadeIn(200);
            $('label[for=dem_approb_ds], input#dem_approb_ds').fadeIn(200);
            $('#tr_d_df_IF').fadeOut(200);
            $('label[for=dem_approb_if], input#dem_approb_if').fadeOut(200);
        } else {
            $('#tr_d_df_DS').fadeOut(200);
            $('label[for=dem_approb_ds], input#dem_approb_ds').fadeOut(200);
            $('#tr_d_df_IF').fadeOut(200);
            $('label[for=dem_approb_if], input#dem_approb_if').fadeOut(200);
        }
    }

}


//::::::::::::::::::::::::::::::::::::: Demande financement ::::::::::::::::::::::::::::::::::::::::::::
// check etat
function AccordValidate() {

    let etatAccord = document.getElementById("option4");
    let etatRealise = document.getElementById("option5");
    let etatApprouve = document.getElementById("option6");

    let dateAccord = document.getElementById("dt_accord").value;
    let bdgAccord = document.getElementById("bdg_accord").value;
    let prcCotePart = document.getElementById("prc_cote_part").value;
    let JourHomeValid = document.getElementById("jr_hm_valid").value;

    let realiseBtn = document.getElementsByName("etat");
    let btnEtat = document.getElementsByName("btnEtat");

    if ((etatAccord.checked == true || etatRealise.checked == true || etatApprouve.checked == true) &&
        (dateAccord == '' || bdgAccord == '' || prcCotePart == '' || JourHomeValid == '')) {

        // Remove active class from all valisation buttons
        for (let i = 0; i < btnEtat.length; i++) {
            setTimeout(() => {
                btnEtat[i].classList.remove("active");
                btnEtat[i].classList.remove("btn-success");
                btnEtat[i].classList.add("btn-warning");
            }, 100);

        }

        // Uncheck all request status button
        for (var i = 0; i < realiseBtn.length; i++) {
            realiseBtn[i].checked = false;
        }

        // Show model with error message
        $("#msg_error_accord").modal("show");
    }
}


//****************************************************************************************/
//****************************************************************************************/
//****************************************************************************************/
//****************************************************************************************/
//                  *****     ******    *****
//                  **    *   ***   *   **   *
//                  **    *   *****     ****
//                  **    *   **   *    **    *
//                  *****     *     *   *****
//****************************************************************************************/
//****************************************************************************************/
//****************************************************************************************/
//****************************************************************************************/

function checkEtatRb() {
    let giac = document.getElementById('giac').value.toLowerCase();
    let typemiss = document.getElementById('typemiss').value.toLowerCase();

    if (giac == "giac tertiaire" && typemiss == "diagnostic stratégique") {
        $('label[for=drb_if], input#drb_if').fadeOut(200);
        $('label[for=drb_ds], input#drb_ds').fadeIn(200);
    } else if (giac == "giac tertiaire" && typemiss == "ingénierie de formation") {
        $('label[for=drb_if], input#drb_if').fadeIn(200);
        $('label[for=drb_ds], input#drb_ds').fadeOut(200);
    } else {
        $('label[for=drb_if], input#drb_if').fadeOut(200);
        $('label[for=drb_ds], input#drb_ds').fadeOut(200);
    }
}






































































// foreach in JS
// etat1.forEach(element => {
//     if (document.getElementById(element).value != "") {
//     }
// });
//OLD METHOD
// for (i = 0; i < etat1.length; i++) {
//     if (document.getElementById(etat1[i]).value != "") {
//         et = et + 1;
//     }
// }
// for (j = 0; j < etat1_doc.length + 1; j++) {
//     if (document.getElementById(etat1_doc[j]).checked == true) {
//         et_d = et_d + 1;
//     }
//OLD METHOD
