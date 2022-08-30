<template>
<div class="banner">
    <select v-model="selectedSpecialty" class="form-select" aria-label="Default select example">
      <option selected>Open this select menu</option>
      <option v-for="(specialty, index) in specialties" :key="index" :value="specialty.id">{{specialty.specialty_name}}</option>
    </select>
      <form action="">
    <button @click="$emit('sendSearchDoctor', selectedSpecialty)">Avvia ricerca per specializzazione</button>
  </form>
</div>
</template>

<script>
export default {
  name: 'Banner',
  data() {
    return {
        specialties: [],
        selectedSpecialty: '',
    }
  },
  created() {
        this.getSpecialties();
    },
    methods: {
        getSpecialties() {
             axios.get('/api/specialties')
             .then((resp) => {
                this.specialties = resp.data.results;
            })
        },
    //     sendSearchDoctor(){
    //     if(this.searchTitle.trim()){
    //       this.$emit('search',this.searchTitle)
    //     }
    //   }
    }
};
</script>

<style>
</style>