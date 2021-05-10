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
          <th>Année</th>
          <th class="action">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Test</td>
          <td>Test</td>
          <td>Test</td>
          <td class="th-last d-inline-block text-truncate">Test</td>
          <!-- <form method="GET"> -->
            <td class="action">
              <a href="/detail-drb-of" class="btn btn-primary" ><i class="fa fa-eye" style="color: white ;"></i></a>
              <a href="/edit-drb" class="btn btn-warning"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger" ><i class="fa fa-trash-alt" style="color: white ;"></i></a>
            </td>
          <!-- </form> -->
        </tr>
      </tbody>
      
    </table>
  </div><!-- ./card-body -->

  <div class="card-footer">
  </div>

</div><!-- ./CARD -->

</template>

<script>
export default {
  mounted(){
    
      console.log("Hello from listVue")
    
  }

}
</script>

<style>

</style>