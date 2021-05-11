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
        <tr>
          <td>Test</td>
          <td>Test</td>
          <td>Test</td>
          <!-- <form method="GET"> -->
            <td class="action">
              <a href="/detail-drb-of" @click="SendId()" class="btn btn-primary" ><i class="fa fa-eye" style="color: white ;"></i></a>
              <a href="#" @click="SendId()" class="btn btn-warning"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger" ><i class="fa fa-trash-alt" style="color: white ;"></i></a>
            </td>
          <!-- </form> -->
        </tr>
        <!-- <h1>{{ this.testttttt }}</h1> -->
        <!-- <button type="submit" @click="Testt()">click</button> -->
        
      </tbody>
      
    </table>

    <input v-model="id">
    <!-- <button @click="SendId">Send</button> -->

  </div><!-- ./card-body -->

  <div class="card-footer">
  </div>

</div><!-- ./CARD -->

</template>

<script>

export default {
  data(){
        return{
          id : [],
          // testttttt: 'test'
        }
  },
  // mounted(){
    
  //     if(localStorage.notes){
  //       this.notes = localStorage.notes;
  //     }
    
  // },
  // watch: {
  //   notes(newNotes){
  //     localStorage.notes = newNotes ; 
  //   }
  // },
  methods:{
    SendId() {
      const parsed = JSON.stringify(this.id);
      localStorage.setItem('n_drb', parsed);
    },
    Test(){
      console.log("Test");
    }
  },
  // created : function(){
  //   this.localData();
  // },
  // methods: {
  //   localData(){
  //     localStorage.setItem=('data','Test')
  //   }
  // },
  // setInterval(() => {
    
  // }, 1000);
  
}
</script>

<style>

</style>