
<template>
  <div>
    <div style="display:flex;">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Détails</h1>
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="/list-drb">D.R OFPPT</a>
          </li>
          <li class="breadcrumb-item active">{{ this.numero_remb }}</li>
        </ol>
      </div>
    </div>
    <div
      v-for="DRB_Ofppt in DRB_Ofppts"
      :key="DRB_Ofppt.n_drf"
      class="card card-dark"
      style="width: 100% ;"
    >
      <!-- card-header -->
      <div class="card-header">
        <a class="btn btn-dark btn-sm bu-lg-ic" href="/list-drb"
          ><i class="fa fa-arrow-left"></i
        ></a>

        <h3 class="card-title card-h3">
          DRB OFPPT >
          <a href="/list-drb">
            <!-- {{ ucfirst($demande['type_miss']) }} -->
            List Demande remboursement OFPPT
          </a>
          {{ " > " }}
          <a href="#">
            <!-- {{ $demande['raisoci'] }} -->
            {{ DRB_Ofppt.raisoci }}
          </a>
        </h3>

        <a class="btn btn-sm btn-info float-right"
          ><i class="fa fa-print"></i
        ></a>
        <!-- @if (Auth::user()->type_user != "comptable")-->
        <a class="btn btn-sm btn-danger float-right"
          ><i class="fa fa-trash-alt"></i
        ></a>
        <a class="btn btn-sm btn-warning float-right" href="/edit-drb-ofppt"
          ><i class="fa fa-edit"></i
        ></a>
        <!-- @endif -->
      </div>
      <!-- /.card-header -->

      <div class="card-body p-0 table-responsive table-striped ">
        <table class="table table-striped">
          <thead class="thead">
            <tr>
              <div class="progress" style="height: 20px;">
                <div
                  class="progress-bar progress-bar-striped bg-success "
                  style="width: 20%"
                ></div>
              </div>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>ÉTAT DEMANDE</th>
              <td class="th-det text-capitalize" value="testtttttt">
                <i class="fa fa-battery-quarter"></i>
                {{ DRB_Ofppt.etat }}
              </td>
            </tr>

            <tr>
              <th>E/S</th>
              <td class="th-det text-capitalize" value="testtttttt">
                <i class="fa fa-battery-quarter"></i>
                {{ DRB_Ofppt.raisoci }}
              </td>
            </tr>

            <tr>
              <td colspan="12" class="text-lg bg-dark">PAIEMENT</td>
            </tr>

            <tr>
              <th class="th-det">Factures</th>
              <td>{{ DRB_Ofppt.factures }}</td>
            </tr>
            <tr>
              <th class="th-det">Relevés bancaire societé</th>
              <td>{{ DRB_Ofppt.relev_bq_societe }}</td>
            </tr>
            <tr>
              <th class="th-det">Relevés bancaire cabinet</th>
              <td>{{ DRB_Ofppt.relev_bq_cabinet }}</td>
            </tr>
            <tr>
              <th class="th-det">Fiche d'évaluation synthétique</th>
              <td>{{ DRB_Ofppt.fiche_eval_sythetique }}</td>
            </tr>
            <tr>
              <th class="th-det">Model 5</th>
              <td>{{ DRB_Ofppt.model5 }}</td>
            </tr>
            <tr>
              <th class="th-det">Model 6</th>
              <td>{{ DRB_Ofppt.model6 }}</td>
            </tr>
            <tr>
              <th class="th-det">Accusé Modele 6</th>
              <td>{{ DRB_Ofppt.accuse_model6 }}</td>
            </tr>

            <tr>
              <td colspan="12" class="text-lg bg-dark">DÉPOT</td>
            </tr>

            <tr>
              <th class="th-det">Date dépôt demande rembours.</th>
              <td>{{ DRB_Ofppt.date_depot_dmd_rembrs }}</td>
            </tr>
            <tr>
              <td colspan="12" class="text-lg bg-dark">REMBOURSEMENT</td>
            </tr>

            <tr>
              <th class="th-det">Date der. modif.</th>
              <td>{{DRB_Ofppt.date_rembrs}}</td>
            </tr>
            <tr>
              <th class="th-det">Montant remboursement</th>
              <td>{{ DRB_Ofppt.montant_rembrs }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- ./card-body -->
    </div>
    <!-- ./CARD -->
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  data() {
    return {
      numero_remb: []
    };
  },
  mounted() {
    this.numero_remb = JSON.parse(localStorage.getItem("n_drf"));
    console.log(this.numero_remb);
    this.handleAction("DRB_Ofppt/getListOfDROfpptEdit", this.numero_remb);


    if (JSON.parse(localStorage.getItem("LS_redirection"))) {
      this.$toastr.s("Modifié avec succès");
      localStorage.removeItem("LS_redirection")
      
    }
      
  },
  methods: {
    addCat() {
      if (!this.newCat) {
        return;
      }

      this.cats.push(this.newCat);
      this.newCat = "";
      this.saveCats();
    },
    removeCat(x) {
      this.cats.splice(x, 1);
      this.saveCats();
    },
    saveCats() {
      const parsed = JSON.stringify(this.cats);
      localStorage.setItem("cats", parsed);
    },
    clearLS() {
      localStorage.clear();
    },
    handleAction(actionName, value) {
      this.$store.dispatch(actionName, value);
    }
  },

  computed: {
    ...mapState("DRB_Ofppt", {
      DRB_Ofppts: state => state.DRB_OfpptEdit
    })
  }
};
</script>

<style></style>
