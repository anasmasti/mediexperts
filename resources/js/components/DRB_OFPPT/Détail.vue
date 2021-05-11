<!--<template>
   <div>
    <h1> Hello! </h1>
    <button type="submit" @click="localData()">click</button>
  </div> 
</template>

<script>
export default {
  data(){
    return{
      notes : 'Hello',
    }
    
  },
  methods : {
    localData(){
      localStorage.setItem=('data',JSON.stringify(this.notes));
    }
  }
}
</script>

<style>

</style>-->


<template>
  <div id="app">
    <h2>Chats</h2>
    <div v-for="(cat, n) in cats" v-bind:key="cat.id">
      <p>
        <span class="cat">{{ cat }}</span>
        <button @click="removeCat(n)">Enlever</button>
      </p>
    </div>

    <p>
    <input  :value=tst  >
    <button @click="addCat">Ajouter un chat</button>
    </p>
    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->

      
  </div>
</template>

<script>
export default {
  data() {
    return{
      cats: [],
      newCat: null,
      tst : []
    }
  },
  mounted () {
    const Id = JSON.parse(localStorage.getItem("n_drb"));
    this.tst = Id ; 
    this.clearLS();
  },
  // mounted() {
  //   if (localStorage.getItem('cats')) {
  //     try {
  //       this.cats = JSON.parse(localStorage.getItem('cats'));
  //     } catch(e) {
  //       localStorage.removeItem('cats');
  //     }
  //   }
  // },
   methods: {
    addCat() {
      if (!this.newCat) {
        return;
      }

      this.cats.push(this.newCat);
      this.newCat = '';
      this.saveCats();
    },
    removeCat(x) {
      this.cats.splice(x, 1);
      this.saveCats();
    },
    saveCats() {
      const parsed = JSON.stringify(this.cats);
      localStorage.setItem('cats', parsed);
    },
    clearLS(){
      localStorage.clear();
    }
  }
}
</script>

<style>

</style>