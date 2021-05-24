<template>
  <div>
    <div class="col-sm-12">
      <h1 class="m-0 text-dark">Demande remboursement OFPPT</h1>
    </div>
    <!-- /.col --><br />

    <div class="card card-dark" v-for="DRB_Ofppt in DRB_Ofppts"
        :key="DRB_Ofppt.n_drf">
      <div class="card-header">
        <h3 class="card-title card-h3">
          Modif. DRB OFPPT
          {{ " > " }}
          <a href="/list-drb">
            List Demande remboursement OFPPT
          </a>
          {{ " > " }}
          <a href="/detail-drb-ofppt">
            {{ DRB_Ofppt.raisoci }}
          </a>
        </h3>
      </div>

      <div
        class="card-body"
      >
        <div class="row">
          <div class="form-group col-lg-3 col-sm-12">
            <label>E/S</label>
            <input
              class="form-control"
              :value="DRB_Ofppt.raisoci"
              type="text"
              id="nrc_entrp"
              name="nrc_entrp"
              placeholder="Entreprise.."
              readonly
            />
          </div>

          <div class="form-group col-lg-3 col-sm-12" style="margin : auto ;">
            <label>RefPdf</label>
            <input
              class="form-control"
              :value="DRB_Ofppt.refpdf"
              type="text"
              id="refpdf"
              name="refpdf"
              placeholder="RefPdf.."
              readonly
            />
          </div>

          <div class="form-group col-lg-3 col-sm-12" style="margin : auto ;">
            <label>N Contrat PF</label>
            <input
              class="form-control"
              :value="DRB_Ofppt.n_contrat"
              type="text"
              id="n_contrat"
              name="n_contrat"
              placeholder="N contrat"
              readonly
            />
          </div>

          <div class="form-group col-12"><hr /></div>

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
                    <th scope="col">N° de Facture</th>
                    <th scope="col">Date paiement entreprise</th>
                    <th scope="col">Mode et référence de paiement</th>
                  </tr>
                </thead>
                <tbody v-for="(info, index) in reglEntreprise" :key="index">
                  <tr>
                    <th>{{ info.n_action }}</th>
                    <td>{{ info.nom_theme }}</td>
                    <td>{{ info.bdg_total }}</td>
                    <td>{{ info.bdg_total * 0.2 }}</td>
                    <td>{{ info.bdg_total + info.bdg_total * 0.2 }}</td>
                    <td>{{ info.bdg_total * 0.3 + info.bdg_total * 0.2 }}</td>
                    <td>{{ info.n_facture }}</td>
                    <td>
                      <input
                        :id="'DP:' + info.id_thm"
                        :name="'DP:' + info.id_thm"
                        type="date"
                        v-model="date_paiement[index]"
                      />
                    </td>
                    <td>
                      <input
                        :id="'MDP:' + info.id_thm"
                        :name="'MDP:' + info.id_thm"
                        type="text"
                        v-model="ModeReferencePaiement[index]"
                      />
                    </td>
                  </tr>
                </tbody>
              </table>
              <div
                class="form-group col-lg-12 col-sm-12 custom-control custom-checkbox"
              >
                <div class="div_select_all">
                  <input
                    type="checkbox"
                    name="select_all"
                    id="select_all"
                    class="custom-control-input"
                     v-model="select_all_ch"
                    @change="select_all()"
                  />
                  <label for="select_all" class="custom-control-label "
                    >selectionner tout</label
                  >
                </div>
              </div>
            </div>

            <div class="total_reg">
              <label for="txt-total-reg">Total Réglement : </label>
              <input
                type="text"
                class="txt-total-reg"
                id="ttl_regl"
                name="ttl_regl"
                readonly
                :value="total_regl"
              />
            </div>
          </div>

          <div class="form-group col-12"><hr /></div>

          <div class="form-group col-12">
            <div class="container">
              <div class="row">
                <div class="col-6">
                  <label class="h5">Dossier de remboursement</label>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        name="model5"
                        v-model="model5"
                        id="model5"
                        class="custom-control-input"
                      />
                      <label for="model5" class="custom-control-label"
                        >Modéle 5</label
                      >
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        name="fiche_eval_sythetique"
                        v-model="fiche_eval_sythetique"
                        id="fiche_eval_sythetique"
                        class="custom-control-input"
                      />
                      <label
                        for="fiche_eval_sythetique"
                        class="custom-control-label"
                        >Fiche d'évaluation synthétique</label
                      >
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        name="model6"
                        v-model="model6"
                        id="model6"
                        class="custom-control-input"
                      />
                      <label for="model6" class="custom-control-label"
                        >Modéle 6</label
                      >
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <label class="h5">Justifs Règlement</label>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        name="factures"
                        v-model="factures"
                        id="factures"
                        class="custom-control-input"
                      />
                      <label for="factures" class="custom-control-label"
                        >Factures</label
                      >
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        name="compris_cheques"
                        v-model="compris_cheques"
                        id="compris_cheques"
                        class="custom-control-input"
                      />
                      <label for="compris_cheques" class="custom-control-label"
                        >Compries cheques / OV / LC</label
                      >
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        name="compris_remise"
                        v-model="compris_remise"
                        id="compris_remise"
                        class="custom-control-input"
                      />
                      <label for="compris_remise" class="custom-control-label"
                        >Compries remises / Avis de débit</label
                      >
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        name="relev_bq_societe"
                        v-model="relev_bq_societe"
                        id="relev_bq_societe"
                        class="custom-control-input"
                      />
                      <label for="relev_bq_societe" class="custom-control-label"
                        >Relevés bq societé</label
                      >
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        name="relev_bq_cabinet"
                        v-model="relev_bq_cabinet"
                        id="relev_bq_cabinet"
                        class="custom-control-input"
                      />
                      <label for="relev_bq_cabinet" class="custom-control-label"
                        >Relevés bq cabinet</label
                      >
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>

          <div class="form-group col-12"><hr /></div>

            <div
              class="form-group col-lg-12 col-sm-12 display_div"
              style="display: flex ;flex-direction : 'row' ;"
            >
              <div class="form-group col-lg-6 col-sm-12 display_div1">
                
                <div class="form-group col-lg-6 col-sm-12" style="margin : 2em 2em 2em 0 ;">
                  <label>Date Remboursement</label>
                  <input
                    class="form-control"
                    type="text"
                    name="date_rembrs"
                    id="date_rembrs"
                    onmouseover="(this.type='date')"
                    placeholder="Date réalisation"
                    v-model="date_rembrs"
                    @change="DateValidation()"
                  />
                </div>
                <div
                      class="form-group col-lg-6 col-sm-12 custom-control custom-checkbox"
                      style="margin: auto 1rem ;"
                    >
                      <input
                        type="checkbox"
                        name="accuse_model6"
                        id="accuse_model6"
                        class="custom-control-input"
                        v-model="accuse_model6"
                      />
                      <label for="accuse_model6" class="custom-control-label "
                        >Accusé Modele 6</label
                      >
                    </div>
              </div>

              <div class="form-group col-lg-6 col-sm-12 display_div_child">
                <div
                  class="form-group col-lg-6 col-sm-12"
                  style="margin : 2em 2em 2em 0 ;"
                >
                  <label>Montant de Remboursement</label>
                  <input
                    class="form-control"
                    type="text"
                    id="montant_rembrs"
                    name="montant_rembrs"
                    placeholder="Montant Remboursement"
                    v-model="montant_rembrs"
                  />
                </div>

                 <div
                  class="form-group col-lg-6 col-sm-12 "
                >
                  <label>Date dépot demande de Remboursement</label>
                  <input
                    class="form-control"
                    type="text"
                    name="date_depot_dmd_rembrs"
                    id="date_depot_dmd_rembrs"
                    onmouseover="(this.type='date')"
                    placeholder="Date réalisation"
                    v-model="date_depot_dmd_rembrs"
                    @change="DateValidation()"
                  />
                </div>

              </div>
            </div>

            

            <div class="form-group col-12"><hr /></div>

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
                    <tr v-for="(info, index) in reglEntreprise" :key="index">
                      <th>{{ info.n_action }}</th>
                      <td>{{ info.nom_theme }}</td>
                      <td>{{ info.bdg_total }}</td>
                      <td>{{ (info.bdg_total * 0.7).toFixed(2) }}</td>
                      <td>
                        <input
                          type="text"
                          name="'RMBOFPPT:'+info.id_thm"
                          :id="'RMBOFPPT:' + info.id_thm"
                          v-model="rmb_ofppt[index]"
                        />
                      </td>
                      <!-- <td><label :id="`EcartOFPPT:${info.id_thm}`" :name="`EcartOFPPT:${info.id_thm}`" :v-model="test">{{((info.bdg_total * (70/100)) - rmb_ofppt[index]).toFixed(2)}}</label></td> -->
                      <td>
                        <input
                          class="EcartOFPPT"
                          :id="`EcartOFPPT:${info.id_thm}`"
                          :name="`EcartOFPPT:${info.id_thm}`"
                          :value="
                            (
                              info.bdg_total * (70 / 100) -
                              rmb_ofppt[index]
                            ).toFixed(2) == 'NaN'
                              ? '0'
                              : (
                                  info.bdg_total * (70 / 100) -
                                  rmb_ofppt[index]
                                ).toFixed(2)
                          "
                          disabled
                        />
                      </td>
                      <td>
                        <input
                          type="text"
                          :name="'justifEcart:' + info.id_thm"
                          :id="'justifEcart:' + info.id_thm"
                           v-model="JustifsEcart[index]"
                        />
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="form-group col-12"><hr /></div>

              <div
                class="form-group col-lg-12 col-sm-12"
                style="display : flex ; flex-direction: row ;"
              ></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group col-12 text-center" style="margin-top: 2rem ;">
      <label>{{ etat }}</label>
      <h4>État demande</h4>
      <div class="btn-group btn-group-toggle btn-checked btn-Etat" role="group">
        <label id="opt1" class="btn btn-warning" for="option1">
          Initié
          <i class="fas fa-battery-quarter"></i>
          <input
            type="radio"
            name="etat"
            id="option1"
            autocomplete="off"
            value="initié"
            v-model="etat"
            @click="checkEtat()"
          />
        </label>

        <label id="opt2" class="btn btn-warning" for="option2">
          Payé
          <i class="fas fa-dollar-sign"></i>
          <input
            type="radio"
            name="etat"
            id="option2"
            autocomplete="off"
            value="payé"
            v-model="etat"
            @click="checkEtat()"
          />
        </label>
        <label id="opt3" class="btn btn-warning" for="option3">
          Instruction dossier
          <i class="fas fa-hourglass-half"></i>
          <input
            type="radio"
            name="etat"
            id="option3"
            autocomplete="off"
            value="instruction dossier"
            v-model="etat"
            @click="checkEtat()"
          />
        </label>
        <label id="opt4" class="btn btn-warning" for="option4">
          Déposé
          <i class="fas fa-folder-open"></i>
          <input
            type="radio"
            name="etat"
            id="option4"
            autocomplete="off"
            value="déposé"
            v-model="etat"
            @click="checkEtat()"
          />
        </label>
        <label id="opt5" class="btn btn-warning" for="option5">
          Remboursé
          <i class="fas fa-check-double"></i>
          <input
            type="radio"
            name="etat"
            id="option5"
            autocomplete="off"
            value="remboursé"
            v-model="etat"
            @click="checkEtat()"
          />
        </label>
      </div>
    </div>

    <div class="form-group col-12"><hr /></div>
    <div class="form-group col-12">
      <label>Commentaire</label>
      <textarea
        class="form-control"
        type="text"
        rows="4"
        name="commentaire"
        maxlength="1900"
        placeholder="Commentaire .."
        v-model="comment"
      >
      </textarea>
    </div>
    <div class="card-footer text-center">
      <a
        href="/detail-drb-ofppt"
        class="btn bu-add"
        type="submit"
        id="add"
        @click="
          updateDRB();
          getTheme();
          redir();
        "
      >
        <i class="fas fa-pen-square icon"></i>Modifier
      </a>
      <a class="btn bu-danger" href="/list-drb"
        ><i class="fas fa-window-close icon"></i>Annuler</a
      >
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  name: "Edit",
  data() {
    return {
      numero_remb: [],
      // DRB_Ofppts: {},
      edited_DRB: [],
      model5: null,
      model6: null,
      fiche_eval_sythetique: null,
      factures: null,
      compris_cheques: null,
      compris_remise: null,
      relev_bq_societe: null,
      relev_bq_cabinet: null,
      accuse_model6: null,
      total_regl: null,
      rmb_ofppt: [],
      justifs_ecart: null,
      etat: null,
      themes: [],
      active_radio: null,
      mode_ref_peiement: [],
      comment: "",
      montant_rembrs: null,
      date_depot_dmd_rembrs:null,
      date_rembrs:null,
      select_all_ch:null,
      date_paiement:[],
      ModeReferencePaiement:[],
      JustifsEcart:[]
    };
  },
  mounted() {
    this.numero_remb = JSON.parse(localStorage.getItem("n_drf"));
    console.log(this.numero_remb);
    this.handleAction("DRB_Ofppt/getListOfDROfpptEdit", this.numero_remb);
    this.handleAction("DRB_Ofppt/ReglEntrpInfo", this.numero_remb);

    setTimeout(() => {
      this.CalculTotalRegl();
    }, 1500);

    setTimeout(() => {
      this.model5 = this.DRB_Ofppts[0].model5 === "préparé";
      this.model6 = this.DRB_Ofppts[0].model6 === "préparé";
      this.fiche_eval_sythetique = this.DRB_Ofppts[0].fiche_eval_sythetique === "préparé";
      this.factures = this.DRB_Ofppts[0].factures === "préparé";
      this.compris_cheques = this.DRB_Ofppts[0].compris_cheques === "préparé";
      this.compris_remise = this.DRB_Ofppts[0].compris_remise === "préparé";
      this.relev_bq_societe = this.DRB_Ofppts[0].relev_bq_societe === "préparé";
      this.relev_bq_cabinet = this.DRB_Ofppts[0].relev_bq_cabinet === "préparé";
      this.accuse_model6 = this.DRB_Ofppts[0].accuse_model6 === "préparé";
      this.montant_rembrs =  this.DRB_Ofppts[0].montant_rembrs;
      this.date_depot_dmd_rembrs =  this.DRB_Ofppts[0].date_depot_dmd_rembrs;
      this.date_rembrs =  this.DRB_Ofppts[0].date_rembrs;
      this.select_all_ch= this.DRB_Ofppts[0].payerAllPF;
    }, 1000);

      setTimeout(() => {
       let data = this.reglEntreprise;
      let item = 0;
      for (item in data) {
        this.date_paiement.push(data[item].datePaiementEntreprise);
        this.ModeReferencePaiement.push(data[item].ModeReferencePaiement);
        this.rmb_ofppt.push(data[item].RemboursementOFPPT);
         this.JustifsEcart.push(data[item].JustifsEcart);
      }
    }, 1000);
    setTimeout(() => {
      if (
        this.DRB_Ofppts[0].etat === "initié" ||
        this.DRB_Ofppts[0].etat === "payé" ||
        this.DRB_Ofppts[0].etat === "instruction dossier" ||
        this.DRB_Ofppts[0].etat === "déposé" ||
        this.DRB_Ofppts[0].etat === "remboursé"
      ) {
        this.etat = this.DRB_Ofppts[0].etat;

        for (let i = 1; i <= 5; i++) {
          let targetselected_etat = $(`#opt${i}`);

          let selected_etat =
            $(`#opt${i}`)
              .text()
              .toLowerCase()
              .trim() == this.etat;

          if (selected_etat) {
            $(`#opt${i}`).removeClass("btn-warning");
            $(`#opt${i}`).addClass("btn-success active");
            this.active_radio = `#opt${i}`;
            // this.active_radio =`#opt${i}`;
            // console.log('active radio :' , `#opt${i}`);
          } else {
            targetselected_etat.click(() => {
              // $(`#opt${i}`).removeClass("btn-warning");
              $(`#opt${i}`).removeClass("btn-success active");
            });
          }
        }
      }
    }, 800);
  },
  methods: {
    DateValidation() {
      let Date_remb = document.getElementById("date_rembrs");
      let Date_depo_dem = document.getElementById("date_depot_dmd_rembrs");

      if (Date_depo_dem.value == "" || Date_depo_dem.value > Date_remb.value) {
        // document.getElementById('date_rembrs').value = '';
        document.getElementById("date_rembrs").disabled = true;
        this.$toastr.e(
          "Date dépot demande de Remboursement doit etre inferieur a la Date de Remboursement "
        );
      } else if (Date_depo_dem.value != "") {
        document.getElementById("date_rembrs").disabled = false;
      }
    },

    select_all() {
      let checkId = document.getElementById("select_all");
      let data = this.reglEntreprise;
      let first = this.reglEntreprise;
      let item = 0;


      if (checkId.checked) {

          if (
            document.getElementById("MDP:"+first[0].id_thm).value != "" &&
            document.getElementById("DP:"+first[0].id_thm).value != ""
          ) {
            for (item in data) {
               
              this.ModeReferencePaiement[item] = this.ModeReferencePaiement[0];
              this.date_paiement[item] =this.date_paiement[0];

            }
          } else {

              this.$toastr.e(
                "Merci d'entrer les premier ' Date paiement entreprise ' et ' Mode et référence de paiement' !!"
              );
              // checkId.checked = false;
              this.select_all_ch = false

          }
      } else {

            for (item in data) {
               this.ModeReferencePaiement[item] = "";
              this.date_paiement[item] ="";
            }

      }

    },

    handleAction(actionName, value) {
      this.$store.dispatch(actionName, value);
    },
    clearLS() {
      localStorage.clear();
    },
    CalculTotalRegl() {
      let data = this.reglEntreprise;
      let item = 0;
      setTimeout(() => {
        for (item in data) {
          let QtRegl = data[item].bdg_total * 0.3 + data[item].bdg_total * 0.2;
          this.total_regl += QtRegl;
        }
      }, 1200);
      return this.total_regl;
    },
    async updateDRB() {
     
      let etat = $("input:radio[name=etat]:checked").val();

      await this.getTheme();
      axios
        .post("/edit-drb-ofppt/" + this.numero_remb, {
          model6: this.model6,
          model5: this.model5,
          fiche_eval_sythetique: this.fiche_eval_sythetique,
          factures: this.factures,
          compris_cheques: this.compris_cheques,
          compris_remise: this.compris_remise,
          relev_bq_societe: this.relev_bq_societe,
          relev_bq_cabinet: this.relev_bq_cabinet,
          accuse_model6: this.accuse_model6,
          montant_rembrs: this.montant_rembrs,
          date_depot_dmd_rembrs: this.date_depot_dmd_rembrs,
          date_rembrs: this.date_rembrs,
          etat: etat,
          thems: this.themes,
          commenter: this.comment, 
          select_all_ch:this.select_all_ch
        })
        .then(() => {
          this.$toastr.s("Modifié avec succès");
           console.log('select all :: '+this.select_all_ch)
        })
        .catch(e => {
          this.$toastr.e("Echec de modification");
          throw e;
        });
    },
    getTheme() {
      this.themes = [];
      let data = this.reglEntreprise;
      let item = 0;

      for (item in data) {
        console.log();
        this.themes.push({
          id_theme: data[item].id_thm,
          n_form: data[item].n_form,
          date_paiement: document.getElementById(`DP:${data[item].id_thm}`)
            .value,
          mode_paiement: document.getElementById(`MDP:${data[item].id_thm}`)
            .value,
          rembrs_ofppt: document.getElementById(`RMBOFPPT:${data[item].id_thm}`)
            .value,
          ecart_rembrs_ofppt: document.getElementById(
            `EcartOFPPT:${data[item].id_thm}`
          ).value,
          justif_ecart: document.getElementById(
            `justifEcart:${data[item].id_thm}`
          ).value
        });
      }
      console.log(JSON.parse(JSON.stringify(this.themes)));

    },
    redir(){
      const parsed = JSON.stringify("Edit");
      localStorage.setItem("LS_redirection", parsed);
      window.location.href ='/detail-drb-ofppt';
    },

    checkEtat() {
      setTimeout(() => {
        for (let i = 1; i <= 5; i++) {
          let selected_etat =
            $(`#opt${i}`)
              .text()
              .toLowerCase()
              .trim() == this.etat;

          if (selected_etat) {
            $(this.active_radio).removeClass("btn-success active");
            $(this.active_radio).addClass("btn-warning");
            this.active_radio = `#opt${i}`;
            $(`#opt${i}`).removeClass("btn-warning");
            $(`#opt${i}`).addClass("btn-success active");
          }
        }
      }, 200);
    }
  },

  computed: {
    ...mapState("DRB_Ofppt", {
      DRB_Ofppts: state => state.DRB_OfpptEdit,
      reglEntreprise: state => state.reglEntreprise
    })
  }
};
</script>

<style scoped>
table {
  margin: 10px auto;
}

td,
th {
  text-align: center;
}

.total_reg {
  margin: 10px auto;
  float: right;
}

.btn-Etat {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}

.display_div {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}

.display_div_child {
  display: flex;
  flex-direction: column;
}

.div_select_all {
  float: right;
}

.EcartOFPPT {
  align-items: center;
  text-align: center;
  text-decoration: black;
  background-color: transparent;
  border: none;
  font-weight: bold;
}
</style>
