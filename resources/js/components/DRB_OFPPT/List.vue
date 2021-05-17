<template>
  
  <div class="card card-dark">
  <!-- card-header -->
  <div class="card-header">
    <div class="d-flex h-100">
      <h3 class="card-title">Demandes&nbsp;remboursement&nbsp;OFPPT</h3>
      <div class="container h-100 ">
        <form action="/searchofppt" method="GET">
          <div class="searchbar bu-sm">
            <input class="search_input" type="text" name="searchofppt" placeholder="Rechercher par N°..">
            <button type="submit" class="search_icon btn"><i class="fas fa-search"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>

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
<!-- <<<<<<< HEAD -->
       <!-- <tr>
          <td>Test</td>
          <td>Test</td>
          <td>Test</td>
           <form method="GET"> 
            <td class="action">
              <a href="/detail-drb-of" @click="SendId()" class="btn btn-primary" ><i class="fa fa-eye" style="color: white ;"></i></a>
              <a href="#" @click="SendId()" class="btn btn-warning"><i class="fa fa-edit"></i></a>
=======-->
        <tr v-for="DRB_Ofppt in DRB_Ofppts" :key="DRB_Ofppt.n_drf">
          <td>{{DRB_Ofppt.etat}}</td>
          <td>{{DRB_Ofppt.refpdf}}</td>
          <td class="th-last d-inline-block text-truncate">{{DRB_Ofppt.id_plan}}</td>
            <td class="action">
              <a href="/edit-drb-ofppt" class="btn btn-primary" ><i class="fa fa-eye" style="color: white ;"></i></a>
              <a href="/edit-drb-ofppt" @click="sendnrdf(DRB_Ofppt.n_drf)" class="btn btn-warning"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger" ><i class="fa fa-trash-alt" style="color: white ;"></i></a>
            </td>
        </tr>
        
      </tbody>
      
    </table>

  </div><!-- ./card-body -->

  <div class="card-footer">
  </div>

</div><!-- ./CARD -->

</template>
 <script>
import { mapState, mapActions } from 'vuex';
 export default {
            name: "List",
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
                localStorage.setItem('n_drf',parsed);
                console.log(n_drf);
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

</style>