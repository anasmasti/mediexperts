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

      <div class="card-body">
          <div class="row">
              <div class="form-group col-lg-3 col-sm-12" style="margin : auto ;">
              <label>E/S</label>
              <input class="form-control" value="" type="text" id="entr_soc" name="montant_entrp_ht" placeholder="Entreprise.." readonly>
              </div>


              <div class="form-group col-lg-3 col-sm-12" style="margin : auto ;">
                <label>RefPdf</label>
                <input class="form-control" value="" type="text" id="ref_pdf" name="ref_pdf" placeholder="RefPdf.." readonly>
              </div>

              <div class="form-group col-lg-3 col-sm-12" style="margin : auto ;">
                <label>N Contrat PF</label>
                <input class="form-control" value="" type="text" id="n_contrat" name="n_contrat" placeholder="N contrat" readonly>
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
                  <tr v-for="user in users" :key="user.id">
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
                        <input type="checkbox" name="model5" id="model5" class="custom-control-input"/>
                        <label for="mod5" class="custom-control-label">Modéle 5</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="fiche_eval_synth" id="fiche_eval_synth" class="custom-control-input"/>
                        <label for="fiche-ev-syn" class="custom-control-label">Fiche d'évaluation synthétique</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="model6" id="model6" class="custom-control-input"/>
                        <label for="mod6" class="custom-control-label">Modéle 6</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="h5">Justifs Règlement</label>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="facture_PF" id="facture_PF" class="custom-control-input"/>
                        <label for="fact" class="custom-control-label">Factures</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="cop-cheq" id="cop-cheq" class="custom-control-input"/>
                        <label for="cop-cheq" class="custom-control-label">Compries cheques / OV / LC</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remise_avis" id="remise_avis" class="custom-control-input"/>
                        <label for="cop-rem" class="custom-control-label">Compries remises / Avis de débit</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="justif_paiem_entrp" id="justif_paiem_entrp" class="custom-control-input"/>
                        <label for="relv-bq-soc" class="custom-control-label">Relevés bq societé</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="justif_paiem_cab" id="justif_paiem_cab" class="custom-control-input"/>
                        <label for="relv-bq-cab" class="custom-control-label">Relevés bq cabinet</label>
                      </div>    
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group col-12"><hr></div>

            <div class="form-group col-lg-3 col-sm-12">
              <label>Date dépot demande de Remboursement</label>
              <input class="form-control" type="text" name="dt_dep_dem_rem" id="dt_dep_dem_rem" onmouseover="(this.type='date')"  placeholder="Date réalisation">
            </div>

            <div class="form-group col-lg-3 col-sm-12" style="margin : auto ;">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="acc_mod6" id="acc_mod6" class="custom-control-input">
                <label for="acc_mod6" class="custom-control-label">Accusé Modele 6</label>
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
                    <tr v-for="user in users" :key="user.id">
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
              <input class="form-control" value="" type="text" id="montant_rmb" name="montant_rmb" placeholder="Montant Remboursement">
          </div>

          <div class="form-group col-lg-3 col-sm-12" style="margin : auto ;">
              <label>Date Remboursement</label>
              <input class="form-control" type="text" name="dt_rem" id="dt_rem" onmouseover="(this.type='date')"  placeholder="Date réalisation">    
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
        <button class="btn bu-add" type="submit" id="add"><i class="fas fa-pen-square icon"></i>Modifier</button>
        <a class="btn bu-danger" href="/drb-gc"><i class="fas fa-window-close icon"></i>Annuler</a>
      </div>
  </div>

  </div>

  

</template>


<script>  

export default {
  name : "Edit" ,
  data() {
        return {
            users: [
                { firstName: 'Frank', lastName: 'Murphy', email: 'frank.murphy@test.com', role: 'User' },
                { firstName: 'Vic', lastName: 'Reynolds', email: 'vic.reynolds@test.com', role: 'Admin' },
                { firstName: 'Gina', lastName: 'Jabowski', email: 'gina.jabowski@test.com', role: 'Admin' },
            ],
            Dare: ''

        };
    },
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