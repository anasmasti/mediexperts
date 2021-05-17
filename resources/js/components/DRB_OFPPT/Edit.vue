<template>

  
  <div>
    <div class="col-sm-12">
      <h1 class="m-0 text-dark">Demande remboursement OFPPT</h1>
    </div><!-- /.col --><br />

    <div class="card card-dark">
      <div class="card-header">
        <h3 class="card-title card-h3">
            Modif. DRB OFPPT >
            <a href="#">
                Test
            </a>
            {{" > "}}
            <a href="#">
                Test
            </a>
        </h3>
      </div>

      <div class="card-body" v-for="DRB_Ofppt in DRB_Ofppts" :key="DRB_Ofppt.n_drf" >
          <div class="row">
              <div class="form-group col-lg-3 col-sm-12" style="margin : auto ;">
              <label>E/S</label>
              <input class="form-control" :value=DRB_Ofppt.raisoci type="text" id="nrc_entrp" name="nrc_entrp" placeholder="Entreprise.." readonly>
              </div>


              <div class="form-group col-lg-3 col-sm-12" style="margin : auto ;">
                <label>RefPdf</label>
                <input class="form-control" :value=DRB_Ofppt.refpdf type="text" id="refpdf" name="refpdf" placeholder="RefPdf.." readonly >
              </div>

              <div class="form-group col-lg-3 col-sm-12" style="margin : auto ;">
                <label>N Contrat PF</label>
                <input class="form-control" :value=DRB_Ofppt.n_contrat type="text" id="n_contrat" name="n_contrat" placeholder="N contrat" readonly>
              </div>

            <div class="form-group col-12"><hr></div>

          <div class="form-group col-12">
            <label>Réglement entreprise</label>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">N°Action</th>
                    <th scope="col">Thème</th>
                    <th scope="col">Total HT(DH)</th>
                    <th scope="col">TVA (20%)</th>
                    <th scope="col">Total TTC</th>
                    <th scope="col">Quote-part Entreprise</th>
                    <th scope="col">N° de  Facture</th>
                    <th scope="col">Date paiement entreprise</th>
                    <th scope="col">Mode et référence de paiement </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">TF</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>1</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="total_reg">
                <label for="txt-total-reg">Total Réglement : </label>
                <input type="text" class="txt-total-reg" id="ttl_regl" name="ttl_regl" readonly>
            </div>

          </div>
          
          <div class="form-group col-12"><hr></div>

          <div class="form-group col-12">
              <div class="container">
                <div class="row">
                  <div class="col-6">
                    <label class="h5">Dossier de remboursement</label>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="model5" :v-model="DRB_Ofppt.model5 == 'préparé' ? model5 = true : model5 = false " :checked="model5 == true ? true : false" id="model5" class="custom-control-input"/>
                        <label for="model5" class="custom-control-label">Modéle 5</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="fiche_eval_sythetique" :v-model="DRB_Ofppt.fiche_eval_sythetique == 'préparé' ? fiche_eval_sythetique = true : model5 = false " :checked="fiche_eval_sythetique == true ? true : false" id="fiche_eval_sythetique" class="custom-control-input"/>
                        <label for="fiche_eval_sythetique" class="custom-control-label">Fiche d'évaluation synthétique</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="model6" :v-model="DRB_Ofppt.model6 == 'préparé' ? model6 = true : model6 = false " :checked="model6 == true ? true : false" id="model6" class="custom-control-input"/>
                        <label for="model6" class="custom-control-label">Modéle 6</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="h5">Justifs Règlement</label>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="factures" :v-model="DRB_Ofppt.factures == 'préparé' ? factures = true : factures = false " :checked="factures == true ? true : false" id="factures" class="custom-control-input"/>
                        <label for="factures" class="custom-control-label">Factures</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="compris_cheques" :v-model="DRB_Ofppt.compris_cheques == 'préparé' ? compris_cheques = true : compris_cheques = false " :checked="compris_cheques == true ? true : false" id="compris_cheques" class="custom-control-input"/>
                        <label for="compris_cheques" class="custom-control-label">Compries cheques / OV / LC</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="compris_remise" :v-model="DRB_Ofppt.compris_remise == 'préparé' ? compris_remise = true : compris_remise = false " :checked="compris_remise == true ? true : false" id="compris_remise" class="custom-control-input"/>
                        <label for="compris_remise" class="custom-control-label">Compries remises / Avis de débit</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="relev_bq_societe" :v-model="DRB_Ofppt.relev_bq_societe == 'préparé' ? relev_bq_societe = true : relev_bq_societe = false " :checked="relev_bq_societe == true ? true : false" id="relev_bq_societe" class="custom-control-input"/>
                        <label for="relev_bq_societe" class="custom-control-label">Relevés bq societé</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="relev_bq_cabinet" :v-model="DRB_Ofppt.relev_bq_cabinet == 'préparé' ? relev_bq_cabinet = true : relev_bq_cabinet = false " :checked="relev_bq_cabinet == true ? true : false" id="relev_bq_cabinet" class="custom-control-input"/>
                        <label for="relev_bq_cabinet" class="custom-control-label">Relevés bq cabinet</label>
                      </div>    
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group col-12"><hr></div>

            <div class="form-group col-lg-3 col-sm-12">
              <label>Date dépot demande de Remboursement</label>
              <input class="form-control" type="text" name="date_depot_dmd_rembrs" id="date_depot_dmd_rembrs" onmouseover="(this.type='date')"  placeholder="Date réalisation">
            </div>

            <div class="form-group col-lg-3 col-sm-12" style="margin : auto ;">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="accuse_model6" id="accuse_model6" class="custom-control-input">
                <label for="accuse_model6" class="custom-control-label">Accusé Modele 6</label>
              </div>
            </div>

          <div class="form-group col-12"><hr></div>

            <div class="form-group col-12">
              <label>Remboursement OFPPT</label>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">N°Action</th>
                      <th scope="col">Thème</th>
                      <th scope="col">Total HT(DH)</th>
                      <th scope="col">Quote-part OFPPT</th>
                      <th scope="col">Remboursement OFPPT</th>
                      <th scope="col">Ecart/ Remboursement</th>
                      <th scope="col">Justifs Ecart</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr >
                      <th scope="row">TF</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                      <td>1</td>
                      <td>Mark</td>
                      <td>Otto</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          <div class="form-group col-12"><hr></div>

          <div class="form-group col-lg-3 col-sm-12" style="margin : auto ;">
              <label>Montant de Remboursement</label>
              <input class="form-control" value="" type="text" id="montant_rembrs" name="montant_rembrs" placeholder="Montant Remboursement">
          </div>

          <div class="form-group col-lg-3 col-sm-12" style="margin : auto ;">
              <label>Date Remboursement</label>
              <input class="form-control" type="text" name="date_rembrs" id="date_rembrs" onmouseover="(this.type='date')"  placeholder="Date réalisation">    
          </div>

          <div class="form-group col-12 text-center" style="margin-top: 2rem ;">
              <h4>État demande</h4>
              <div class="btn-group btn-group-toggle btn-Etat" data-toggle="buttons">
                  <label class="btn btn-warning">
                    Initié
                    <i class="fas fa-battery-quarter"></i>
                    <input type="radio" name="etat" id="option1" autocomplete="off" value="initié">
                  </label>
                  <label class="btn btn-warning">
                    Payé
                    <i class="fas fa-dollar-sign"></i>
                    <input type="radio" name="etat" id="option2" autocomplete="off" value="payé" >
                  </label>
                  <label class="btn btn-warning">
                    Instruction dossier
                    <i class="fas fa-hourglass-half"></i>
                    <input type="radio" name="etat" id="option2" autocomplete="off" value="instruction dossier">
                  </label>
                  <label class="btn btn-warning">
                    Déposé
                    <i class="fas fa-folder-open"></i>
                    <input type="radio" name="etat" id="option2" autocomplete="off" value="déposé" >
                  </label>
                  <label class="btn btn-warning">
                    Remboursé
                    <i class="fas fa-check-double"></i>
                    <input type="radio" name="etat" id="option3" autocomplete="off" value="remboursé">
                  </label>
              </div>
          </div>

          <div class="form-group col-12"><hr></div>

          <div class="form-group col-12">
            <label>Commentaire</label>
            <textarea class="form-control" type="text" rows="4" name="commentaire" maxlength="1900" placeholder="Commentaire .."></textarea>
          </div>

          
        </div>
      </div>

      

      <div class="form-group col-12"><hr></div>

      <div class="card-footer text-center">
        <button class="btn bu-add" type="submit" id="add" @click="updateDRB()"><i class="fas fa-pen-square icon"></i>Modifier</button>
        <a class="btn bu-danger" href="/drb-gc"><i class="fas fa-window-close icon"></i>Annuler</a>
      </div>
  </div>

  </div>

  

</template>


<script>  
import { mapState } from 'vuex';
export default {
  
  name : "Edit" ,
  data() {
        return {
            numero_remb: [],
            // DRB_Ofppts: {},
            edited_DRB: [],
            model5:null,
            model6:null,
            fiche_eval_sythetique:null,
            factures:null,
            compris_cheques:null,
            compris_remise:null,
            relev_bq_societe:null,
            relev_bq_cabinet:null,
            accuse_model6:null
        };
    },
  mounted() {
    this.numero_remb = JSON.parse(localStorage.getItem("n_drf"));
     this.getListOfDROfpptEditByNumeroRemb(this.numero_remb)
     },
  methods:{
    clearLS(){
      localStorage.clear();
    },

    getListOfDROfpptEditByNumeroRemb(numero_remb) {
      this.$store.dispatch('DRB_Ofppt/getListOfDROfpptEdit', numero_remb )
    },
    updateDRB(){
      let model5= this.model5;
      let model6= this.model6;
      let fiche_eval_sythetique= this.fiche_eval_sythetique;
      let factures= this.factures;
      let compris_cheques= this.compris_cheques;
      let compris_remise= this.compris_remise;
      let relev_bq_societe= this.relev_bq_societe;
      let relev_bq_cabinet= this.relev_bq_cabinet;
      let accuse_model6= this.accuse_model6;
      let montant_rembrs= document.getElementById('montant_rembrs');
      let date_depot_dmd_rembrs= document.getElementById('date_depot_dmd_rembrs');
      let date_rembrs= document.getElementById('date_rembrs');
      let etat= $("input:radio[name=etat]:checked").val()
      axios.post('/edit-drb-ofppt/'+this.numero_remb, {
            model6: model6,
            model5: model5,
            fiche_eval_sythetique: fiche_eval_sythetique,
            factures: factures,
            compris_cheques: compris_cheques,
            compris_remise: compris_remise,
            relev_bq_societe: relev_bq_societe,
            relev_bq_cabinet: relev_bq_cabinet,
            ccuse_model6: accuse_model6,
            montant_rembrs: montant_rembrs.value,
            date_depot_dmd_rembrs: date_depot_dmd_rembrs.value,
            date_rembrs: date_rembrs.value,
            etat: etat
           })
       .then(() => {
          this.$toastr.s('Modifié avec succès')
        })
        .catch( (e) => {
          this.$toastr.e("Echec de modification")
          throw e
        });
    }
  },
   computed: {
       ...mapState ("DRB_Ofppt", {
            DRB_Ofppts: state => state.DRB_OfpptEdit,
           // ndrf: state => state.ndrf,

       }),
      //  ...mapActions ("DRB_Ofppt", {

      //    getListOfDROfpptEdit: 'getListOfDROfpptEdit'

      //   })
   }
}
</script>

<style scoped>
  table{
    margin: 10px auto;
  }

  td,th{
    text-align: center;
    
  }

  .total_reg{
    margin: 10px auto; 
    float: right;
  }

  .btn-Etat{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
  }

</style>