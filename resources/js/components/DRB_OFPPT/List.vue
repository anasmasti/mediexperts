<template>
  <div class="card card-dark">
    <!-- card-header -->
    <div class="card-header">
      <div class="d-flex h-100 div_header">
        <h3 class="card-title">Demandes&nbsp;remboursement&nbsp;OFPPT</h3>
        <div class="container h-100 ">
          <form action="/searchofppt" method="GET">
            <div class="searchbar bu-sm">
              <input
                class="search_input"
                type="text"
                name="searchofppt"
                id="searchofppt"
                placeholder="Rechercher par N°.."
              />
              <button @click="search()" type="button" class="search_icon btn">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- /.card-header -->
    <div class="card-body table-striped p-0">
      <div class="table-responsive">
        <table class="table table-md">
          <thead class="thead">
            <tr>
              <th>Etat</th>
              <th>Référence plan formation</th>
              <th>Plan de formation</th>
              <th>Commentaire</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="DRB_Ofppt in DRB_Ofppts" :key="DRB_Ofppt.n_drf">
              <td
                :class="
                  DRB_Ofppt.etat.toLowerCase() == 'remboursé'
                    ? 'd-flex flex-nowrap progress-bar progress-bar-striped bg-light'
                    : 'd-flex flex-nowrap progress-bar progress-bar-striped bg-warning progress-bar-animated'
                "
              >
                <i
                  class="fa fa-dollar-sign"
                  v-if="DRB_Ofppt.etat.toLowerCase() == 'payé'"
                >
                </i>
                <i
                  class="fa fa-battery-quarter"
                  v-if="DRB_Ofppt.etat.toLowerCase() == 'initié'"
                >
                </i>
                <i
                  class="fa fa-hourglass-half"
                  v-if="DRB_Ofppt.etat.toLowerCase() == 'instruction dossier'"
                >
                </i>
                <i
                  class="fa fa-folder-open"
                  v-if="DRB_Ofppt.etat.toLowerCase() == 'déposé'"
                >
                </i>
                <i
                  class="fa fa-check-circle"
                  v-if="DRB_Ofppt.etat.toLowerCase() == 'remboursé'"
                >
                </i>
                <strong>{{ DRB_Ofppt.etat }}</strong>
              </td>
              <td>{{ DRB_Ofppt.refpdf }}</td>
              <td>
                {{ DRB_Ofppt.id_plan }}
              </td>
              <td>
               {{ DRB_Ofppt.commenter}}
              </td>
              <td>
                <a href="/detail-drb-ofppt" class="btn btn-primary"
                  @click="sendnrdf(DRB_Ofppt.n_drf)"
                  ><i class="fa fa-eye" style="color: white ;"></i
                ></a>
                <a
                  href="/edit-drb-ofppt"
                  @click="sendnrdf(DRB_Ofppt.n_drf)"
                  class="btn btn-warning"
                  ><i class="fa fa-edit"></i
                ></a>
                <a data-toggle="modal" data-target="#deleteModal" @click="remplir(DRB_Ofppt.n_drf)" class="btn btn-danger">
                  <i class="fa fa-trash-alt" style="color: white ;"></i>
                </a>
                  <div id="deleteModal" class="modal fade">
                      <div class="modal-dialog modal-dialog-centered modal-confirm">
                          <div class="modal-content">
                              <div class="modal-header flex-column">
                                  <div class="icon-box icon-box-danger">
                                      <i class="material-icons">close</i>
                                  </div>
                                  <p class="modal-title h1 pt-3 w-100" id="modalDeleteTitle">
                                    Êtes-vous sur ?
                                  </p>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              </div>
                              <div class="modal-body">
                                  <p id="modalDeleteMessage">
                                      Une fois supprimé, vous ne pourrez plus récupérer cet enregistrement!
                                  </p>
                              </div>
                              <div class="modal-footer justify-content-center">
                                  <a  id="deleteBtn" @click="DeleteDrf(ndrf); redir()" style="color : white" class="btn btn-danger">
                                      <i class="material-icons" >delete_forever</i>
                                      Supprimer
                                  </a>
                                  <button type="button"  class="btn btn-secondary" data-dismiss="modal">
                                      <i class="material-icons">cancel</i>
                                      Annuler
                                  </button>

                                  
                              </div>
                          </div>
                      </div>
                  </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    
    <!-- ./card-body -->


    <!-- delete model -->
  
  </div>
</template>
<script>
import { mapState, mapActions } from "vuex";
export default {
  name: "List",
  data() {
    return {
      ndrf:null
    };
  },

  mounted() {
    this.getListOfDROfppt;
    console.log(this.getListOfDROfppt);
    
  },

  methods: {
    sendnrdf(n_drf) {
      const parsed = JSON.stringify(n_drf);
      localStorage.setItem("n_drf", parsed);
    },
    handleAction(actionName, value) {
      this.$store.dispatch(actionName, value);
    },
    search(){
      let ndrf = document.getElementById('searchofppt').value;
      this.handleAction("DRB_Ofppt/rechercher", ndrf);
      console.log('ndrf : '+ndrf);

    },
    ...mapActions("DRB_Ofppt", ["DeleteDrf"]),
    redir(ndrf){
      console.log(ndrf);
      window.location.href ='/list-drb';
    },
    remplir(ndrf){
      this.ndrf = ndrf;
      console.log(this.ndrf);
    }
  },

  computed: {
    ...mapState("DRB_Ofppt", {
      DRB_Ofppts: state => state.DRB_Ofppts,
    }),

    ...mapActions("DRB_Ofppt", ["getListOfDROfppt"])
  }
};
</script>
<style scoped>
.div_header {
  display: flex;
  flex-direction: row;
}
.searchbar {
  display: flex;
  flex-direction: row;
}

.search_icon {
  display: flex;
}

@media only screen and (max-width: 600px) {
  .div_header {
    display: flex;
    flex-direction: column;
  }

  .searchbar {
    margin: auto;
    align-self: center;
    width: 100%;
  }

  .search_icon {
    position: relative;
    float: right;
    right: 0%;
  }
}
</style>
