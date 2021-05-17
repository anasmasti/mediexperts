<template>
  <div class="card card-dark">
    <!-- card-header -->
    <div class="card-header">
      <div class="d-flex h-100">
        <h3 class="card-title">Demandes&nbsp;remboursement&nbsp;OFPPT</h3>
        <div class="container h-100 ">
          <form action="/searchofppt" method="GET">
            <div class="searchbar bu-sm">
              <input
                class="search_input"
                type="text"
                name="searchofppt"
                placeholder="Rechercher par N°.."
              />
              <button type="submit" class="search_icon btn">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

<<<<<<< HEAD
    <!-- /.card-header -->
    <div class="card-body table-striped p-0">
      <table class="table table-md" >
        <thead class="thead">
          <tr>
            <th>Etat</th>
            <th>RefPdf</th>
            <th>Plan de formation</th>
            <th>Année</th>
            <th class="action">Action</th>
          </tr>
        </thead>
        <tbody v-for="(drf , index) in list_drfs" :key="index">
          <tr>
            <td>{{ drf.etat }}</td>
            <td>{{ drf.refpdf }}</td>
            <td>{{ drf.id_plan }}</td>
            <td class="th-last d-inline-block text-truncate">Test</td>
            <!-- <form method="GET"> -->
            <td class="action">
              <a href="#" class="btn btn-primary"
                ><i class="fa fa-eye" style="color: white ;"></i></a>
              <a id="edit" :href="`/get-drf-of/${drf.n_drf}`" @click="handleAction('DRB_OFPPT/getSelectedDrfId', drf.n_drf)" class="btn btn-warning" ><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger"
                ><i class="fa fa-trash-alt" style="color: white ;"></i
              ></a>
=======
  <!-- /.card-header -->
  <div class="card-body table-striped p-0">
    <table class="table table-md">
      <thead class="thead">
        <tr>
          <th>Etat</th>
          <th>RefPdf</th>
          <th>Plan de formation</th>
          <th class="action">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="DRB_Ofppt in DRB_Ofppts" :key="DRB_Ofppt.n_drf">
          <td>{{DRB_Ofppt.etat}}</td>
          <td>{{DRB_Ofppt.refpdf}}</td>
          <td class="th-last d-inline-block text-truncate">{{DRB_Ofppt.id_plan}}</td>
          <!-- <form method="GET"> -->
            <td class="action">
              <a href="/detail-drb-of" class="btn btn-primary" ><i class="fa fa-eye" style="color: white ;"></i></a>
              <a href="/edit-drb-ofppt" @click="sendnrdf(DRB_Ofppt.n_drf)" class="btn btn-warning"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger" ><i class="fa fa-trash-alt" style="color: white ;"></i></a>
>>>>>>> 12cc41ce0e25ecc65b0ec0cafa971fc65dd2b8c2
            </td>
            <!-- </form> -->
          </tr>
        </tbody>
      </table>
    </div>
    <!-- ./card-body -->

    <div class="card-footer">

    </div>
  </div>
  <!-- ./CARD -->
</template>
<<<<<<< HEAD

<script>
import { mapState } from "vuex";
import Edit from "/resources/js/components/DRB_OFPPT/Edit.vue";
import vue from 'vue';

export default {
  name:"List",
  components : {
    Edit,
  },
  data() {
    return {

    };
  },
  mounted() {

    this.$store.dispatch('DRB_OFPPT/FetchAllDrf');
  },
  computed: {
    ...mapState("DRB_OFPPT", {
      list_drfs: state => state.list_drfs,
      drfById: state => state.drfById,
    })
  },

  methods: {
    handleAction(actionName, value) {
      this.$store.dispatch(actionName, value);
    },

    // GetDrf() {
    //   setTimeout(() => {
    //     $('#edit').on('click' , function() {
    //       document.createElement('<Edit ref="Edit" :DrfById="SelectedDrf"> </Edit>')
    //     })
    //     this.SelectedDrf = this.drfById;
    //     vue.prototype.$DrfById = this.Drf;
    //     console.log("-----R----",this.SelectedDrf);
    //   }, 1000);
    // },
  }
};
</script>
=======
 <script>
import { mapState, mapActions } from 'vuex';
 export default {
            name: "DRB_Ofppts",
             data() {
               return {
                  //  DRB_Ofppts: []
               }
             },
            mounted() {
              // this.$store.dispatch("DRB_OFPPT/getListOfDROfppt");
              this.getListOfDROfppt
               
            },
            methods:{
              sendnrdf(n_drf){
                const parsed = JSON.stringify(n_drf);
                localStorage.setItem('n_drb',parsed);
              }
            },
            computed: {
              ...mapState ("DRB_Ofppt", {
                  DRB_Ofppts: state => state.DRB_Ofppts,
              }),
               
              ...mapActions ("DRB_Ofppt", {
                  getListOfDROfppt: 'getListOfDROfppt'
              })
               
            }
        }
    </script>
<style>
>>>>>>> 12cc41ce0e25ecc65b0ec0cafa971fc65dd2b8c2

<style></style>
